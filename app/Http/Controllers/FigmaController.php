<?php

namespace App\Http\Controllers;

use App\Services\FigmaApiService;
use App\Services\FigmaToHtmlConverter;
use Illuminate\Http\Request;

class FigmaController extends Controller
{
    public function __construct(
        protected FigmaApiService $figma,
        protected FigmaToHtmlConverter $converter,
    ) {}

    /**
     * Show the main dashboard with Figma connection form.
     */
    public function index()
    {
        $hasToken = !empty(config('services.figma.token'));
        return view('figma.index', compact('hasToken'));
    }

    /**
     * Save the Figma API token.
     */
    public function saveToken(Request $request)
    {
        $request->validate([
            'token' => 'required|string|min:10',
        ]);

        $this->updateEnvValue('FIGMA_TOKEN', $request->input('token'));

        return redirect()->route('figma.index')
            ->with('success', 'Figma API token saved successfully.');
    }

    /**
     * Fetch and display a Figma file.
     */
    public function fetchFile(Request $request)
    {
        $request->validate([
            'figma_url' => 'required|string',
        ]);

        $fileKey = FigmaApiService::extractFileKey($request->input('figma_url'));

        if (!$fileKey) {
            return back()->withErrors(['figma_url' => 'Invalid Figma URL or file key.']);
        }

        try {
            $fileData = $this->figma->getFile($fileKey);
        } catch (\RuntimeException $e) {
            return back()->withErrors(['figma_url' => $e->getMessage()]);
        }

        $fileName = $fileData['name'] ?? 'Untitled';
        $document = $fileData['document'] ?? [];
        $pages = $document['children'] ?? [];

        $pageList = [];
        foreach ($pages as $page) {
            $pageList[] = [
                'id' => $page['id'],
                'name' => $page['name'] ?? 'Untitled Page',
                'childCount' => count($page['children'] ?? []),
            ];
        }

        return view('figma.file', compact('fileKey', 'fileName', 'pageList', 'fileData'));
    }

    /**
     * Convert a Figma file/page to HTML+CSS and show the result.
     */
    public function convert(Request $request)
    {
        $request->validate([
            'file_key' => 'required|string',
            'page_id' => 'nullable|string',
        ]);

        $fileKey = $request->input('file_key');

        try {
            $fileData = $this->figma->getFile($fileKey);
        } catch (\RuntimeException $e) {
            return back()->withErrors(['error' => $e->getMessage()]);
        }

        // Try to get image URLs for nodes that have image fills
        $imageUrls = [];
        try {
            $allNodeIds = $this->collectNodeIds($fileData['document'] ?? []);
            if (!empty($allNodeIds)) {
                // Limit to 50 nodes at a time
                $batch = array_slice($allNodeIds, 0, 50);
                $imagesResponse = $this->figma->getImages($fileKey, $batch);
                $imageUrls = $imagesResponse['images'] ?? [];
            }
        } catch (\RuntimeException $e) {
            // Images are optional, continue without them
        }

        $pages = $this->converter->convertFile($fileData, $imageUrls);

        // Filter to specific page if requested
        $pageId = $request->input('page_id');
        if ($pageId) {
            $pages = array_filter($pages, fn($p) => $p['id'] === $pageId);
            $pages = array_values($pages);
        }

        $fileName = $fileData['name'] ?? 'Untitled';

        return view('figma.result', compact('pages', 'fileName', 'fileKey'));
    }

    /**
     * Download generated HTML.
     */
    public function download(Request $request)
    {
        $request->validate([
            'html' => 'required|string',
            'filename' => 'nullable|string',
        ]);

        $html = $request->input('html');
        $filename = $request->input('filename', 'figma-export') . '.html';
        $filename = preg_replace('/[^a-zA-Z0-9._-]/', '-', $filename);

        return response($html)
            ->header('Content-Type', 'text/html')
            ->header('Content-Disposition', "attachment; filename=\"{$filename}\"");
    }

    /**
     * Collect all node IDs from a Figma document tree.
     */
    protected function collectNodeIds(array $node): array
    {
        $ids = [];

        if (isset($node['id'])) {
            $ids[] = $node['id'];
        }

        foreach ($node['children'] ?? [] as $child) {
            $ids = array_merge($ids, $this->collectNodeIds($child));
        }

        return $ids;
    }

    /**
     * Update a value in the .env file.
     */
    protected function updateEnvValue(string $key, string $value): void
    {
        $envPath = base_path('.env');
        $envContent = file_get_contents($envPath);

        $escapedValue = str_contains($value, ' ') ? "\"{$value}\"" : $value;

        if (preg_match("/^{$key}=.*/m", $envContent)) {
            $envContent = preg_replace("/^{$key}=.*/m", "{$key}={$escapedValue}", $envContent);
        } else {
            $envContent .= "\n{$key}={$escapedValue}\n";
        }

        file_put_contents($envPath, $envContent);
    }
}

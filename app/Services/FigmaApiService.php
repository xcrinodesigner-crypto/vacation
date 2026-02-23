<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Cache;

class FigmaApiService
{
    protected string $baseUrl = 'https://api.figma.com/v1';
    protected string $token;

    public function __construct()
    {
        $this->token = config('services.figma.token', '');
    }

    /**
     * Get a Figma file by its key.
     */
    public function getFile(string $fileKey): array
    {
        $cacheKey = "figma_file_{$fileKey}";

        return Cache::remember($cacheKey, 300, function () use ($fileKey) {
            $response = Http::withToken($this->token)
                ->get("{$this->baseUrl}/files/{$fileKey}");

            if ($response->failed()) {
                throw new \RuntimeException(
                    'Figma API error: ' . $response->json('err', 'Unknown error')
                );
            }

            return $response->json();
        });
    }

    /**
     * Get specific nodes from a Figma file.
     */
    public function getFileNodes(string $fileKey, array $nodeIds): array
    {
        $ids = implode(',', $nodeIds);

        $response = Http::withToken($this->token)
            ->get("{$this->baseUrl}/files/{$fileKey}/nodes", [
                'ids' => $ids,
            ]);

        if ($response->failed()) {
            throw new \RuntimeException(
                'Figma API error: ' . $response->json('err', 'Unknown error')
            );
        }

        return $response->json();
    }

    /**
     * Get images (rendered PNGs) for nodes.
     */
    public function getImages(string $fileKey, array $nodeIds, string $format = 'png', int $scale = 2): array
    {
        $ids = implode(',', $nodeIds);

        $response = Http::withToken($this->token)
            ->get("{$this->baseUrl}/images/{$fileKey}", [
                'ids' => $ids,
                'format' => $format,
                'scale' => $scale,
            ]);

        if ($response->failed()) {
            throw new \RuntimeException(
                'Figma API error: ' . $response->json('err', 'Unknown error')
            );
        }

        return $response->json();
    }

    /**
     * Get file components.
     */
    public function getFileComponents(string $fileKey): array
    {
        $response = Http::withToken($this->token)
            ->get("{$this->baseUrl}/files/{$fileKey}/components");

        if ($response->failed()) {
            throw new \RuntimeException(
                'Figma API error: ' . $response->json('err', 'Unknown error')
            );
        }

        return $response->json();
    }

    /**
     * Get file styles.
     */
    public function getFileStyles(string $fileKey): array
    {
        $response = Http::withToken($this->token)
            ->get("{$this->baseUrl}/files/{$fileKey}/styles");

        if ($response->failed()) {
            throw new \RuntimeException(
                'Figma API error: ' . $response->json('err', 'Unknown error')
            );
        }

        return $response->json();
    }

    /**
     * Extract the file key from a Figma URL.
     */
    public static function extractFileKey(string $url): ?string
    {
        if (preg_match('/figma\.com\/(?:file|design|proto)\/([a-zA-Z0-9]+)/', $url, $matches)) {
            return $matches[1];
        }

        // If it's already a file key (no URL), return as-is
        if (preg_match('/^[a-zA-Z0-9]+$/', $url)) {
            return $url;
        }

        return null;
    }

    /**
     * Validate the API token.
     */
    public function validateToken(): bool
    {
        if (empty($this->token)) {
            return false;
        }

        $response = Http::withToken($this->token)
            ->get("{$this->baseUrl}/me");

        return $response->successful();
    }
}

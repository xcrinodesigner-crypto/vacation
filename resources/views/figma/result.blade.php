@extends('layouts.app')

@section('title', 'Generated Code - ' . $fileName)

@section('content')
<div class="container-fluid py-4">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('figma.index') }}">Home</a></li>
            <li class="breadcrumb-item">{{ $fileName }}</li>
            <li class="breadcrumb-item active">Generated Code</li>
        </ol>
    </nav>

    <div class="d-flex align-items-center justify-content-between mb-4">
        <h2 class="mb-0">
            <i class="bi bi-code-slash me-2"></i>Generated Code
        </h2>
        <a href="{{ route('figma.index') }}" class="btn btn-outline-secondary">
            <i class="bi bi-arrow-left me-1"></i>Back
        </a>
    </div>

    @forelse($pages as $index => $page)
        <div class="card mb-4">
            <div class="card-header bg-white d-flex align-items-center justify-content-between py-3">
                <h5 class="mb-0">
                    <i class="bi bi-file-earmark-code me-2"></i>{{ $page['name'] }}
                </h5>
                <div>
                    <button class="btn btn-sm btn-outline-primary me-2" onclick="copyCode('css-{{ $index }}')">
                        <i class="bi bi-clipboard me-1"></i>Copy CSS
                    </button>
                    <button class="btn btn-sm btn-outline-primary me-2" onclick="copyCode('html-{{ $index }}')">
                        <i class="bi bi-clipboard me-1"></i>Copy HTML
                    </button>
                    <form action="{{ route('figma.download') }}" method="POST" class="d-inline">
                        @csrf
                        <input type="hidden" name="html" value="{{ $page['full_page'] }}">
                        <input type="hidden" name="filename" value="{{ \Illuminate\Support\Str::slug($page['name']) }}">
                        <button type="submit" class="btn btn-sm btn-figma">
                            <i class="bi bi-download me-1"></i>Download HTML
                        </button>
                    </form>
                </div>
            </div>
            <div class="card-body">
                {{-- Tabs for Preview, HTML, CSS --}}
                <ul class="nav nav-tabs mb-3" role="tablist">
                    <li class="nav-item">
                        <button class="nav-link active" data-bs-toggle="tab" data-bs-target="#preview-{{ $index }}">
                            <i class="bi bi-eye me-1"></i>Preview
                        </button>
                    </li>
                    <li class="nav-item">
                        <button class="nav-link" data-bs-toggle="tab" data-bs-target="#html-tab-{{ $index }}">
                            <i class="bi bi-filetype-html me-1"></i>HTML
                        </button>
                    </li>
                    <li class="nav-item">
                        <button class="nav-link" data-bs-toggle="tab" data-bs-target="#css-tab-{{ $index }}">
                            <i class="bi bi-filetype-css me-1"></i>CSS
                        </button>
                    </li>
                    <li class="nav-item">
                        <button class="nav-link" data-bs-toggle="tab" data-bs-target="#full-tab-{{ $index }}">
                            <i class="bi bi-file-code me-1"></i>Full Page
                        </button>
                    </li>
                </ul>

                <div class="tab-content">
                    {{-- Preview Tab --}}
                    <div class="tab-pane fade show active" id="preview-{{ $index }}">
                        <div class="preview-frame p-3">
                            <iframe srcdoc="{{ htmlspecialchars($page['full_page']) }}"
                                    style="width:100%;min-height:500px;border:none;"
                                    sandbox="allow-same-origin"></iframe>
                        </div>
                    </div>

                    {{-- HTML Tab --}}
                    <div class="tab-pane fade" id="html-tab-{{ $index }}">
                        <pre class="code-block" id="html-{{ $index }}"><code>{{ $page['html'] }}</code></pre>
                    </div>

                    {{-- CSS Tab --}}
                    <div class="tab-pane fade" id="css-tab-{{ $index }}">
                        <pre class="code-block" id="css-{{ $index }}"><code>{{ $page['css'] }}</code></pre>
                    </div>

                    {{-- Full Page Tab --}}
                    <div class="tab-pane fade" id="full-tab-{{ $index }}">
                        <pre class="code-block" id="full-{{ $index }}"><code>{{ $page['full_page'] }}</code></pre>
                    </div>
                </div>
            </div>
        </div>
    @empty
        <div class="alert alert-info">
            <i class="bi bi-info-circle me-2"></i>No pages were converted. The file may be empty.
        </div>
    @endforelse
</div>
@endsection

@section('scripts')
<script>
function copyCode(elementId) {
    const element = document.getElementById(elementId);
    const text = element.textContent || element.innerText;
    navigator.clipboard.writeText(text).then(() => {
        const btn = event.target.closest('button');
        const originalHtml = btn.innerHTML;
        btn.innerHTML = '<i class="bi bi-check me-1"></i>Copied!';
        btn.classList.add('btn-success');
        btn.classList.remove('btn-outline-primary');
        setTimeout(() => {
            btn.innerHTML = originalHtml;
            btn.classList.remove('btn-success');
            btn.classList.add('btn-outline-primary');
        }, 2000);
    });
}
</script>
@endsection

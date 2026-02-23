@extends('layouts.app')

@section('title', $fileName)

@section('content')
<div class="container py-4">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('figma.index') }}">Home</a></li>
            <li class="breadcrumb-item active">{{ $fileName }}</li>
        </ol>
    </nav>

    <div class="d-flex align-items-center justify-content-between mb-4">
        <div>
            <h2 class="mb-1">{{ $fileName }}</h2>
            <span class="text-muted">File Key: <code>{{ $fileKey }}</code></span>
        </div>
        <form action="{{ route('figma.convert') }}" method="POST">
            @csrf
            <input type="hidden" name="file_key" value="{{ $fileKey }}">
            <button type="submit" class="btn btn-figma btn-lg">
                <i class="bi bi-code-slash me-2"></i>Convert All Pages
            </button>
        </form>
    </div>

    <div class="row">
        @forelse($pageList as $page)
            <div class="col-md-6 col-lg-4 mb-4">
                <div class="card h-100">
                    <div class="card-body">
                        <div class="d-flex align-items-center mb-3">
                            <div class="rounded-circle bg-primary bg-opacity-10 d-flex align-items-center justify-content-center me-3" style="width:48px;height:48px;">
                                <i class="bi bi-file-earmark-code fs-5 text-primary"></i>
                            </div>
                            <div>
                                <h5 class="card-title mb-0">{{ $page['name'] }}</h5>
                                <small class="text-muted">{{ $page['childCount'] }} element(s)</small>
                            </div>
                        </div>
                        <p class="text-muted small mb-3">
                            Node ID: <code>{{ $page['id'] }}</code>
                        </p>
                        <form action="{{ route('figma.convert') }}" method="POST">
                            @csrf
                            <input type="hidden" name="file_key" value="{{ $fileKey }}">
                            <input type="hidden" name="page_id" value="{{ $page['id'] }}">
                            <button type="submit" class="btn btn-outline-primary btn-sm w-100">
                                <i class="bi bi-arrow-right me-1"></i>Convert This Page
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-12">
                <div class="alert alert-info">
                    <i class="bi bi-info-circle me-2"></i>No pages found in this file.
                </div>
            </div>
        @endforelse
    </div>
</div>
@endsection

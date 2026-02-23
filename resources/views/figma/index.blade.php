@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
<div class="hero-section">
    <div class="container text-center">
        <h1 class="display-5 fw-bold mb-3">
            <i class="bi bi-palette"></i> Figma to Code
        </h1>
        <p class="lead mb-0">Convert your Figma designs into clean HTML &amp; CSS with Bootstrap</p>
    </div>
</div>

<div class="container">
    <div class="row justify-content-center">
        {{-- Step 1: API Token --}}
        <div class="col-lg-8 mb-4">
            <div class="card">
                <div class="card-header bg-white py-3">
                    <h5 class="mb-0">
                        <i class="bi bi-key me-2"></i>Step 1: Connect Your Figma Account
                    </h5>
                </div>
                <div class="card-body">
                    @if($hasToken)
                        <div class="d-flex align-items-center">
                            <span class="badge bg-success me-2">
                                <i class="bi bi-check-circle"></i> Connected
                            </span>
                            <span class="text-muted">Your Figma API token is configured.</span>
                        </div>
                        <hr>
                        <details>
                            <summary class="text-muted" style="cursor:pointer;">Update token</summary>
                            <form action="{{ route('figma.save-token') }}" method="POST" class="mt-3">
                                @csrf
                                <div class="input-group">
                                    <input type="password" name="token" class="form-control" placeholder="Enter new Figma Personal Access Token">
                                    <button type="submit" class="btn btn-outline-secondary">Update</button>
                                </div>
                            </form>
                        </details>
                    @else
                        <p class="text-muted mb-3">
                            To get started, you need a Figma Personal Access Token.
                            Go to <strong>Figma &rarr; Settings &rarr; Personal Access Tokens</strong> to generate one.
                        </p>
                        <form action="{{ route('figma.save-token') }}" method="POST">
                            @csrf
                            <div class="input-group">
                                <span class="input-group-text"><i class="bi bi-key-fill"></i></span>
                                <input type="password" name="token" class="form-control" placeholder="Paste your Figma Personal Access Token" required>
                                <button type="submit" class="btn btn-figma">
                                    <i class="bi bi-link-45deg me-1"></i>Connect
                                </button>
                            </div>
                            <div class="form-text mt-2">
                                <i class="bi bi-shield-lock me-1"></i>Your token is stored securely in the <code>.env</code> file and never shared.
                            </div>
                        </form>
                    @endif
                </div>
            </div>
        </div>

        {{-- Step 2: Enter Figma URL --}}
        <div class="col-lg-8 mb-4">
            <div class="card">
                <div class="card-header bg-white py-3">
                    <h5 class="mb-0">
                        <i class="bi bi-link-45deg me-2"></i>Step 2: Import a Figma Design
                    </h5>
                </div>
                <div class="card-body">
                    <form action="{{ route('figma.fetch') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="figma_url" class="form-label">Figma File URL or File Key</label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="bi bi-figma"></i></span>
                                <input type="text" name="figma_url" id="figma_url" class="form-control"
                                    placeholder="https://www.figma.com/design/ABC123/MyDesign"
                                    value="{{ old('figma_url') }}" required>
                                <button type="submit" class="btn btn-figma" @if(!$hasToken) disabled @endif>
                                    <i class="bi bi-download me-1"></i>Fetch Design
                                </button>
                            </div>
                            <div class="form-text">
                                Paste a Figma file URL or just the file key (e.g., <code>ABC123xyz</code>).
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        {{-- How It Works --}}
        <div class="col-lg-8">
            <div class="card">
                <div class="card-header bg-white py-3">
                    <h5 class="mb-0"><i class="bi bi-info-circle me-2"></i>How It Works</h5>
                </div>
                <div class="card-body">
                    <div class="row text-center">
                        <div class="col-md-4 mb-3">
                            <div class="rounded-circle bg-primary bg-opacity-10 d-inline-flex align-items-center justify-content-center mb-3" style="width:64px;height:64px;">
                                <i class="bi bi-key fs-4 text-primary"></i>
                            </div>
                            <h6>1. Connect</h6>
                            <small class="text-muted">Add your Figma API token to authenticate</small>
                        </div>
                        <div class="col-md-4 mb-3">
                            <div class="rounded-circle bg-primary bg-opacity-10 d-inline-flex align-items-center justify-content-center mb-3" style="width:64px;height:64px;">
                                <i class="bi bi-cloud-download fs-4 text-primary"></i>
                            </div>
                            <h6>2. Fetch</h6>
                            <small class="text-muted">Paste a Figma URL and we fetch the design data</small>
                        </div>
                        <div class="col-md-4 mb-3">
                            <div class="rounded-circle bg-primary bg-opacity-10 d-inline-flex align-items-center justify-content-center mb-3" style="width:64px;height:64px;">
                                <i class="bi bi-code-slash fs-4 text-primary"></i>
                            </div>
                            <h6>3. Convert</h6>
                            <small class="text-muted">Get clean HTML + CSS with Bootstrap styling</small>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

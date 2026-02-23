<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Figma to Code') - Vacation</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
            min-height: 100vh;
        }
        .navbar-brand {
            font-weight: 700;
            letter-spacing: -0.5px;
        }
        .figma-logo {
            width: 24px;
            height: 24px;
            margin-right: 8px;
        }
        .card {
            border: none;
            box-shadow: 0 1px 3px rgba(0,0,0,0.08);
        }
        .code-block {
            background: #1e1e1e;
            color: #d4d4d4;
            border-radius: 8px;
            padding: 1rem;
            font-family: 'Fira Code', 'Consolas', monospace;
            font-size: 0.85rem;
            overflow-x: auto;
            max-height: 500px;
            overflow-y: auto;
        }
        .preview-frame {
            border: 1px solid #dee2e6;
            border-radius: 8px;
            background: white;
            min-height: 400px;
        }
        .btn-figma {
            background-color: #0d99ff;
            border-color: #0d99ff;
            color: white;
        }
        .btn-figma:hover {
            background-color: #0b87e0;
            border-color: #0b87e0;
            color: white;
        }
        .hero-section {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 3rem 0;
            margin-bottom: 2rem;
        }
        @yield('styles')
    </style>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container">
            <a class="navbar-brand" href="{{ route('figma.index') }}">
                <i class="bi bi-palette me-2"></i>Figma to Code
            </a>
            <div class="navbar-nav ms-auto">
                <a class="nav-link" href="{{ route('figma.index') }}">
                    <i class="bi bi-house me-1"></i>Home
                </a>
            </div>
        </div>
    </nav>

    @if(session('success'))
        <div class="container mt-3">
            <div class="alert alert-success alert-dismissible fade show">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        </div>
    @endif

    @if($errors->any())
        <div class="container mt-3">
            <div class="alert alert-danger alert-dismissible fade show">
                <ul class="mb-0">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        </div>
    @endif

    @yield('content')

    <footer class="py-4 mt-5 bg-dark text-white">
        <div class="container text-center">
            <small class="text-muted">Figma to Code Converter &mdash; Built with Laravel &amp; Bootstrap</small>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    @yield('scripts')
</body>
</html>

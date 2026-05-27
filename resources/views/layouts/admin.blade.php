<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Admin') — BlogYaari</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
    <style>
        body { background: #f4f6f9; }
        .sidebar {
            min-height: 100vh;
            background: #1a1a2e;
            width: 240px;
            position: fixed;
            top: 0; left: 0;
            padding-top: 1rem;
            z-index: 100;
        }
        .sidebar .brand {
            color: #e94560;
            font-size: 1.4rem;
            font-weight: 700;
            padding: 1rem 1.5rem 1.5rem;
            display: block;
            text-decoration: none;
        }
        .sidebar .nav-link {
            color: #adb5bd;
            padding: .6rem 1.5rem;
            border-radius: 0;
            font-size: .95rem;
        }
        .sidebar .nav-link:hover, .sidebar .nav-link.active {
            color: #fff;
            background: rgba(233,69,96,.15);
            border-left: 3px solid #e94560;
        }
        .main-content {
            margin-left: 240px;
            min-height: 100vh;
        }
        .topbar {
            background: #fff;
            border-bottom: 1px solid #dee2e6;
            padding: .75rem 1.5rem;
        }
        @media (max-width: 768px) {
            .sidebar { position: static; width: 100%; min-height: auto; }
            .main-content { margin-left: 0; }
        }
    </style>
    @stack('styles')
</head>
<body>
    <div class="sidebar d-flex flex-column">
        <a href="{{ route('admin.dashboard') }}" class="brand">
            <i class="bi bi-journal-richtext"></i> BlogYaari
        </a>
        <nav class="nav flex-column">
            <a href="{{ route('admin.dashboard') }}"
               class="nav-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                <i class="bi bi-speedometer2 me-2"></i> Dashboard
            </a>
            <a href="{{ Route::has('admin.blogs.index') ? route('admin.blogs.index') : '#' }}"
               class="nav-link {{ request()->routeIs('admin.blogs.*') ? 'active' : '' }}">
                <i class="bi bi-file-earmark-text me-2"></i> Blogs
            </a>
            <a href="{{ Route::has('admin.categories.index') ? route('admin.categories.index') : '#' }}"
               class="nav-link {{ request()->routeIs('admin.categories.*') ? 'active' : '' }}">
                <i class="bi bi-tags me-2"></i> Categories
            </a>
        </nav>
        <div class="mt-auto p-3">
            <form method="POST" action="{{ route('admin.logout') }}">
                @csrf
                <button class="btn btn-outline-danger btn-sm w-100">
                    <i class="bi bi-box-arrow-right me-1"></i> Logout
                </button>
            </form>
        </div>
    </div>

    <div class="main-content">
        <div class="topbar d-flex align-items-center justify-content-between">
            <h6 class="mb-0 fw-semibold">@yield('page-title', 'Dashboard')</h6>
            <span class="text-muted small"><i class="bi bi-person-circle me-1"></i>{{ auth()->user()->name }}</span>
        </div>
        <div class="p-4">
            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif
            @if(session('error'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    {{ session('error') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif
            @yield('content')
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    @stack('scripts')
</body>
</html>

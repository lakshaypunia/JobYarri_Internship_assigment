<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'BlogYaari') — Stay Updated</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
    <style>
        :root { --accent: #e94560; }
        body { background: #f8f9fa; font-family: 'Segoe UI', sans-serif; }

        /* Navbar */
        .navbar { background: #1a1a2e; }
        .navbar-brand { color: var(--accent) !important; font-weight: 700; font-size: 1.4rem; }
        .navbar-nav .nav-link { color: #adb5bd !important; }
        .navbar-nav .nav-link:hover { color: #fff !important; }

        /* Hero */
        .hero {
            background: linear-gradient(135deg, #1a1a2e 0%, #16213e 60%, #0f3460 100%);
            padding: 4rem 0 3rem;
            color: #fff;
        }
        .hero h1 { font-size: 2.2rem; font-weight: 700; }
        .hero p { color: #adb5bd; }

        /* Search bar */
        .search-input { border-radius: 50px 0 0 50px; border-right: 0; }
        .search-btn {
            border-radius: 0 50px 50px 0;
            background: var(--accent);
            border-color: var(--accent);
            color: #fff;
        }
        .search-btn:hover { background: #c73652; border-color: #c73652; color: #fff; }

        /* Filter pills */
        .filter-pill {
            border-radius: 50px;
            font-size: .85rem;
            padding: .35rem 1rem;
            border: 1px solid #dee2e6;
            background: #fff;
            color: #495057;
            cursor: pointer;
            transition: all .2s;
        }
        .filter-pill:hover, .filter-pill.active {
            background: var(--accent);
            border-color: var(--accent);
            color: #fff;
        }

        /* Blog card */
        .blog-card { border: none; border-radius: 12px; overflow: hidden; transition: transform .2s, box-shadow .2s; }
        .blog-card:hover { transform: translateY(-4px); box-shadow: 0 12px 30px rgba(0,0,0,.1); }
        .blog-card img { height: 200px; object-fit: cover; width: 100%; }
        .blog-card .card-img-placeholder {
            height: 200px;
            background: linear-gradient(135deg, #1a1a2e, #0f3460);
            display: flex; align-items: center; justify-content: center;
        }
        .category-badge {
            background: var(--accent);
            color: #fff;
            font-size: .75rem;
            padding: .2rem .65rem;
            border-radius: 50px;
        }
        .read-more {
            color: var(--accent);
            font-weight: 600;
            text-decoration: none;
            font-size: .9rem;
        }
        .read-more:hover { color: #c73652; }

        /* Footer */
        footer { background: #1a1a2e; color: #adb5bd; }

        /* Spinner */
        #loading { display: none; }
    </style>
    @stack('styles')
</head>
<body>
    <nav class="navbar navbar-expand-lg">
        <div class="container">
            <a class="navbar-brand" href="{{ route('blogs.index') }}">
                <i class="bi bi-journal-richtext me-1"></i>BlogYaari
            </a>
            <button class="navbar-toggler border-secondary" type="button"
                    data-bs-toggle="collapse" data-bs-target="#navMenu">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navMenu">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('blogs.index') }}">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('admin.login') }}">Admin</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    @yield('content')

    <footer class="py-4 mt-5">
        <div class="container text-center">
            <p class="mb-0 small">&copy; {{ date('Y') }} BlogYaari. All rights reserved.</p>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    @stack('scripts')
</body>
</html>

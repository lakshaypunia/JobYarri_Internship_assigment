<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'BlogYaari') — Stay Updated</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
    <style>
        :root {
            --accent:       #e94560;
            --accent-dark:  #c73652;
            --navy:         #0f172a;
            --navy-mid:     #1e293b;
            --surface:      #f8fafc;
            --card-bg:      #ffffff;
            --text:         #1e293b;
            --text-muted:   #64748b;
            --border:       #e2e8f0;
            --radius-lg:    16px;
            --radius-xl:    24px;
            --shadow-sm:    0 1px 3px rgba(0,0,0,.06), 0 1px 2px rgba(0,0,0,.04);
            --shadow-md:    0 4px 16px rgba(0,0,0,.08);
            --shadow-hover: 0 20px 40px rgba(0,0,0,.12);
        }

        * { box-sizing: border-box; }

        body {
            font-family: 'Inter', sans-serif;
            background: var(--surface);
            color: var(--text);
            -webkit-font-smoothing: antialiased;
        }

        /* ── Navbar ───────────────────────────────────────── */
        .navbar {
            background: rgba(15, 23, 42, 0.92);
            backdrop-filter: blur(16px);
            -webkit-backdrop-filter: blur(16px);
            border-bottom: 1px solid rgba(255,255,255,.06);
            padding: .85rem 0;
            transition: background .3s;
        }
        .navbar-brand {
            font-weight: 800;
            font-size: 1.35rem;
            color: var(--accent) !important;
            letter-spacing: -.5px;
        }
        .navbar-brand span { color: #fff; }
        .navbar-nav .nav-link {
            color: rgba(255,255,255,.65) !important;
            font-size: .9rem;
            font-weight: 500;
            padding: .4rem .9rem !important;
            border-radius: 8px;
            transition: color .2s, background .2s;
        }
        .navbar-nav .nav-link:hover {
            color: #fff !important;
            background: rgba(255,255,255,.08);
        }
        .navbar-toggler { border: 1px solid rgba(255,255,255,.2); }
        .navbar-toggler-icon { filter: invert(1); }

        /* ── Hero ─────────────────────────────────────────── */
        .hero {
            position: relative;
            overflow: hidden;
            background: var(--navy);
            padding: 5rem 0 4rem;
            color: #fff;
        }
        .hero::before {
            content: '';
            position: absolute;
            inset: 0;
            background:
                radial-gradient(ellipse 80% 60% at 20% 50%, rgba(233,69,96,.18) 0%, transparent 60%),
                radial-gradient(ellipse 60% 80% at 80% 20%, rgba(99,102,241,.15) 0%, transparent 60%),
                radial-gradient(ellipse 50% 50% at 60% 80%, rgba(14,165,233,.1) 0%, transparent 60%);
        }
        .hero-grid {
            position: absolute;
            inset: 0;
            background-image:
                linear-gradient(rgba(255,255,255,.03) 1px, transparent 1px),
                linear-gradient(90deg, rgba(255,255,255,.03) 1px, transparent 1px);
            background-size: 40px 40px;
        }
        .hero-content { position: relative; z-index: 2; }
        .hero-eyebrow {
            display: inline-flex;
            align-items: center;
            gap: .5rem;
            background: rgba(233,69,96,.15);
            border: 1px solid rgba(233,69,96,.3);
            color: #fca5a5;
            font-size: .78rem;
            font-weight: 600;
            letter-spacing: .08em;
            text-transform: uppercase;
            padding: .35rem .9rem;
            border-radius: 50px;
            margin-bottom: 1.5rem;
        }
        .hero h1 {
            font-size: clamp(2rem, 5vw, 3.2rem);
            font-weight: 800;
            line-height: 1.15;
            letter-spacing: -1.5px;
            margin-bottom: 1rem;
        }
        .hero h1 .highlight {
            background: linear-gradient(135deg, #e94560, #f97316);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }
        .hero p {
            color: rgba(255,255,255,.55);
            font-size: clamp(.9rem, 2vw, 1.05rem);
            max-width: 520px;
            line-height: 1.7;
        }

        /* ── Search ───────────────────────────────────────── */
        .search-wrap {
            position: relative;
            max-width: 540px;
        }
        .search-wrap .bi-search {
            position: absolute;
            left: 1.1rem;
            top: 50%;
            transform: translateY(-50%);
            color: var(--text-muted);
            font-size: 1rem;
            pointer-events: none;
        }
        #searchInput {
            width: 100%;
            padding: .85rem 1rem .85rem 3rem;
            border-radius: 50px;
            border: 1.5px solid rgba(255,255,255,.12);
            background: rgba(255,255,255,.08);
            color: #fff;
            font-size: .95rem;
            font-family: 'Inter', sans-serif;
            backdrop-filter: blur(8px);
            transition: border .25s, background .25s;
            outline: none;
        }
        #searchInput::placeholder { color: rgba(255,255,255,.35); }
        #searchInput:focus {
            border-color: rgba(233,69,96,.6);
            background: rgba(255,255,255,.12);
        }

        /* ── Filter bar ───────────────────────────────────── */
        .filter-bar {
            background: var(--card-bg);
            border-bottom: 1px solid var(--border);
            padding: .85rem 0;
            top: 65px;
            z-index: 90;
        }
        .pills-scroll {
            display: flex;
            gap: .5rem;
            overflow-x: auto;
            scrollbar-width: none;
            -ms-overflow-style: none;
            padding-bottom: 2px;
        }
        .pills-scroll::-webkit-scrollbar { display: none; }
        .filter-pill {
            flex-shrink: 0;
            border-radius: 50px;
            font-size: .82rem;
            font-weight: 500;
            padding: .4rem 1.1rem;
            border: 1.5px solid var(--border);
            background: transparent;
            color: var(--text-muted);
            cursor: pointer;
            transition: all .2s cubic-bezier(.4,0,.2,1);
            white-space: nowrap;
            font-family: 'Inter', sans-serif;
        }
        .filter-pill:hover {
            border-color: var(--accent);
            color: var(--accent);
            background: rgba(233,69,96,.05);
        }
        .filter-pill.active {
            background: var(--accent);
            border-color: var(--accent);
            color: #fff;
            box-shadow: 0 4px 12px rgba(233,69,96,.3);
        }
        #dateFilter {
            font-size: .82rem;
            font-family: 'Inter', sans-serif;
            border: 1.5px solid var(--border);
            border-radius: 50px;
            padding: .38rem 1rem;
            color: var(--text-muted);
            outline: none;
            transition: border .2s;
        }
        #dateFilter:focus { border-color: var(--accent); }

        /* ── Blog cards ───────────────────────────────────── */
        .blog-card {
            background: var(--card-bg);
            border: 1px solid var(--border);
            border-radius: var(--radius-lg);
            overflow: hidden;
            transition: transform .25s cubic-bezier(.4,0,.2,1), box-shadow .25s;
            height: 100%;
        }
        .blog-card:hover {
            transform: translateY(-6px);
            box-shadow: var(--shadow-hover);
            border-color: transparent;
        }
        .card-img-wrap {
            position: relative;
            height: 210px;
            overflow: hidden;
            background: linear-gradient(135deg, #0f172a 0%, #1e3a5f 100%);
        }
        .card-img-wrap img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform .4s cubic-bezier(.4,0,.2,1);
        }
        .blog-card:hover .card-img-wrap img { transform: scale(1.05); }
        .card-img-overlay-badge {
            position: absolute;
            top: 12px;
            left: 12px;
        }
        .card-img-placeholder {
            height: 100%;
            display: flex;
            align-items: center;
            justify-content: center;
            background: linear-gradient(135deg, #0f172a 0%, #1e3a5f 100%);
        }
        .category-badge {
            display: inline-block;
            background: var(--accent);
            color: #fff;
            font-size: .72rem;
            font-weight: 600;
            padding: .25rem .75rem;
            border-radius: 50px;
            letter-spacing: .02em;
        }
        .blog-card .card-body {
            padding: 1.3rem;
            display: flex;
            flex-direction: column;
        }
        .blog-card .card-title {
            font-size: .97rem;
            font-weight: 700;
            line-height: 1.45;
            color: var(--text);
            margin-bottom: .5rem;
        }
        .blog-card .card-text {
            font-size: .83rem;
            color: var(--text-muted);
            line-height: 1.6;
            flex-grow: 1;
        }
        .card-meta {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-top: 1rem;
            padding-top: .85rem;
            border-top: 1px solid var(--border);
        }
        .card-date {
            font-size: .78rem;
            color: var(--text-muted);
            display: flex;
            align-items: center;
            gap: .3rem;
        }
        .read-more {
            font-size: .8rem;
            font-weight: 600;
            color: var(--accent);
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: .3rem;
            transition: gap .2s;
        }
        .read-more:hover { color: var(--accent-dark); gap: .55rem; }

        /* ── Footer ───────────────────────────────────────── */
        footer {
            background: var(--navy);
            color: rgba(255,255,255,.4);
            border-top: 1px solid rgba(255,255,255,.06);
        }
        footer a { color: rgba(255,255,255,.55); text-decoration: none; }
        footer a:hover { color: #fff; }

        /* ── Spinner ──────────────────────────────────────── */
        #loading { display: none; }
        .spinner-border { color: var(--accent) !important; }

        /* ── Section heading ──────────────────────────────── */
        .section-heading {
            font-size: 1.25rem;
            font-weight: 700;
            color: var(--text);
            letter-spacing: -.4px;
        }
        .section-count {
            font-size: .82rem;
            color: var(--text-muted);
            font-weight: 400;
        }
    </style>
    @stack('styles')
</head>
<body>
    <nav class="navbar navbar-expand-lg sticky-top">
        <div class="container">
            <a class="navbar-brand" href="{{ route('blogs.index') }}">
                <i class="bi bi-journal-richtext me-1"></i>Blog<span>Yaari</span>
            </a>
            <button class="navbar-toggler" type="button"
                    data-bs-toggle="collapse" data-bs-target="#navMenu">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navMenu">
                <ul class="navbar-nav ms-auto gap-1">
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('blogs.index') }}">
                            <i class="bi bi-house me-1"></i>Home
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('admin.login') }}">
                            <i class="bi bi-shield-lock me-1"></i>Admin
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    @yield('content')

    <footer class="py-5 mt-5">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-md-6 mb-3 mb-md-0">
                    <div class="fw-700 fs-5 mb-1" style="color:var(--accent);font-weight:800">
                        <i class="bi bi-journal-richtext me-1"></i>BlogYaari
                    </div>
                    <p class="mb-0 small">Your one-stop for admit cards, results & job updates.</p>
                </div>
                <div class="col-md-6 text-md-end">
                    <p class="mb-0 small">&copy; {{ date('Y') }} BlogYaari. All rights reserved.</p>
                </div>
            </div>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    @stack('scripts')
</body>
</html>

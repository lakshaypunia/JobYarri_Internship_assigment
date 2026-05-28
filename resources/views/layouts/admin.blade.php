<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Admin') — BlogYaari</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
    <style>
        *, *::before, *::after { box-sizing: border-box; }
        :root {
            --sidebar-w: 260px;
            --indigo:    #6366f1;
            --indigo-lt: #818cf8;
            --danger:    #ef4444;
            --success:   #10b981;
            --warning:   #f59e0b;
            --sidebar-bg:#0a0f1e;
            --content-bg:#f0f2f7;
            --card-bg:   #ffffff;
            --border:    #e2e8f0;
            --text:      #0f172a;
            --muted:     #64748b;
        }
        body {
            font-family: 'Inter', sans-serif;
            background: var(--content-bg);
            color: var(--text);
            min-height: 100vh;
            -webkit-font-smoothing: antialiased;
        }

        /* ── Sidebar (desktop) ─────────────────────────────── */
        .sidebar {
            position: fixed; top: 0; left: 0;
            width: var(--sidebar-w);
            height: 100vh;
            background: var(--sidebar-bg);
            display: flex; flex-direction: column;
            z-index: 200;
            border-right: 1px solid rgba(255,255,255,.04);
        }
        .sidebar::before {
            content: '';
            position: absolute; inset: 0;
            background: radial-gradient(ellipse 80% 50% at 50% 0%, rgba(99,102,241,.15) 0%, transparent 70%);
            pointer-events: none;
        }
        .sb-brand {
            padding: 1.6rem 1.5rem 1.2rem;
            display: flex; align-items: center; gap: .85rem;
            text-decoration: none;
            border-bottom: 1px solid rgba(255,255,255,.05);
            margin-bottom: .5rem;
            position: relative; z-index: 1;
        }
        .sb-brand-icon {
            width: 38px; height: 38px;
            background: linear-gradient(135deg, var(--indigo), #e94560);
            border-radius: 10px;
            display: flex; align-items: center; justify-content: center;
            font-size: 1rem; color: #fff;
            flex-shrink: 0;
        }
        .sb-brand-name {
            font-size: 1.1rem; font-weight: 800;
            color: #fff; letter-spacing: -.4px;
        }
        .sb-brand-sub { font-size: .68rem; color: rgba(255,255,255,.35); font-weight: 400; display: block; }

        .sb-section-label {
            font-size: .65rem; font-weight: 700; letter-spacing: .1em;
            text-transform: uppercase; color: rgba(255,255,255,.25);
            padding: .8rem 1.5rem .4rem;
            position: relative; z-index: 1;
        }
        .sb-nav { flex-grow: 1; padding: 0 .75rem; position: relative; z-index: 1; }
        .sb-link {
            display: flex; align-items: center; gap: .75rem;
            padding: .65rem .85rem;
            border-radius: 10px;
            color: rgba(255,255,255,.5);
            text-decoration: none;
            font-size: .875rem; font-weight: 500;
            margin-bottom: .15rem;
            transition: all .2s;
            position: relative;
        }
        .sb-link:hover {
            color: rgba(255,255,255,.85);
            background: rgba(255,255,255,.06);
        }
        .sb-link.active {
            color: #fff;
            background: rgba(99,102,241,.2);
        }
        .sb-link.active::before {
            content: '';
            position: absolute; left: 0; top: 25%; bottom: 25%;
            width: 3px; border-radius: 0 2px 2px 0;
            background: var(--indigo-lt);
        }
        .sb-link-icon {
            width: 30px; height: 30px; flex-shrink: 0;
            display: flex; align-items: center; justify-content: center;
            border-radius: 8px;
            font-size: .95rem;
            background: rgba(255,255,255,.06);
            transition: background .2s;
        }
        .sb-link.active .sb-link-icon { background: rgba(99,102,241,.3); color: var(--indigo-lt); }
        .sb-link:hover .sb-link-icon { background: rgba(255,255,255,.1); }

        .sb-footer {
            padding: 1rem .75rem 1.2rem;
            border-top: 1px solid rgba(255,255,255,.05);
            position: relative; z-index: 1;
        }
        .sb-user {
            display: flex; align-items: center; gap: .75rem;
            padding: .6rem .85rem;
            border-radius: 10px;
            margin-bottom: .5rem;
            background: rgba(255,255,255,.04);
        }
        .sb-avatar {
            width: 34px; height: 34px;
            background: linear-gradient(135deg, var(--indigo), #e94560);
            border-radius: 50%;
            display: flex; align-items: center; justify-content: center;
            font-size: .85rem; color: #fff; font-weight: 700; flex-shrink: 0;
        }
        .sb-user-name { font-size: .82rem; font-weight: 600; color: rgba(255,255,255,.8); }
        .sb-user-role { font-size: .7rem; color: rgba(255,255,255,.3); }
        .sb-logout {
            width: 100%; padding: .55rem;
            background: rgba(239,68,68,.1);
            border: 1px solid rgba(239,68,68,.2);
            border-radius: 10px; color: #fca5a5;
            font-size: .8rem; font-weight: 600;
            font-family: 'Inter', sans-serif;
            cursor: pointer; transition: all .2s;
            display: flex; align-items: center; justify-content: center; gap: .5rem;
        }
        .sb-logout:hover { background: rgba(239,68,68,.2); color: #fff; }

        /* ── Mobile top bar ──────────────────────────────────── */
        .mob-bar {
            display: none;
            position: sticky; top: 0; z-index: 300;
            background: var(--sidebar-bg);
            border-bottom: 1px solid rgba(255,255,255,.05);
            padding: .8rem 1rem;
            align-items: center; justify-content: space-between;
        }
        .mob-bar-brand {
            display: flex; align-items: center; gap: .6rem;
            text-decoration: none;
        }
        .mob-bar-icon {
            width: 32px; height: 32px;
            background: linear-gradient(135deg, var(--indigo), #e94560);
            border-radius: 8px;
            display: flex; align-items: center; justify-content: center;
            font-size: .85rem; color: #fff;
        }
        .mob-bar-name { font-size: 1rem; font-weight: 800; color: #fff; }
        .mob-ham {
            background: rgba(255,255,255,.08);
            border: 1px solid rgba(255,255,255,.1);
            border-radius: 8px;
            width: 38px; height: 38px;
            display: flex; align-items: center; justify-content: center;
            color: rgba(255,255,255,.7); font-size: 1.1rem; cursor: pointer;
        }

        /* ── Offcanvas sidebar (mobile) ───────────────────────── */
        .offcanvas-sidebar {
            background: var(--sidebar-bg) !important;
            width: 260px !important;
        }

        /* ── Main content ─────────────────────────────────────── */
        .main-content { margin-left: var(--sidebar-w); min-height: 100vh; }

        .topbar {
            background: var(--card-bg);
            border-bottom: 1px solid var(--border);
            padding: 1rem 1.75rem;
            display: flex; align-items: center; justify-content: space-between;
            position: sticky; top: 0; z-index: 100;
        }
        .topbar-title { font-size: 1rem; font-weight: 700; color: var(--text); }
        .topbar-badge {
            display: flex; align-items: center; gap: .5rem;
            background: #f8fafc; border: 1px solid var(--border);
            border-radius: 50px; padding: .3rem .8rem;
            font-size: .78rem; color: var(--muted); font-weight: 500;
        }
        .topbar-badge .dot {
            width: 7px; height: 7px; border-radius: 50%;
            background: var(--success);
            box-shadow: 0 0 0 2px rgba(16,185,129,.25);
        }
        .content-wrap { padding: 1.75rem; }

        /* ── Responsive ───────────────────────────────────────── */
        @media (max-width: 767.98px) {
            .sidebar { display: none; }
            .main-content { margin-left: 0; }
            .mob-bar { display: flex; }
            .topbar { top: 57px; }
            .content-wrap { padding: 1rem; }
        }
    </style>
    @stack('styles')
</head>
<body>

{{-- Mobile bar --}}
<div class="mob-bar">
    <a href="{{ route('admin.dashboard') }}" class="mob-bar-brand">
        <div class="mob-bar-icon"><i class="bi bi-journal-richtext"></i></div>
        <span class="mob-bar-name">BlogYaari</span>
    </a>
    <div class="mob-ham" data-bs-toggle="offcanvas" data-bs-target="#mobSidebar">
        <i class="bi bi-list"></i>
    </div>
</div>

{{-- Mobile offcanvas --}}
<div class="offcanvas offcanvas-start offcanvas-sidebar" tabindex="-1" id="mobSidebar">
    <div class="offcanvas-header border-bottom" style="border-color:rgba(255,255,255,.05)!important">
        <div class="sb-brand" style="padding:0;border:none;margin:0">
            <div class="sb-brand-icon"><i class="bi bi-journal-richtext"></i></div>
            <div><span class="sb-brand-name">BlogYaari</span></div>
        </div>
        <button class="btn-close btn-close-white" data-bs-dismiss="offcanvas"></button>
    </div>
    <div class="offcanvas-body p-0 d-flex flex-column" style="background:var(--sidebar-bg)">
        <div class="sb-nav pt-2">
            <a href="{{ route('admin.dashboard') }}" class="sb-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                <span class="sb-link-icon"><i class="bi bi-grid"></i></span> Dashboard
            </a>
            <a href="{{ route('admin.blogs.index') }}" class="sb-link {{ request()->routeIs('admin.blogs.*') ? 'active' : '' }}">
                <span class="sb-link-icon"><i class="bi bi-file-earmark-text"></i></span> Blogs
            </a>
            <a href="{{ route('admin.categories.index') }}" class="sb-link {{ request()->routeIs('admin.categories.*') ? 'active' : '' }}">
                <span class="sb-link-icon"><i class="bi bi-tags"></i></span> Categories
            </a>
        </div>
        <div class="sb-footer mt-auto">
            <div class="sb-user">
                <div class="sb-avatar">{{ strtoupper(substr(auth()->user()->name, 0, 1)) }}</div>
                <div><div class="sb-user-name">{{ auth()->user()->name }}</div><div class="sb-user-role">Administrator</div></div>
            </div>
            <form method="POST" action="{{ route('admin.logout') }}">
                @csrf
                <button class="sb-logout"><i class="bi bi-box-arrow-right"></i> Sign Out</button>
            </form>
        </div>
    </div>
</div>

{{-- Desktop sidebar --}}
<div class="sidebar">
    <a href="{{ route('admin.dashboard') }}" class="sb-brand">
        <div class="sb-brand-icon"><i class="bi bi-journal-richtext"></i></div>
        <div>
            <span class="sb-brand-name">BlogYaari</span>
            <span class="sb-brand-sub">Admin Panel</span>
        </div>
    </a>

    <div class="sb-section-label">Main Menu</div>
    <div class="sb-nav">
        <a href="{{ route('admin.dashboard') }}" class="sb-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
            <span class="sb-link-icon"><i class="bi bi-grid"></i></span> Dashboard
        </a>
        <a href="{{ route('admin.blogs.index') }}" class="sb-link {{ request()->routeIs('admin.blogs.*') ? 'active' : '' }}">
            <span class="sb-link-icon"><i class="bi bi-file-earmark-text"></i></span> Blogs
        </a>
        <a href="{{ route('admin.categories.index') }}" class="sb-link {{ request()->routeIs('admin.categories.*') ? 'active' : '' }}">
            <span class="sb-link-icon"><i class="bi bi-tags"></i></span> Categories
        </a>
        <div class="sb-section-label" style="padding-left:0;margin-top:.5rem">Site</div>
        <a href="{{ route('blogs.index') }}" target="_blank" class="sb-link">
            <span class="sb-link-icon"><i class="bi bi-globe2"></i></span> View Site
        </a>
    </div>

    <div class="sb-footer">
        <div class="sb-user">
            <div class="sb-avatar">{{ strtoupper(substr(auth()->user()->name, 0, 1)) }}</div>
            <div>
                <div class="sb-user-name">{{ auth()->user()->name }}</div>
                <div class="sb-user-role">Administrator</div>
            </div>
        </div>
        <form method="POST" action="{{ route('admin.logout') }}">
            @csrf
            <button class="sb-logout"><i class="bi bi-box-arrow-right"></i> Sign Out</button>
        </form>
    </div>
</div>

{{-- Main content --}}
<div class="main-content">
    <div class="topbar">
        <span class="topbar-title">@yield('page-title', 'Dashboard')</span>
        <div class="topbar-badge">
            <span class="dot"></span> Live
        </div>
    </div>
    <div class="content-wrap">
        @if(session('success'))
        <div class="alert d-flex align-items-center gap-2 mb-4"
             style="background:#ecfdf5;border:1px solid #a7f3d0;color:#065f46;border-radius:12px">
            <i class="bi bi-check-circle-fill" style="color:#10b981"></i>
            {{ session('success') }}
            <button type="button" class="btn-close ms-auto" data-bs-dismiss="alert" style="filter:none"></button>
        </div>
        @endif
        @if(session('error'))
        <div class="alert d-flex align-items-center gap-2 mb-4"
             style="background:#fef2f2;border:1px solid #fecaca;color:#991b1b;border-radius:12px">
            <i class="bi bi-exclamation-circle-fill" style="color:#ef4444"></i>
            {{ session('error') }}
            <button type="button" class="btn-close ms-auto" data-bs-dismiss="alert"></button>
        </div>
        @endif
        @yield('content')
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
@stack('scripts')

<script>
// Universal loading state for all admin form submit buttons
document.addEventListener('submit', function (e) {
    var form = e.target;
    var btn  = form.querySelector('[type="submit"][data-loading]');
    if (!btn) return;

    // Use requestAnimationFrame so the form data is captured before disabling
    requestAnimationFrame(function () {
        var icon = btn.querySelector('i');
        var span = btn.querySelector('span');
        btn.disabled     = true;
        btn.style.opacity = '0.72';
        if (icon) icon.className = 'spinner-border spinner-border-sm';
        if (span) span.textContent = btn.getAttribute('data-loading');
        else      btn.textContent  = btn.getAttribute('data-loading');
    });
});
</script>
</body>
</html>

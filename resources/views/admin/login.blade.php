<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login — BlogYaari</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
    <style>
        *, *::before, *::after { box-sizing: border-box; }
        body {
            font-family: 'Inter', sans-serif;
            min-height: 100vh;
            margin: 0;
            display: flex;
            background: #f0f2f7;
            -webkit-font-smoothing: antialiased;
        }

        /* ── Left panel ── */
        .login-left {
            flex: 1;
            background: #0a0f1e;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: flex-start;
            padding: 4rem;
            position: relative;
            overflow: hidden;
        }
        .login-left::before {
            content: '';
            position: absolute; inset: 0;
            background:
                radial-gradient(ellipse 70% 60% at 20% 30%, rgba(99,102,241,.25) 0%, transparent 60%),
                radial-gradient(ellipse 50% 50% at 80% 70%, rgba(233,69,96,.18) 0%, transparent 60%);
        }
        .login-left-grid {
            position: absolute; inset: 0;
            background-image:
                linear-gradient(rgba(255,255,255,.03) 1px, transparent 1px),
                linear-gradient(90deg, rgba(255,255,255,.03) 1px, transparent 1px);
            background-size: 48px 48px;
        }
        .login-left-content { position: relative; z-index: 2; }
        .login-brand {
            display: flex; align-items: center; gap: .75rem;
            margin-bottom: 3.5rem;
        }
        .login-brand-icon {
            width: 44px; height: 44px;
            background: linear-gradient(135deg, #6366f1, #e94560);
            border-radius: 12px;
            display: flex; align-items: center; justify-content: center;
            font-size: 1.2rem;
            color: #fff;
        }
        .login-brand-name {
            font-size: 1.4rem;
            font-weight: 800;
            color: #fff;
            letter-spacing: -.5px;
        }
        .login-left h1 {
            font-size: clamp(1.9rem, 3vw, 2.6rem);
            font-weight: 800;
            color: #fff;
            line-height: 1.2;
            letter-spacing: -1px;
            margin-bottom: 1rem;
        }
        .login-left h1 span {
            background: linear-gradient(135deg, #818cf8, #e94560);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }
        .login-left p {
            color: rgba(255,255,255,.45);
            font-size: .95rem;
            line-height: 1.7;
            max-width: 360px;
            margin-bottom: 2.5rem;
        }
        .login-feature {
            display: flex; align-items: center; gap: .9rem;
            margin-bottom: 1rem;
        }
        .login-feature-dot {
            width: 32px; height: 32px; flex-shrink: 0;
            border-radius: 8px;
            display: flex; align-items: center; justify-content: center;
            font-size: .85rem;
        }
        .login-feature span {
            color: rgba(255,255,255,.6);
            font-size: .85rem;
            font-weight: 500;
        }

        /* ── Right panel ── */
        .login-right {
            width: 480px;
            flex-shrink: 0;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 3rem 3.5rem;
            background: #fff;
        }
        .login-form-wrap { width: 100%; }
        .login-form-wrap h2 {
            font-size: 1.7rem;
            font-weight: 800;
            color: #0f172a;
            letter-spacing: -.5px;
            margin-bottom: .4rem;
        }
        .login-form-wrap p {
            color: #94a3b8;
            font-size: .88rem;
            margin-bottom: 2rem;
        }

        .form-label {
            font-size: .82rem;
            font-weight: 600;
            color: #374151;
            margin-bottom: .4rem;
        }
        .form-field {
            position: relative;
        }
        .form-field .field-icon {
            position: absolute;
            left: 1rem; top: 50%;
            transform: translateY(-50%);
            color: #94a3b8;
            font-size: .95rem;
            pointer-events: none;
        }
        .form-field input {
            width: 100%;
            padding: .75rem 1rem .75rem 2.8rem;
            border: 1.5px solid #e2e8f0;
            border-radius: 12px;
            font-size: .9rem;
            font-family: 'Inter', sans-serif;
            color: #0f172a;
            background: #f8fafc;
            transition: border .2s, background .2s, box-shadow .2s;
            outline: none;
        }
        .form-field input:focus {
            border-color: #6366f1;
            background: #fff;
            box-shadow: 0 0 0 4px rgba(99,102,241,.1);
        }
        .form-field input.is-invalid { border-color: #ef4444; }

        .btn-signin {
            width: 100%;
            padding: .85rem;
            background: linear-gradient(135deg, #6366f1, #8b5cf6);
            border: none;
            border-radius: 12px;
            color: #fff;
            font-size: .95rem;
            font-weight: 700;
            font-family: 'Inter', sans-serif;
            cursor: pointer;
            transition: opacity .2s, transform .15s;
            display: flex; align-items: center; justify-content: center; gap: .5rem;
        }
        .btn-signin:hover { opacity: .92; transform: translateY(-1px); }
        .btn-signin:active { transform: translateY(0); }

        .alert-error {
            background: #fef2f2;
            border: 1px solid #fecaca;
            color: #dc2626;
            border-radius: 10px;
            padding: .75rem 1rem;
            font-size: .85rem;
            margin-bottom: 1.5rem;
            display: flex; align-items: center; gap: .5rem;
        }

        @media (max-width: 768px) {
            body { flex-direction: column; }
            .login-left { display: none; }
            .login-right { width: 100%; padding: 2.5rem 1.5rem; }
        }
    </style>
</head>
<body>

    {{-- Left branding panel --}}
    <div class="login-left">
        <div class="login-left-grid"></div>
        <div class="login-left-content">
            <div class="login-brand">
                <div class="login-brand-icon"><i class="bi bi-journal-richtext"></i></div>
                <span class="login-brand-name">BlogYaari</span>
            </div>
            <h1>Manage your<br><span>content with ease</span></h1>
            <p>A powerful admin panel to create, edit and publish blogs that keep your audience updated.</p>

            <div class="login-feature">
                <div class="login-feature-dot" style="background:rgba(99,102,241,.2)">
                    <i class="bi bi-pencil-square" style="color:#818cf8"></i>
                </div>
                <span>Create & edit blogs instantly</span>
            </div>
            <div class="login-feature">
                <div class="login-feature-dot" style="background:rgba(16,185,129,.15)">
                    <i class="bi bi-tags" style="color:#34d399"></i>
                </div>
                <span>Manage categories effortlessly</span>
            </div>
            <div class="login-feature">
                <div class="login-feature-dot" style="background:rgba(251,146,60,.15)">
                    <i class="bi bi-image" style="color:#fb923c"></i>
                </div>
                <span>Upload images & rich content</span>
            </div>
        </div>
    </div>

    {{-- Right form panel --}}
    <div class="login-right">
        <div class="login-form-wrap">
            <h2>Welcome back</h2>
            <p>Sign in to your admin dashboard</p>

            @if($errors->any())
            <div class="alert-error">
                <i class="bi bi-exclamation-circle-fill"></i>
                {{ $errors->first() }}
            </div>
            @endif

            <form method="POST" action="{{ route('admin.login.post') }}">
                @csrf
                <div class="mb-3">
                    <label class="form-label">Email address</label>
                    <div class="form-field">
                        <i class="bi bi-envelope field-icon"></i>
                        <input type="email" name="email" value="{{ old('email') }}"
                               placeholder="admin@blogyaari.com"
                               class="{{ $errors->has('email') ? 'is-invalid' : '' }}"
                               required autofocus>
                    </div>
                </div>
                <div class="mb-4">
                    <label class="form-label">Password</label>
                    <div class="form-field">
                        <i class="bi bi-lock field-icon"></i>
                        <input type="password" name="password"
                               placeholder="Enter your password" required>
                    </div>
                </div>
                <button type="submit" class="btn-signin">
                    <i class="bi bi-box-arrow-in-right"></i> Sign In
                </button>
            </form>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

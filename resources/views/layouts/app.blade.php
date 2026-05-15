<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ config('app.name', 'FleetOps') }} - @yield('title')</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/tailwindcss@3.4.4/dist/tailwind.min.css">
    <style>
        :root {
            color-scheme: light;
            font-family: Inter, system-ui, -apple-system, BlinkMacSystemFont, "Segoe UI", sans-serif;
        }
        :root { min-height: 100%; }
        * { box-sizing: border-box; }
        html, body { min-height: 100%; }
        body { margin: 0; min-height: 100vh; width: 100%; background: #dbeeff; color: #0f172a; overflow-x: hidden; }
        a { color: inherit; text-decoration: none; }
        button { font: inherit; }
        .app-header { background: #ffffff; border-bottom: 1px solid #e2e8f0; position: sticky; top: 0; z-index: 20; }
        .app-header .header-inner { display: flex; flex-wrap: wrap; align-items: center; justify-content: space-between; gap: 1rem; max-width: 1280px; margin: 0 auto; padding: 1rem 1.5rem; }
        .header-brand { font-weight: 700; font-size: 0.95rem; letter-spacing: 0.18em; text-transform: uppercase; color: #0f172a; }
        .header-nav { display: flex; flex-wrap: wrap; gap: 1rem; align-items: center; font-size: 0.95rem; color: #475569; }
        .header-nav a, .header-nav button { color: #475569; background: transparent; border: none; cursor: pointer; transition: color .2s ease, transform .2s ease; }
        .header-nav a:hover, .header-nav button:hover { color: #1d4ed8; }
        .app-layout { min-height: 100vh; display: flex; flex-direction: column; width: 100%; background: transparent; }
        .app-main { flex: 1; width: 100%; max-width: 1280px; margin: 0 auto; padding: 2rem 1rem; }
        .app-shell { display: grid; grid-template-columns: minmax(220px, 260px) minmax(0, 1fr); gap: 2rem; align-items: start; width: 100%; min-height: calc(100vh - 6.5rem); }
        .app-shell > * { min-width: 0; }
        .sidebar { display: flex; flex-direction: column; gap: 1rem; min-width: 0; max-width: 260px; width: 100%; }
        .sidebar-card { width: 100%; }
        .sidebar-footer { margin-top: auto; }
        .notification { background: #f8fafc; border: 1px solid #cbd5e1; border-radius: 1rem; padding: 1rem 1.25rem; margin-bottom: 1.5rem; color: #0f172a; }
        .notification-success { background: #ecfdf5; border-color: #a7f3d0; color: #166534; }
        .notification-warning { background: #fffbeb; border-color: #fcd34d; color: #92400e; }
        .notification-error { background: #fef2f2; border-color: #fca5a5; color: #991b1b; }
        .notification-error ul { margin: 0.75rem 0 0; padding-left: 1.25rem; }
        .notification-error li { margin-bottom: 0.35rem; }
        .app-shell { display: grid; grid-template-columns: 260px minmax(0, 1fr); gap: 2rem; align-items: start; min-height: 100vh; }
        .sidebar { display: flex; flex-direction: column; gap: 1rem; }
        .sidebar-card, .panel-card, .content-card { background: #ffffff; border: 1px solid #e2e8f0; border-radius: 1.75rem; box-shadow: 0 24px 60px rgba(15,23,42,0.08); padding: 1.35rem; }
        .sidebar-brand { display: flex; gap: 0.7rem; align-items: center; min-width: 0; }
        .sidebar-brand-copy { min-width: 0; }
        .sidebar-brand-icon { display: grid; place-items: center; width: 36px; height: 36px; border-radius: 0.75rem; background: #1d4ed8; color: #ffffff; font-weight: 700; flex-shrink: 0; }
        .sidebar-brand-icon svg { width: 18px; height: 18px; }
        .sidebar-brand-title { font-size: 0.9rem; text-transform: uppercase; letter-spacing: 0.2em; color: #0f172a; font-weight: 700; }
        .sidebar-brand-subtitle { font-size: 0.7rem; color: #64748b; margin-top: 0.2rem; letter-spacing: 0.1em; text-transform: uppercase; }
        .sidebar-nav { display: flex; flex-direction: column; gap: 0.35rem; margin-top: 1rem; }
        .sidebar-link { display: flex; align-items: center; gap: 0.65rem; padding: 0.72rem 0.85rem; border-radius: 1rem; color: #475569; transition: background .2s ease, color .2s ease; font-size: 0.92rem; background: transparent; }
        .sidebar-link:hover { background: #eff6ff; color: #1d4ed8; }
        .sidebar-link.active { background: #dbeafe; color: #1d4ed8; }
        .sidebar-link.active .sidebar-link-icon { background: #bfdbfe; color: #1d4ed8; }
        .sidebar-link-icon { display: grid; place-items: center; width: 28px; height: 28px; border-radius: 0.65rem; background: #e2e8f0; color: #475569; font-size: 0.85rem; flex-shrink: 0; }
        .sidebar-link-icon svg { width: 15px; height: 15px; }
        .sidebar-footer { margin-top: auto; padding-top: 1rem; border-top: 1px solid rgba(148, 163, 184, 0.08); }
        .sidebar-footer-title { font-weight: 700; color: #0f172a; margin-bottom: 0.2rem; font-size: 0.9rem; }
        .sidebar-footer-subtitle { font-size: 0.9rem; color: #64748b; }
        .sidebar-footer-button { display: inline-flex; align-items: center; justify-content: center; width: 100%; margin-top: 0.7rem; padding: 0.75rem 0.9rem; border: 1px solid rgba(148, 163, 184, 0.18); border-radius: 0.85rem; background: rgba(15, 23, 42, 0.64); color: #ffffff; font-weight: 600; font-size: 0.85rem; transition: background .2s ease, border-color .2s ease; }
        .sidebar-footer-button:hover { background: rgba(56, 189, 248, 0.18); border-color: rgba(56, 189, 248, 0.32); }
        .sidebar-footer-button svg { width: 1rem; height: 1rem; margin-right: 0.5rem; }
        .sidebar-signout-button { display: inline-flex; align-items: center; gap: 0.5rem; width: 100%; margin-top: 0.5rem; padding: 0.55rem 0.75rem; border: none; border-radius: 0.65rem; background: transparent; color: #475569; font-weight: 500; font-size: 0.85rem; cursor: pointer; transition: background .2s ease, color .2s ease; }
        .sidebar-signout-button:hover { background: #f1f5f9; color: #0f172a; }
        .sidebar-signout-button svg { width: 16px; height: 16px; flex-shrink: 0; }
        .sidebar-role-badge { display: inline-block; margin-top: 0.35rem; padding: 0.2rem 0.6rem; border-radius: 999px; background: #dbeafe; color: #1d4ed8; font-size: 0.72rem; font-weight: 600; }
        .badge { display: inline-flex; align-items: center; justify-content: center; padding: 0.55rem 0.95rem; border-radius: 999px; background: #bfdbfe; color: #1d4ed8; font-size: 0.72rem; font-weight: 700; letter-spacing: 0.18em; text-transform: uppercase; }
        .overview-card { display: grid; gap: 1.5rem; }
        .overview-header { display: flex; flex-direction: column; gap: 0.75rem; }
        .overview-subtitle { color: #64748b; font-size: 0.85rem; text-transform: uppercase; letter-spacing: 0.18em; }
        .overview-title { font-size: clamp(2rem, 2.5vw, 2.75rem); line-height: 1.05; margin: 0; color: #0f172a; }
        .overview-copy { color: #64748b; font-size: 1rem; max-width: 60ch; }
        .overview-tags { display: flex; flex-wrap: wrap; gap: 0.75rem; font-size: 0.85rem; color: #64748b; }
        .overview-tag { border: 1px solid #e2e8f0; border-radius: 999px; background: #eff6ff; padding: 0.75rem 1rem; }
        .metric-grid { display: grid; gap: 1.25rem; grid-template-columns: repeat(4, minmax(0, 1fr)); margin-top: 1.5rem; }
        .metric-card { border-radius: 1.5rem; background: #ffffff; border: 1px solid #e2e8f0; padding: 1.25rem; display: grid; gap: 0.75rem; }
        .metric-top { display: flex; justify-content: space-between; align-items: flex-start; }
        .metric-icon { display: grid; place-items: center; width: 28px; height: 28px; border-radius: 0.5rem; color: #94a3b8; flex-shrink: 0; }
        .metric-icon svg { width: 18px; height: 18px; }
        .metric-icon--blue { color: #3b82f6; }
        .metric-icon--amber { color: #f59e0b; }
        .metric-icon--green { color: #10b981; }
        .metric-icon--red { color: #ef4444; }
        .metric-label { color: #64748b; font-size: 0.75rem; letter-spacing: 0.18em; text-transform: uppercase; }
        .metric-value { font-size: 2rem; font-weight: 700; color: #0f172a; }
        .metric-note { color: #64748b; font-size: 0.95rem; }
        .charts-grid { display: grid; gap: 1.75rem; grid-template-columns: 1.9fr 1fr; margin-top: 2rem; }
        .chart-panel { display: grid; gap: 1.25rem; }
        .chart-title { margin: 0; font-size: 1.1rem; font-weight: 700; color: #0f172a; }
        .chart-subtitle { margin: 0; color: #64748b; font-size: 0.92rem; }
        .chart-bar-row { display: grid; gap: 1rem; }
        .progress-row { display: grid; gap: 1rem; }
        .progress-meta { display: flex; justify-content: space-between; color: #94a3b8; font-size: 0.92rem; }
        .progress-track { height: 0.75rem; border-radius: 999px; background: rgba(148, 163, 184, 0.12); overflow: hidden; }
        .progress-fill { height: 100%; border-radius: 999px; background: #38bdf8; }
        .alert-panel { display: grid; gap: 1rem; }
        .alert-header { display: flex; justify-content: space-between; gap: 1rem; align-items: flex-start; }
        .alert-label { color: #94a3b8; font-size: 0.75rem; text-transform: uppercase; letter-spacing: 0.18em; }
        .alert-headline { margin: 0; font-size: 1.1rem; font-weight: 700; color: #e2e8f0; }
        .alert-badge { border-radius: 999px; background: #fef3c7; color: #92400e; padding: 0.6rem 1rem; font-size: 0.75rem; font-weight: 700; text-transform: uppercase; letter-spacing: 0.18em; }
        .alert-card { background: #ffffff; border: 1px solid #e2e8f0; border-radius: 1.5rem; padding: 1rem; display: grid; gap: 1rem; }
        .alert-row { display: grid; gap: 0.5rem; padding-bottom: 1rem; border-bottom: 1px solid #e2e8f0; }
        .alert-row:last-child { border-bottom: none; }
        .alert-title { font-size: 0.9rem; font-weight: 700; color: #0f172a; margin: 0; }
        .alert-meta { display: flex; justify-content: space-between; align-items: center; gap: 1rem; color: #64748b; font-size: 0.9rem; }
        .alert-date { color: #1d4ed8; font-weight: 700; }
        @media (max-width: 1160px) {
            .app-shell { grid-template-columns: 1fr; }
            .metric-grid { grid-template-columns: repeat(2, minmax(0, 1fr)); }
            .charts-grid { grid-template-columns: 1fr; }
            .header-inner { flex-direction: column; align-items: stretch; }
        }
        @media (max-width: 720px) {
            .metric-grid { grid-template-columns: 1fr; }
        }
    </style>
</head>
<body>
    <div class="app-layout">
        <header class="app-header">
            <div class="header-inner">
                <a href="{{ route('dashboard') }}" class="header-brand">FleetOps</a>
                <nav class="header-nav">
                    @auth
                        <span>Welcome, {{ auth()->user()->name }}</span>
                        <a href="{{ route('dashboard') }}">Dashboard</a>
                        <a href="{{ route('leave-requests.index') }}">Leave Requests</a>
                        <form method="POST" action="{{ route('logout') }}" style="display:inline;">
                            @csrf
                            <button type="submit" style="background:none; border:none; padding:0; color:inherit;">Logout</button>
                        </form>
                    @else
                        <a href="{{ route('login') }}">Login</a>
                        <a href="{{ route('register') }}">Register</a>
                    @endauth
                </nav>
            </div>
        </header>

        <main class="app-main">
            @if (session('success'))
                <div class="notification notification-success">
                    {{ session('success') }}
                </div>
            @endif
            @if (session('error'))
                <div class="notification notification-error">
                    {{ session('error') }}
                </div>
            @endif
            @if (session('warning'))
                <div class="notification notification-warning">
                    {{ session('warning') }}
                </div>
            @endif

            @if ($errors->any())
                <div class="notification notification-error">
                    <strong>There were some issues with your submission:</strong>
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            @yield('content')
        </main>
    </div>
</body>
</html>

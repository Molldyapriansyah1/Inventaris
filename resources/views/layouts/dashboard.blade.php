<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inventaris — @yield('title', 'Dashboard')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
    <style>
        * { box-sizing: border-box; margin: 0; padding: 0; }
        body { font-family: sans-serif; background:black; }


        .sidebar {
            width: 260px;
            min-height: 100vh;
            background: #ffffff;
            border-right: 1px solid #e8e8f0;
            position: fixed;
            top: 0; left: 0;
            display: flex;
            flex-direction: column;
            z-index: 100;
            transition: transform 0.25s ease;
        }
        .sidebar.collapsed { transform: translateX(-260px); }
        .sidebar-brand { padding: 24px 20px 20px; }
        .brand-name { font-size: 13px; font-weight: 700; color: #aaa; letter-spacing: 0.08em; text-transform: uppercase; margin: 0; }

        .nav-section { font-size: 11px; color: #bbb; padding: 16px 20px 6px; letter-spacing: 0.06em; text-transform: uppercase; }
        .sidebar .nav-link {
            display: flex; align-items: center; gap: 12px;
            padding: 10px 16px; margin: 2px 10px;
            border-radius: 8px; font-size: 14px; font-weight: 600;
            color: #444;
            transition: background 0.15s, color 0.15s;
            text-decoration: none;
        }
        .sidebar .nav-link:hover { background: #f0f2ff; color: #2b3ba0; }
        .sidebar .nav-link.active { background: #e8ebff; color: #2b3ba0; }
        .sidebar .nav-link i { font-size: 16px; }

        /* Collapse chevron */
        .nav-link[aria-expanded="true"] .chevron { transform: rotate(90deg); }
        .chevron { transition: transform 0.2s; font-size: 11px; opacity: 0.4; }

        /* Sub menu */
        .sidebar .collapse .nav-link {
            font-size: 13px; font-weight: 500;
            padding: 8px 16px; margin: 1px 10px 1px 24px;
        }

        /* ── Main ── */
        .main-wrapper { margin-left: 260px; min-height: 100vh; display: flex; flex-direction: column; transition: margin-left 0.25s ease; }
        .main-wrapper.expanded { margin-left: 0; }

        /* ── Hero header ── */
        .hero-header {
            background: #ffffff;
            padding: 28px 28px 100px;   
            position: relative;
        }
        .hero-header::before { content: ''; position: absolute; inset: 0; }
        .hero-inner { position: relative; z-index: 1; display: flex; align-items: center; justify-content: space-between; }
        .hero-left { display: flex; align-items: center; gap: 14px; }
        .hero-logo { width: 52px; height: 52px; border-radius: 50%; display: flex; align-items: center; justify-content: center; }
        .hero-logo i { font-size: 24px; color: #fff; }
        .hero-title { font-size: 22px; font-weight: 700; color: #1a1a1a; margin: 0; }


        /* ── Sub-topbar ── */
        .sub-topbar {
            background: #fff; border-bottom: 1px solid #e8e8e8;
            padding: 12px 28px; display: flex; align-items: center; justify-content: space-between;
            margin-top: -52px; position: relative; z-index: 10;
        }
        .sub-topbar-left { font-size: 13px; color: #888; }
        .sub-topbar-right { display: flex; align-items: center; gap: 10px; }
        .topbar-user-btn {
            display: flex; align-items: center; gap: 8px;
            font-size: 13px; font-weight: 500; color: #333;
            border: none; background: none; cursor: pointer;
        }
        .topbar-avatar { width: 32px; height: 32px; border-radius: 50%; background: #e8e8e8; display: flex; align-items: center; justify-content: center; }
        .topbar-avatar i { font-size: 18px; color: #888; }

        /* ── Content ── */
        .content { padding: 24px 28px; flex: 1;background-color: #f5f5f5; }

        /* ── Page header ── */
        .page-header { margin-bottom: 20px; }
        .page-header h2 { font-size: 18px; font-weight: 700; color: #1a1a1a; margin: 0; }
        .page-header p { font-size: 13px; color: #aaa; margin: 2px 0 0; }
        .page-header p span { color: #ffffff; }

        /* ── Table card ── */
        .table-card { background: #fff; border-radius: 12px; border: 1px solid #ebebeb; overflow: hidden; }
        .table th { font-size: 13px; font-weight: 500; color: #888; border-bottom: 1px solid #ebebeb; padding: 14px 16px; background: #fafafa; }
        .table td { font-size: 14px; color: #333; padding: 16px 16px; vertical-align: middle; border-color: #f5f5f5; }

        /* ── Stat cards ── */
        .stat-card { background: #fff; border-radius: 10px; padding: 16px; border: 1px solid #ebebeb; }
        .stat-label { font-size: 11px; color: #aaa; margin-bottom: 4px; text-transform: uppercase; letter-spacing: 0.05em; }
        .stat-value { font-size: 26px; font-weight: 700; color: #1a1a1a; line-height: 1; }

        /* ── Badges ── */
        .badge-sarpras { background: #E1F5EE !important; color: #085041 !important; font-weight: 500; }
        .badge-tefa    { background: #EEEDFE !important; color: #3C3489 !important; font-weight: 500; }
        .badge-tu      { background: #FAEEDA !important; color: #633806 !important; font-weight: 500; }

        /* ── Buttons ── */
        .btn-add { background: #22c55e; color: #fff; border: none; border-radius: 8px; padding: 9px 20px; font-size: 13px; font-weight: 600; display: inline-flex; align-items: center; gap: 6px; text-decoration: none; transition: background 0.1s; }
        .btn-add:hover { background: #16a34a; color: #fff; }
        .btn-edit { background: #2b3ba0; color: #fff; border: none; border-radius: 6px; padding: 6px 16px; font-size: 13px; font-weight: 500; text-decoration: none; transition: background 0.1s; display: inline-flex; align-items: center; gap: 6px; }
        .btn-edit:hover { background: #1e2b7a; color: #fff; }
        .btn-del { background: #fee2e2; color: #991b1b; border: none; border-radius: 6px; padding: 6px 16px; font-size: 13px; font-weight: 500; text-decoration: none; transition: background 0.1s; cursor: pointer; }
        .btn-del:hover { background: #fca5a5; color: #7f1d1d; }

        /* ── Alerts ── */
        .alert-success-custom { background: #E1F5EE; color: #085041; border: 1px solid #9FE1CB; border-radius: 8px; padding: 10px 14px; font-size: 13px; margin-bottom: 16px; }
        .alert-error-custom { background: #FCEBEB; color: #501313; border: 1px solid #F09595; border-radius: 8px; padding: 10px 14px; font-size: 13px; margin-bottom: 16px; }

        /* ── Hamburger ── */
       .hamburger { background: none; border: none; color: #1a1a1a; font-size: 22px; cursor: pointer; padding: 0; }
    </style>
</head>
<body>

{{-- ══════════════════════════════
     SIDEBAR
══════════════════════════════ --}}
<div class="sidebar" id="sidebar">
    <div class="sidebar-brand">
        <p class="brand-name">Menu</p>
    </div>

    <nav class="flex-grow-1">
    <div class="nav-section">Dashboard</div>
    <a href="{{ route('dashboard') }}"
       class="nav-link {{ request()->routeIs('dashboard') ? 'active' : '' }}">
        <i class="bi bi-grid-fill"></i> Dashboard
    </a>

    <div class="nav-section">Items Data</div>


   @if(auth()->user()->role === 'admin')
        <a href="{{ route('categories.index') }}"
           class="nav-link {{ request()->routeIs('categories.*') ? 'active' : '' }}">
            <i class="bi bi-list-ul"></i> Categories
        </a>
    @endif

    <a href="{{ route('items.index') }}"
       class="nav-link {{ request()->routeIs('items.*') ? 'active' : '' }}">
        <i class="bi bi-pie-chart-fill"></i> Items
    </a>

    @if( auth()->user()->role !== 'admin')
        <a href="{{ route('lendings.index') }}"
        class="nav-link {{ request()->routeIs('lendings.*') ? 'active' : '' }}">
            <i class="bi bi-arrow-repeat"></i> Lending
        </a>
    @endif

    <div class="nav-section">Accounts</div>
    <a class="nav-link {{ request()->routeIs('staff.*') ? 'active' : '' }}"
       data-bs-toggle="collapse"
       href="#usersCollapse"
       role="button"
       aria-expanded="{{ request()->routeIs('staff.*') ? 'true' : 'false' }}">
        <i class="bi bi-person"></i> Users
        <i class="bi bi-chevron-right ms-auto chevron"></i>
    </a>
    <div class="collapse {{ request()->routeIs('staff.*') ? 'show' : '' }}" id="usersCollapse">

        @if(auth()->user()->role === 'admin')
            <a href="{{ route('staff.admin') }}"
               class="nav-link {{ request()->routeIs('staff.admin') ? 'active' : '' }}">
                <i class="bi bi-circle" style="font-size:8px;"></i> Admin
            </a>

        <a href="{{ route('staff.operator') }}"
           class="nav-link {{ request()->routeIs('staff.operator') ? 'active' : '' }}">
            <i class="bi bi-circle" style="font-size:8px;"></i> Operator
        </a>
         @endif

        @if(auth()->user()->role === 'staff')
            <a href="{{ route('staff.edit', auth()->user()->id) }}"
            class="nav-link {{ request()->routeIs('staff.edit') ? 'active' : '' }}">
                <i class="bi bi-circle" style="font-size:8px;"></i> Edit Profile
            </a>
        @endif
        

    </div>
</nav>
</div>


{{-- ══════════════════════════════
     MAIN CONTENT
══════════════════════════════ --}}
<div class="main-wrapper" id="mainWrapper">

    {{-- Hero header --}}
    <div class="hero-header">
        <div class="hero-inner">
            <div class="hero-left">
                <button class="hamburger" onclick="toggleSidebar()">
                    <i class="bi bi-list"></i>
                </button>
                <div class="hero-logo">
                    <img src="{{ asset('img/wikrama.png') }}" class="img-fluid" alt="logo">
                </div>
                <h1 class="hero-title">Welcome Back, {{ auth()->user()->role }}</h1>
            </div>
            
        </div>
    </div>

    {{-- Sub topbar --}}
    <div class="sub-topbar">
        <div class="sub-topbar-left">{!! $__env->yieldContent('subtitle', 'Check menu in sidebar') !!}</div>
        <div class="sub-topbar-right">
            <div class="dropdown">
                <button class="topbar-user-btn" data-bs-toggle="dropdown">
                 <img src="{{ asset('img/wikrama.png') }}" alt="User Avatar" class="topbar-avatar">
                    {{ auth()->user()->role }} Wikrama 
                    <i class="bi bi-chevron-down" style="font-size:11px;"></i>
                </button>
                <ul class="dropdown-menu dropdown-menu-end shadow-sm" style="font-size:13px;">
                    <li>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="dropdown-item text-danger">
                                <i class="bi bi-box-arrow-right me-2"></i> Logout
                            </button>
                        </form>
                    </li>
                </ul>
            </div>
        </div>
    </div>

    {{-- Alerts --}}

    <div class="content">
        @if(session('success'))
            <div class="alert-success-custom">
                <i class="bi bi-check-circle me-1"></i> {{ session('success') }}
            </div>
        @endif
        @if(session('error'))
            <div class="alert-error-custom">
                <i class="bi bi-exclamation-circle me-1"></i> {{ session('error') }}
            </div>
        @endif

        @yield('content')
    </div>

</div>

</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script>
function toggleSidebar() {
    document.getElementById('sidebar').classList.toggle('collapsed');
    document.getElementById('mainWrapper').classList.toggle('expanded');
}
</script>
</body>
</html>
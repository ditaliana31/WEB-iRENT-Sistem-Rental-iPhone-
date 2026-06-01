<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>@yield('title', 'Admin iRent')</title>

    {{-- BOOTSTRAP --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    {{-- GOOGLE FONT --}}
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap"
        rel="stylesheet">

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Poppins', sans-serif;
            background: #f5f7fb;
            overflow-x: hidden;
        }

        /*
        |--------------------------------------------------------------------------
        | SIDEBAR
        |--------------------------------------------------------------------------
        */

        .sidebar {
            width: 260px;
            height: 100vh;
            position: fixed;
            top: 0;
            left: 0;
            background: #0f172a;
            padding: 24px 18px;
            color: white;
            z-index: 1000;
            overflow-y: auto;
        }

        .sidebar-logo {
            font-size: 26px;
            font-weight: 700;
            margin-bottom: 35px;
            color: white;
        }

        .sidebar-subtitle {
            font-size: 13px;
            color: #94a3b8;
            margin-top: 4px;
        }

        .menu-title {
            font-size: 12px;
            text-transform: uppercase;
            letter-spacing: 1px;
            color: #64748b;
            margin: 24px 12px 10px;
            font-weight: 600;
        }

        .sidebar-menu {
            display: flex;
            flex-direction: column;
            gap: 8px;
        }

        .sidebar-menu a {
            display: flex;
            align-items: center;
            gap: 14px;
            text-decoration: none;
            color: #cbd5e1;
            padding: 14px 16px;
            border-radius: 14px;
            transition: .3s;
            font-weight: 500;
            font-size: 15px;
        }

        .sidebar-menu a:hover {
            background: #1e293b;
            color: white;
            transform: translateX(3px);
        }

        .sidebar-menu a.active {
            background: #2563eb;
            color: white;
            box-shadow: 0 8px 20px rgba(37, 99, 235, .35);
        }

        .sidebar-divider {
            border-color: rgba(255, 255, 255, 0.08);
            margin: 24px 0;
        }

        /*
        |--------------------------------------------------------------------------
        | CONTENT
        |--------------------------------------------------------------------------
        */

        .content {
            margin-left: 260px;
            padding: 32px;
            min-height: 100vh;
        }

        /*
        |--------------------------------------------------------------------------
        | TOPBAR
        |--------------------------------------------------------------------------
        */

        .topbar {
            background: white;
            border-radius: 22px;
            padding: 20px 24px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 30px;
            box-shadow: 0 10px 30px rgba(15, 23, 42, .05);
        }

        .topbar-title h4 {
            font-size: 24px;
            font-weight: 700;
            color: #0f172a;
            margin-bottom: 4px;
        }

        .topbar-title p {
            color: #64748b;
            margin: 0;
            font-size: 14px;
        }

        .admin-profile {
            display: flex;
            align-items: center;
            gap: 14px;
        }

        .admin-avatar {
            width: 48px;
            height: 48px;
            border-radius: 50%;
            background: #2563eb;
            color: white;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 700;
        }

        .admin-name {
            font-weight: 700;
            color: #0f172a;
        }

        .admin-role {
            font-size: 13px;
            color: #64748b;
        }

        /*
        |--------------------------------------------------------------------------
        | CARD
        |--------------------------------------------------------------------------
        */

        .card {
            border: none;
            border-radius: 20px;
            box-shadow: 0 10px 30px rgba(15, 23, 42, .05);
        }

        /*
        |--------------------------------------------------------------------------
        | BUTTON
        |--------------------------------------------------------------------------
        */

        .btn {
            border-radius: 12px;
            font-weight: 600;
        }

        /*
        |--------------------------------------------------------------------------
        | TABLE
        |--------------------------------------------------------------------------
        */

        .table {
            vertical-align: middle;
        }

        /*
        |--------------------------------------------------------------------------
        | RESPONSIVE
        |--------------------------------------------------------------------------
        */

        @media(max-width: 992px) {

            .sidebar {
                width: 100%;
                height: auto;
                position: relative;
            }

            .content {
                margin-left: 0;
                padding: 20px;
            }

            .topbar {
                flex-direction: column;
                align-items: flex-start;
                gap: 16px;
            }
        }
    </style>

</head>

<body>

    {{-- SIDEBAR --}}
    <div class="sidebar">

        {{-- LOGO --}}
        <div class="sidebar-logo">

            📱 iRent Admin

            <div class="sidebar-subtitle">
                Rental iPhone Premium
            </div>

        </div>

        {{-- MAIN MENU --}}
        <div class="menu-title">
            Main Menu
        </div>

        <div class="sidebar-menu">

            {{-- DASHBOARD --}}
            <a href="{{ route('admin.dashboard') }}"
                class="{{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">

                📊 Dashboard
            </a>

            {{-- PESANAN --}}
            <a href="{{ route('admin.payments') }}" class="{{ request()->routeIs('admin.payments') ? 'active' : '' }}">

                🧾 Kelola Pesanan
            </a>

            {{-- PENJUALAN --}}
            <a href="{{ route('admin.sales.index') }}"
                class="{{ request()->routeIs('admin.sales.*') ? 'active' : '' }}">

                💰 Penjualan
            </a>

            {{-- USERS --}}
            <a href="{{ route('admin.users') }}" class="{{ request()->routeIs('admin.users') ? 'active' : '' }}">

                👥 Users
            </a>

        </div>

        <hr class="sidebar-divider">

        {{-- PRODUCT MENU --}}
        <div class="menu-title">
            Products
        </div>

        <div class="sidebar-menu">

            {{-- PRODUCTS --}}
            <a href="{{ route('admin.products.index') }}"
                class="{{ request()->routeIs('admin.products.index') ? 'active' : '' }}">

                📦 Products
            </a>

            {{-- TAMBAH PRODUK --}}
            <a href="{{ route('admin.products.create') }}"
                class="{{ request()->routeIs('admin.products.create') ? 'active' : '' }}">

                ➕ Tambah Produk
            </a>

        </div>

        <hr class="sidebar-divider">

        {{-- WEBSITE --}}
        <div class="menu-title">
            Website
        </div>

        <div class="sidebar-menu">

            <a href="{{ route('home') }}">

                🌐 Back to Website
            </a>

            <form action="{{ route('logout') }}" method="POST">

                @csrf

                <button type="submit" style="
                        width:100%;
                        border:none;
                        background:#ef4444;
                        color:white;
                        padding:14px 16px;
                        border-radius:14px;
                        font-weight:600;
                        margin-top:10px;
                    ">
                    🚪 Logout
                </button>

            </form>

        </div>

    </div>

    {{-- CONTENT --}}
    <div class="content">

        {{-- TOPBAR --}}
        <div class="topbar">

            <div class="topbar-title">

                <h4>
                    @yield('title', 'Dashboard')
                </h4>

                <p>
                    Kelola seluruh sistem rental iPhone iRent
                </p>

            </div>

            <div class="admin-profile">

                <div class="admin-avatar">
                    {{ strtoupper(substr(auth()->user()->name ?? 'A', 0, 1)) }}
                </div>

                <div>

                    <div class="admin-name">
                        {{ auth()->user()->name ?? 'Admin' }}
                    </div>

                    <div class="admin-role">
                        Administrator
                    </div>

                </div>

            </div>

        </div>

        @yield('content')

    </div>

    {{-- BOOTSTRAP JS --}}
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</body>

</html>
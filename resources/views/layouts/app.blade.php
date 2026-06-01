<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>
        @yield('title', 'iRent')
    </title>

    {{-- CSS --}}
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">

    {{-- GOOGLE FONT --}}
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap"
        rel="stylesheet">
</head>

<body>

    {{-- NAVBAR --}}
    <nav class="navbar">

        <div class="container nav-wrapper">

            {{-- LOGO --}}
            <a href="{{ route('home') }}" class="logo">
                iRent
            </a>

            {{-- MENU --}}
            <ul class="nav-menu">

                <li>
                    <a href="{{ route('home') }}">
                        Home
                    </a>
                </li>

                <li>
                    <a href="{{ route('katalog') }}">
                        Katalog
                    </a>
                </li>

                <li>
                    <a href="{{ route('dashboard') }}">
                        Riwayat Transaksi
                    </a>
                </li>

                <li>
                    <a href="{{ route('keranjang') }}">
                        Keranjang
                    </a>
                </li>

            </ul>

            {{-- AUTH --}}
            <div class="nav-auth">

                @auth

                <a href="{{ route('profile') }}" class="profile-nav">

                    <div class="profile-nav-avatar">
                        {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                    </div>

                    <div class="profile-nav-info">
                        <h4>{{ Auth::user()->name }}</h4>
                        <p>Premium Member</p>
                    </div>

                </a>

                @else

                <a href="{{ route('login') }}" class="btn-login">
                    Login
                </a>

                <a href="{{ route('register') }}" class="btn-register">
                    Register
                </a>

                @endauth

            </div>

        </div>

    </nav>

    {{-- CONTENT --}}
    <main class="main-content">

        @yield('content')

    </main>

    {{-- FOOTER --}}
    @include('partials.footer')

    {{-- WHATSAPP --}}
    @include('partials.whatsapp')

    {{-- JS --}}
    <script src="{{ asset('assets/js/script.js') }}"></script>

</body>

</html>
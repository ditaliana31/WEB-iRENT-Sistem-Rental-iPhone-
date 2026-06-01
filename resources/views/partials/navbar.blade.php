<nav class="navbar">
    <div class="container nav-wrapper">

        <a href="/" class="logo">
            iRent
        </a>

        <ul class="nav-menu">
            <li><a href="/">Home</a></li>
            <li><a href="/katalog">Katalog</a></li>
            <li><a href="/dashboard">Riwayat Transaksi</a></li>
            <li><a href="/keranjang">Keranjang</a></li>
        </ul>

        @auth

        <div class="nav-auth">

            <a href="{{ route('profile') }}" class="btn-login">
                {{ Auth::user()->name }}
            </a>

            <form action="{{ route('logout') }}" method="POST">

                @csrf

                <button type="submit" class="btn-register">
                    Logout
                </button>

            </form>

        </div>

        @else

        <div class="nav-auth">

            <a href="{{ route('login') }}" class="btn-login">
                Login
            </a>

            <a href="{{ route('register') }}" class="btn-register">
                Register
            </a>

        </div>

        @endauth

    </div>
</nav>
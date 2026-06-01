{{-- resources/views/auth/login.blade.php --}}

@extends('layouts.auth')

@section('title', 'Login')

@section('content')

<div class="auth-page">

    <div class="auth-container">

        {{-- LEFT --}}
        <div class="auth-left">

            <div class="auth-overlay">

                <div class="auth-brand">
                    iRent
                </div>

                <h1>
                    Rental iPhone Premium
                </h1>

                <p>
                    Sewa iPhone dengan mudah,
                    cepat, dan terpercaya untuk
                    kebutuhan harianmu.
                </p>

            </div>

        </div>

        {{-- RIGHT --}}
        <div class="auth-right">

            <div class="auth-card">

                <h2 class="auth-title">
                    Selamat Datang 👋
                </h2>

                <p class="auth-subtitle">
                    Login untuk melanjutkan
                </p>

                {{-- SUCCESS --}}
                @if (session('success'))

                <div class="auth-alert success">

                    {{ session('success') }}

                </div>

                @endif

                {{-- ERROR --}}
                @if (session('error'))

                <div class="auth-alert error">

                    {{ session('error') }}

                </div>

                @endif

                <form action="{{ route('login.process') }}" method="POST">

                    @csrf

                    {{-- EMAIL --}}
                    <div class="form-group">

                        <label>Email</label>

                        <input type="email" name="email" class="input-field" placeholder="Masukkan email" required>

                    </div>

                    {{-- PASSWORD --}}
                    <div class="form-group">

                        <label>Password</label>

                        <input type="password" name="password" class="input-field" placeholder="Masukkan password"
                            required>

                    </div>

                    {{-- BUTTON --}}
                    <button type="submit" class="auth-btn">
                        Masuk
                    </button>

                </form>

                {{-- FOOTER --}}
                <div class="auth-footer">

                    Belum punya akun?

                    <a href="{{ route('register') }}">
                        Daftar sekarang
                    </a>

                </div>

            </div>

        </div>

    </div>

</div>

@endsection
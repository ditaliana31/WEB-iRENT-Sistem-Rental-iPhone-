{{-- resources/views/auth/register.blade.php --}}

@extends('layouts.auth')

@section('title', 'Register')

@section('content')

<div class="auth-page">

    <div class="auth-container">

        {{-- LEFT --}}
        <div class="auth-left register-left">

            <div class="auth-overlay">

                <div class="auth-brand">
                    iRent
                </div>

                <h1>
                    Buat Akun Baru
                </h1>

                <p>
                    Daftar sekarang dan nikmati
                    pengalaman rental iPhone premium
                    dengan proses cepat dan aman.
                </p>

            </div>

        </div>

        {{-- RIGHT --}}
        <div class="auth-right">

            <div class="auth-card">

                <h2 class="auth-title">
                    Daftar 🚀
                </h2>

                <p class="auth-subtitle">
                    Isi data untuk membuat akun
                </p>

                {{-- ERROR --}}
                @if ($errors->any())

                <div class="auth-alert error">

                    {{ $errors->first() }}

                </div>

                @endif

                <form action="{{ route('register.process') }}" method="POST">

                    @csrf

                    {{-- NAME --}}
                    <div class="form-group">

                        <label>Nama Lengkap</label>

                        <input type="text" name="name" class="input-field" placeholder="Masukkan nama lengkap" required>

                    </div>

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
                        Daftar Sekarang
                    </button>

                </form>

                {{-- FOOTER --}}
                <div class="auth-footer">

                    Sudah punya akun?

                    <a href="{{ route('login') }}">
                        Login sekarang
                    </a>

                </div>

            </div>

        </div>

    </div>

</div>

@endsection
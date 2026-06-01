@extends('layouts.app')

@section('title', 'Profile')

@section('content')

<section class="profile-page">

    <div class="container">

        {{-- HEADER --}}
        <div class="profile-header">

            <div class="profile-avatar">
                {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
            </div>

            <div>
                <h1>{{ auth()->user()->name }}</h1>
                <p>{{ auth()->user()->email }}</p>
            </div>

        </div>

        {{-- CARD --}}
        <div class="profile-card">

            <div class="profile-grid">

                <div class="profile-box">
                    <span>Status Akun</span>
                    <h3>Aktif</h3>
                </div>

                <div class="profile-box">
                    <span>Bergabung Sejak</span>
                    <h3>
                        {{ auth()->user()->created_at->format('d M Y') }}
                    </h3>
                </div>

                <div class="profile-box">
                    <span>Total Rental</span>
                    <h3>
                        {{ auth()->user()->payments->count() }} Order
                    </h3>
                </div>

            </div>

            {{-- ACTION --}}
            <div class="profile-actions">

                <a href="{{ route('profile.edit') }}" class="btn-profile">
                    Edit Profile
                </a>

                <form action="{{ route('logout') }}" method="POST">
                    @csrf

                    <button class="btn-logout">
                        Logout
                    </button>
                </form>

            </div>

        </div>

    </div>

</section>

@endsection
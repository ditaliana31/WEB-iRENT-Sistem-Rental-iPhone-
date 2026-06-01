@extends('layouts.app')

@section('title', 'Profile')

@section('content')

<style>
    .dashboard-section {
        min-height: 100vh;
        background: linear-gradient(135deg, #f5f7ff, #eef2ff);
        padding: 70px 20px;
    }

    .profile-wrapper {
        max-width: 950px;
        margin: auto;
    }

    .profile-card {
        background: white;
        border-radius: 35px;
        overflow: hidden;
        box-shadow: 0 20px 45px rgba(0, 0, 0, 0.08);
        position: relative;
    }

    /* HEADER */

    .profile-header {
        background: linear-gradient(135deg, #2563eb, #1d4ed8);
        padding: 55px;
        position: relative;
        overflow: hidden;
    }

    .profile-header::before {
        content: '';
        position: absolute;
        width: 280px;
        height: 280px;
        border-radius: 50%;
        background: rgba(255, 255, 255, 0.08);
        top: -120px;
        right: -80px;
    }

    .profile-header::after {
        content: '';
        position: absolute;
        width: 180px;
        height: 180px;
        border-radius: 50%;
        background: rgba(255, 255, 255, 0.05);
        bottom: -70px;
        left: -50px;
    }

    .profile-top {
        display: flex;
        align-items: center;
        gap: 30px;
        position: relative;
        z-index: 2;
    }

    /* AVATAR */

    .profile-avatar {
        width: 120px;
        height: 120px;
        border-radius: 50%;
        background: rgba(255, 255, 255, 0.15);
        border: 4px solid rgba(255, 255, 255, 0.25);
        backdrop-filter: blur(12px);
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 44px;
        font-weight: 700;
        color: white;
        box-shadow: 0 12px 30px rgba(0, 0, 0, 0.15);
    }

    /* USER */

    .profile-user h1 {
        font-size: 40px;
        color: white;
        margin-bottom: 8px;
        line-height: 1.1;
    }

    .profile-user p {
        color: rgba(255, 255, 255, 0.85);
        font-size: 16px;
        margin-bottom: 16px;
    }

    .profile-badge {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        background: rgba(255, 255, 255, 0.14);
        padding: 10px 18px;
        border-radius: 999px;
        color: white;
        font-size: 14px;
        font-weight: 600;
    }

    /* BODY */

    .profile-body {
        padding: 40px;
    }

    .profile-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(230px, 1fr));
        gap: 22px;
        margin-bottom: 40px;
    }

    .profile-box {
        background: #f8fbff;
        border: 1px solid #eef2f7;
        border-radius: 24px;
        padding: 28px;
        transition: 0.35s;
    }

    .profile-box:hover {
        transform: translateY(-6px);
        box-shadow: 0 12px 30px rgba(37, 99, 235, 0.08);
    }

    .profile-box h3 {
        color: #6b7280;
        font-size: 15px;
        margin-bottom: 12px;
        font-weight: 500;
    }

    .profile-box p {
        font-size: 24px;
        font-weight: 700;
        color: #111827;
    }

    /* ACTIONS */

    .profile-actions {
        display: flex;
        gap: 16px;
        flex-wrap: wrap;
    }

    .edit-btn,
    .logout-btn {
        border: none;
        padding: 15px 28px;
        border-radius: 16px;
        font-size: 15px;
        font-weight: 600;
        cursor: pointer;
        transition: 0.3s;
    }

    .edit-btn {
        background: #2563eb;
        color: white;
        box-shadow: 0 10px 25px rgba(37, 99, 235, 0.2);
    }

    .edit-btn:hover {
        background: #1d4ed8;
        transform: translateY(-3px);
    }

    .logout-btn {
        background: #fee2e2;
        color: #dc2626;
    }

    .logout-btn:hover {
        background: #fecaca;
        transform: translateY(-3px);
    }

    /* RESPONSIVE */

    @media(max-width:768px) {

        .dashboard-section {
            padding: 40px 15px;
        }

        .profile-header {
            padding: 40px 25px;
        }

        .profile-top {
            flex-direction: column;
            text-align: center;
        }

        .profile-avatar {
            width: 100px;
            height: 100px;
            font-size: 38px;
        }

        .profile-user h1 {
            font-size: 32px;
        }

        .profile-body {
            padding: 25px;
        }

        .profile-actions {
            flex-direction: column;
        }

        .edit-btn,
        .logout-btn {
            width: 100%;
        }

    }
</style>

<section class="dashboard-section">

    <div class="profile-wrapper">

        <div class="profile-card">

            <!-- HEADER -->
            <div class="profile-header">

                <div class="profile-top">

                    <div class="profile-avatar">
                        {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                    </div>

                    <div class="profile-user">

                        <h1>
                            {{ Auth::user()->name }}
                        </h1>

                        <p>
                            {{ Auth::user()->email }}
                        </p>

                        <div class="profile-badge">

                            @if(Auth::user()->role == 'admin')
                            👑 Admin
                            @else
                            ✨ Member
                            @endif

                        </div>

                    </div>

                </div>

            </div>

            <!-- BODY -->
            <div class="profile-body">

                <div class="profile-grid">

                    <div class="profile-box">
                        <h3>Status Akun</h3>

                        <p>
                            {{ Auth::user()->status ?? 'Aktif' }}
                        </p>
                    </div>

                    <div class="profile-box">
                        <h3>Bergabung Sejak</h3>

                        <p>
                            {{ Auth::user()->created_at->format('d M Y') }}
                        </p>
                    </div>

                    <div class="profile-box">
                        <h3>Total Rental</h3>

                        <p>
                            {{ $totalRental }} Order
                        </p>
                    </div>

                </div>

                <div class="profile-actions">

                    <button class="edit-btn">
                        Edit Profile
                    </button>

                    <form action="{{ route('logout') }}" method="POST">

                        @csrf

                        <button class="logout-btn">
                            Logout
                        </button>

                    </form>

                </div>

            </div>

        </div>

    </div>

</section>

@endsection
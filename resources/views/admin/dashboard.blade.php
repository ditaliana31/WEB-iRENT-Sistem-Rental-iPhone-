@extends('layouts.admin')

@section('title', 'Dashboard')

@section('content')

<div class="container-fluid py-4">

    {{-- HEADER --}}
    <div class="d-flex justify-content-between align-items-center mb-4">

        <div>
            <h2 class="fw-bold mb-1">
                Dashboard Admin
            </h2>

            <p class="text-muted mb-0">
                Statistik dan monitoring sistem iRent
            </p>
        </div>

        <div class="bg-white rounded-4 shadow-sm px-3 py-2 d-flex align-items-center gap-3">

            <div class="bg-primary text-white rounded-circle d-flex justify-content-center align-items-center"
                style="width:45px; height:45px;">

                A
            </div>

            <div>
                <div class="fw-bold">
                    admin
                </div>

                <small class="text-muted">
                    Administrator
                </small>
            </div>

        </div>

    </div>

    {{-- CARD STATISTIK --}}
    <div class="row g-3 mb-4">

        {{-- USER --}}
        <div class="col-md-4">

            <div class="card border-0 shadow-sm rounded-4">

                <div class="card-body">

                    <div class="d-flex justify-content-between align-items-center">

                        <div>
                            <small class="text-muted">
                                Total User
                            </small>

                            <h3 class="fw-bold mb-0">
                                {{ $totalUsers }}
                            </h3>
                        </div>

                        <div class="fs-3">
                            👥
                        </div>

                    </div>

                </div>

            </div>

        </div>

        {{-- TRANSAKSI --}}
        <div class="col-md-4">

            <div class="card border-0 shadow-sm rounded-4">

                <div class="card-body">

                    <div class="d-flex justify-content-between align-items-center">

                        <div>
                            <small class="text-muted">
                                Total Transaksi
                            </small>

                            <h3 class="fw-bold mb-0">
                                {{ $totalTransactions }}
                            </h3>
                        </div>

                        <div class="fs-3">
                            📦
                        </div>

                    </div>

                </div>

            </div>

        </div>

        {{-- PENDAPATAN --}}
        <div class="col-md-4">

            <div class="card border-0 shadow-sm rounded-4">

                <div class="card-body">

                    <div class="d-flex justify-content-between align-items-center">

                        <div>
                            <small class="text-muted">
                                Total Pendapatan
                            </small>

                            <h4 class="fw-bold mb-0 text-success">
                                Rp{{ number_format($totalRevenue, 0, ',', '.') }}
                            </h4>
                        </div>

                        <div class="fs-3">
                            💰
                        </div>

                    </div>

                </div>

            </div>

        </div>

    </div>

    {{-- DETAIL --}}
    <div class="row g-4">

        {{-- TRANSAKSI --}}
        <div class="col-lg-8">

            <div class="card border-0 shadow-sm rounded-4">

                <div class="card-body">

                    <div class="d-flex justify-content-between align-items-center mb-4">

                        <h5 class="fw-bold mb-0">
                            Transaksi Terbaru
                        </h5>

                        <span class="badge bg-primary">
                            {{ $totalTransactions }} transaksi
                        </span>

                    </div>

                    <div class="table-responsive">

                        <table class="table align-middle">

                            <thead>
                                <tr>
                                    <th>Invoice</th>
                                    <th>User</th>
                                    <th>Total</th>
                                    <th>Tanggal</th>
                                </tr>
                            </thead>

                            <tbody>

                                @forelse($latestTransactions as $transaction)

                                <tr>

                                    <td>
                                        #{{ $transaction->id }}
                                    </td>

                                    <td>
                                        {{ $transaction->user->name ?? '-' }}
                                    </td>

                                    <td class="fw-bold text-success">
                                        Rp{{ number_format($transaction->total, 0, ',', '.') }}
                                    </td>

                                    <td>
                                        {{ $transaction->created_at->format('d M Y') }}
                                    </td>

                                </tr>

                                @empty

                                <tr>
                                    <td colspan="4" class="text-center text-muted">
                                        Belum ada transaksi
                                    </td>
                                </tr>

                                @endforelse

                            </tbody>

                        </table>

                    </div>

                </div>

            </div>

        </div>

        {{-- DETAIL USER --}}
        <div class="col-lg-4">

            <div class="card border-0 shadow-sm rounded-4 mb-4">

                <div class="card-body">

                    <h5 class="fw-bold mb-4">
                        User Terbaru
                    </h5>

                    @forelse($latestUsers as $user)

                    <div class="d-flex align-items-center justify-content-between mb-3">

                        <div class="d-flex align-items-center gap-3">

                            <div class="bg-primary text-white rounded-circle d-flex align-items-center justify-content-center"
                                style="width:40px; height:40px;">

                                {{ strtoupper(substr($user->name, 0, 1)) }}
                            </div>

                            <div>

                                <div class="fw-semibold">
                                    {{ $user->name }}
                                </div>

                                <small class="text-muted">
                                    {{ $user->email }}
                                </small>

                            </div>

                        </div>

                    </div>

                    @empty

                    <p class="text-muted">
                        Tidak ada user
                    </p>

                    @endforelse

                </div>

            </div>

            {{-- RATA-RATA --}}
            <div class="card border-0 shadow-sm rounded-4">

                <div class="card-body">

                    <small class="text-muted">
                        Rata-rata Transaksi
                    </small>

                    <h4 class="fw-bold text-primary mt-2">
                        Rp{{ number_format($averageTransaction, 0, ',', '.') }}
                    </h4>

                </div>

            </div>

        </div>

    </div>

</div>

@endsection
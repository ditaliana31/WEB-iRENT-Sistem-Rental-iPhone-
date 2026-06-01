@extends('layouts.admin')

@section('title', 'Monitoring Penjualan')

@section('content')

<div class="container-fluid py-4">

    {{-- HEADER --}}
    <div class="d-flex justify-content-between align-items-center mb-4">

        <div>
            <h2 class="fw-bold mb-1">
                Monitoring Penjualan
            </h2>

            <p class="text-muted mb-0">
                Pantau seluruh transaksi rental iRent secara realtime.
            </p>
        </div>

        <div class="bg-white rounded-4 shadow-sm px-4 py-3">

            <small class="text-muted d-block">
                Total Pendapatan
            </small>

            <h4 class="fw-bold text-success mb-0">
                Rp{{ number_format($totalRevenue, 0, ',', '.') }}
            </h4>

        </div>

    </div>

    {{-- STATISTIK --}}
    <div class="row g-3 mb-4">

        {{-- TOTAL TRANSAKSI --}}
        <div class="col-md-4">

            <div class="card border-0 shadow-sm rounded-4 h-100">

                <div class="card-body">

                    <div class="d-flex justify-content-between align-items-center">

                        <div>

                            <small class="text-muted">
                                Total Transaksi
                            </small>

                            <h3 class="fw-bold mb-0 mt-1">
                                {{ $totalTransactions }}
                            </h3>

                        </div>

                        <div class="fs-2">
                            📦
                        </div>

                    </div>

                </div>

            </div>

        </div>

        {{-- TOTAL PENDAPATAN --}}
        <div class="col-md-4">

            <div class="card border-0 shadow-sm rounded-4 h-100">

                <div class="card-body">

                    <div class="d-flex justify-content-between align-items-center">

                        <div>

                            <small class="text-muted">
                                Total Pendapatan
                            </small>

                            <h5 class="fw-bold text-success mb-0 mt-1">
                                Rp{{ number_format($totalRevenue, 0, ',', '.') }}
                            </h5>

                        </div>

                        <div class="fs-2">
                            💰
                        </div>

                    </div>

                </div>

            </div>

        </div>

        {{-- RATA-RATA --}}
        <div class="col-md-4">

            <div class="card border-0 shadow-sm rounded-4 h-100">

                <div class="card-body">

                    <div class="d-flex justify-content-between align-items-center">

                        <div>

                            <small class="text-muted">
                                Rata-rata Pembayaran
                            </small>

                            <h5 class="fw-bold text-primary mb-0 mt-1">

                                Rp{{ number_format(
                                    $totalTransactions > 0
                                        ? $totalRevenue / $totalTransactions
                                        : 0,
                                    0,
                                    ',',
                                    '.'
                                ) }}

                            </h5>

                        </div>

                        <div class="fs-2">
                            📊
                        </div>

                    </div>

                </div>

            </div>

        </div>

    </div>

    {{-- TABLE --}}
    <div class="card border-0 shadow-sm rounded-4">

        <div class="card-body p-4">

            {{-- HEADER TABLE --}}
            <div class="d-flex justify-content-between align-items-center mb-4">

                <div>

                    <h5 class="fw-bold mb-1">
                        Daftar Transaksi
                    </h5>

                    <small class="text-muted">
                        Data transaksi berasal langsung dari database payment.
                    </small>

                </div>

                <span class="badge bg-primary px-3 py-2">
                    {{ $totalTransactions }} transaksi
                </span>

            </div>

            {{-- TABLE --}}
            <div class="table-responsive">

                <table class="table align-middle">

                    <thead class="table-light">

                        <tr>
                            <th>ID</th>
                            <th>User</th>
                            <th>Produk</th>
                            <th>Total</th>
                            <th>Status</th>
                            <th>Tanggal</th>
                        </tr>

                    </thead>

                    <tbody>

                        @forelse($payments as $payment)

                        <tr>

                            {{-- ID --}}
                            <td class="fw-semibold">
                                #{{ $payment->id }}
                            </td>

                            {{-- USER --}}
                            <td>

                                <div class="d-flex align-items-center gap-2">

                                    <div class="bg-primary text-white rounded-circle d-flex align-items-center justify-content-center"
                                        style="width:35px; height:35px; font-size:14px;">

                                        {{ strtoupper(substr($payment->user->name ?? 'U', 0, 1)) }}

                                    </div>

                                    <div>

                                        <div class="fw-semibold">
                                            {{ $payment->user->name ?? '-' }}
                                        </div>

                                        <small class="text-muted">
                                            {{ $payment->user->email ?? '' }}
                                        </small>

                                    </div>

                                </div>

                            </td>

                            {{-- PRODUK --}}
                            <td>

                                @foreach($payment->carts as $cart)

                                <div class="mb-1">

                                    • {{ $cart->product->name ?? '-' }}

                                </div>

                                @endforeach

                            </td>

                            {{-- TOTAL --}}
                            <td class="fw-bold text-success">

                                Rp{{ number_format($payment->total, 0, ',', '.') }}

                            </td>

                            {{-- STATUS --}}
                            <td>

                                <span class="badge bg-success px-3 py-2">
                                    Paid
                                </span>

                            </td>

                            {{-- TANGGAL --}}
                            <td>

                                {{ $payment->created_at->format('d M Y') }}

                                <br>

                                <small class="text-muted">
                                    {{ $payment->created_at->format('H:i') }}
                                </small>

                            </td>

                        </tr>

                        @empty

                        <tr>

                            <td colspan="6" class="text-center py-5 text-muted">

                                Belum ada transaksi.

                            </td>

                        </tr>

                        @endforelse

                    </tbody>

                </table>

            </div>

        </div>

    </div>

</div>

@endsection
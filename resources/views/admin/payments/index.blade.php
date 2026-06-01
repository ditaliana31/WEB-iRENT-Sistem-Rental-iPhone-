{{-- resources/views/admin/payments/index.blade.php --}}

@extends('layouts.admin')

@section('title', 'Kelola Pesanan')

@section('content')

<div class="container-fluid py-3">

    {{-- HEADER --}}
    <div class="d-flex justify-content-between align-items-center mb-3 flex-wrap gap-2">

        <div>

            <h4 class="fw-bold mb-1">
                Kelola Pesanan
            </h4>

            <p class="text-muted mb-0 small">
                Monitoring transaksi dan status rental iRent
            </p>

        </div>

        <div class="bg-white rounded-3 shadow-sm px-3 py-2">

            <span class="fw-semibold text-primary small">
                {{ $payments->count() }} Transaksi
            </span>

        </div>

    </div>

    {{-- STATISTIK --}}
    <div class="row g-3 mb-3">

        {{-- TOTAL --}}
        <div class="col-md-4">

            <div class="card border-0 shadow-sm rounded-4">

                <div class="card-body py-3">

                    <div class="d-flex justify-content-between align-items-center">

                        <div>

                            <small class="text-muted">
                                Total Pesanan
                            </small>

                            <h5 class="fw-bold mb-0 mt-1">
                                {{ $payments->count() }}
                            </h5>

                        </div>

                        <div class="fs-4">
                            📦
                        </div>

                    </div>

                </div>

            </div>

        </div>

        {{-- DISEWAKAN --}}
        <div class="col-md-4">

            <div class="card border-0 shadow-sm rounded-4">

                <div class="card-body py-3">

                    <div class="d-flex justify-content-between align-items-center">

                        <div>

                            <small class="text-muted">
                                Sedang Disewa
                            </small>

                            <h5 class="fw-bold mb-0 mt-1">
                                {{ $payments->where('rental_status', 'disewakan')->count() }}
                            </h5>

                        </div>

                        <div class="fs-4">
                            🚚
                        </div>

                    </div>

                </div>

            </div>

        </div>

        {{-- SELESAI --}}
        <div class="col-md-4">

            <div class="card border-0 shadow-sm rounded-4">

                <div class="card-body py-3">

                    <div class="d-flex justify-content-between align-items-center">

                        <div>

                            <small class="text-muted">
                                Rental Selesai
                            </small>

                            <h5 class="fw-bold mb-0 mt-1">
                                {{ $payments->where('rental_status', 'selesai')->count() }}
                            </h5>

                        </div>

                        <div class="fs-4">
                            ✅
                        </div>

                    </div>

                </div>

            </div>

        </div>

    </div>

    {{-- CONTENT --}}
    <div class="row g-3">

        {{-- TABLE --}}
        <div class="col-lg-8">

            <div class="card border-0 shadow-sm rounded-4">

                <div class="card-body">

                    <div class="d-flex justify-content-between align-items-center mb-3 flex-wrap gap-2">

                        <div>

                            <h6 class="fw-bold mb-1">
                                Daftar Pesanan
                            </h6>

                            <small class="text-muted">
                                Seluruh transaksi customer
                            </small>

                        </div>

                        <span class="badge bg-primary">
                            {{ $payments->count() }} data
                        </span>

                    </div>

                    <div class="table-responsive">

                        <table class="table align-middle">

                            <thead class="small">

                                <tr>

                                    <th>Invoice</th>
                                    <th>Customer</th>
                                    <th>Total</th>
                                    <th>Status</th>
                                    <th>Rental</th>
                                    <th>Aksi</th>

                                </tr>

                            </thead>

                            <tbody>

                                @forelse ($payments as $payment)

                                <tr>

                                    {{-- INVOICE --}}
                                    <td class="fw-semibold small">
                                        #{{ $payment->id }}
                                    </td>

                                    {{-- USER --}}
                                    <td>

                                        <div class="d-flex align-items-center gap-2">

                                            <div class="bg-primary text-white rounded-circle d-flex justify-content-center align-items-center fw-bold small"
                                                style="width:38px; height:38px;">

                                                {{ strtoupper(substr($payment->user->name ?? 'U', 0, 1)) }}

                                            </div>

                                            <div>

                                                <div class="fw-semibold small">
                                                    {{ $payment->user->name ?? '-' }}
                                                </div>

                                                <small class="text-muted">
                                                    {{ $payment->user->email ?? '-' }}
                                                </small>

                                            </div>

                                        </div>

                                    </td>

                                    {{-- TOTAL --}}
                                    <td class="fw-bold text-success small">

                                        Rp{{ number_format($payment->total,0,',','.') }}

                                    </td>

                                    {{-- STATUS --}}
                                    <td>

                                        @if($payment->status == 'paid')

                                        <span class="badge bg-success">
                                            Paid
                                        </span>

                                        @else

                                        <span class="badge bg-warning text-dark">
                                            Pending
                                        </span>

                                        @endif

                                    </td>

                                    {{-- RENTAL --}}
                                    <td>

                                        @if($payment->rental_status == 'belum_diambil')

                                        <span class="badge bg-warning text-dark">
                                            Belum
                                        </span>

                                        @elseif($payment->rental_status == 'disewakan')

                                        <span class="badge bg-primary">
                                            Disewa
                                        </span>

                                        @else

                                        <span class="badge bg-success">
                                            Selesai
                                        </span>

                                        @endif

                                    </td>

                                    {{-- ACTION --}}
                                    <td>

                                        <form action="{{ route('admin.payments.updateStatus', $payment->id) }}"
                                            method="POST" class="d-flex gap-1 align-items-center">

                                            @csrf

                                            <select name="rental_status"
                                                class="form-select form-select-sm rounded-3 small">

                                                <option value="belum_diambil"
                                                    {{ $payment->rental_status == 'belum_diambil' ? 'selected' : '' }}>
                                                    Belum
                                                </option>

                                                <option value="disewakan"
                                                    {{ $payment->rental_status == 'disewakan' ? 'selected' : '' }}>
                                                    Disewa
                                                </option>

                                                <option value="selesai"
                                                    {{ $payment->rental_status == 'selesai' ? 'selected' : '' }}>
                                                    Selesai
                                                </option>

                                            </select>

                                            <button type="submit" class="btn btn-primary btn-sm rounded-3">

                                                Simpan

                                            </button>

                                        </form>

                                    </td>

                                </tr>

                                @empty

                                <tr>

                                    <td colspan="6" class="text-center text-muted py-4">

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

        {{-- REVIEW --}}
        <div class="col-lg-4">

            <div class="card border-0 shadow-sm rounded-4">

                <div class="card-body">

                    <div class="d-flex justify-content-between align-items-center mb-3">

                        <h6 class="fw-bold mb-0">
                            Review Customer
                        </h6>

                        <span class="badge bg-success">
                            {{ $payments->whereNotNull('rating')->count() }}
                        </span>

                    </div>

                    @forelse ($payments->whereNotNull('rating') as $payment)

                    <div class="border rounded-4 p-3 mb-3 bg-light">

                        <div class="d-flex align-items-center gap-2 mb-2">

                            <div class="bg-primary text-white rounded-circle d-flex justify-content-center align-items-center fw-bold small"
                                style="width:35px; height:35px;">

                                {{ strtoupper(substr($payment->user->name ?? 'U', 0, 1)) }}

                            </div>

                            <div>

                                <div class="fw-semibold small">
                                    {{ $payment->user->name ?? '-' }}
                                </div>

                                <small class="text-warning">
                                    {{ str_repeat('⭐', $payment->rating) }}
                                </small>

                            </div>

                        </div>

                        <p class="text-muted small mb-2">

                            {{ $payment->review }}

                        </p>

                    </div>

                    @empty

                    <div class="text-center text-muted py-4 small">

                        Belum ada review customer

                    </div>

                    @endforelse

                </div>

            </div>

        </div>

    </div>

</div>

@endsection
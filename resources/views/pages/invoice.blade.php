@extends('layouts.app')

@section('title', 'Invoice')

@section('content')

<style>
    .invoice-page {
        padding: 30px 0;
        background: #f8fafc;
        min-height: 100vh;
    }

    .invoice-card {
        max-width: 760px;
        margin: auto;
        background: #fff;
        border-radius: 24px;
        padding: 28px;
        box-shadow: 0 8px 25px rgba(15, 23, 42, .06);
    }

    .invoice-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 24px;
        padding-bottom: 18px;
        border-bottom: 1px solid #e2e8f0;
    }

    .invoice-header h1 {
        font-size: 26px;
        margin-bottom: 6px;
        font-weight: 800;
        color: #0f172a;
    }

    .invoice-header p {
        margin: 0;
        color: #64748b;
        font-size: 14px;
    }

    .invoice-status {
        background: #dcfce7;
        color: #166534;
        padding: 10px 18px;
        border-radius: 999px;
        font-size: 12px;
        font-weight: 700;
    }

    .invoice-info {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 14px;
        margin-bottom: 24px;
    }

    .invoice-info div {
        background: #f8fafc;
        padding: 16px;
        border-radius: 16px;
    }

    .invoice-info span {
        display: block;
        font-size: 12px;
        color: #64748b;
        margin-bottom: 6px;
    }

    .invoice-info strong {
        font-size: 15px;
        color: #0f172a;
    }

    .invoice-user {
        margin-bottom: 24px;
    }

    .invoice-user h3 {
        font-size: 18px;
        margin-bottom: 10px;
        color: #0f172a;
    }

    .invoice-user p {
        margin-bottom: 4px;
        color: #475569;
        font-size: 14px;
    }

    .invoice-table {
        width: 100%;
        border-collapse: collapse;
        margin-bottom: 24px;
    }

    .invoice-table thead {
        background: #f8fafc;
    }

    .invoice-table thead th {
        padding: 14px;
        text-align: left;
        font-size: 13px;
        color: #0f172a;
    }

    .invoice-table tbody td {
        padding: 14px;
        border-top: 1px solid #e2e8f0;
        font-size: 14px;
        color: #475569;
    }

    .invoice-total {
        display: flex;
        justify-content: space-between;
        align-items: center;
        background: #eff6ff;
        padding: 18px 20px;
        border-radius: 18px;
        margin-bottom: 24px;
    }

    .invoice-total span {
        font-size: 14px;
        color: #1e3a8a;
        font-weight: 600;
    }

    .invoice-total h2 {
        margin: 0;
        font-size: 24px;
        font-weight: 800;
        color: #2563eb;
    }

    .invoice-actions {
        display: flex;
        gap: 12px;
        flex-wrap: wrap;
    }

    .btn-print,
    .btn-dashboard {
        text-decoration: none;
        border: none;
        padding: 12px 18px;
        border-radius: 12px;
        font-size: 14px;
        font-weight: 700;
        cursor: pointer;
        transition: .3s;
    }

    .btn-print {
        background: #2563eb;
        color: white;
    }

    .btn-print:hover {
        background: #1d4ed8;
    }

    .btn-dashboard {
        background: #0f172a;
        color: white;
    }

    .btn-dashboard:hover {
        background: #020617;
        color: white;
    }

    @media(max-width:768px) {

        .invoice-card {
            padding: 20px;
        }

        .invoice-info {
            grid-template-columns: 1fr;
        }

        .invoice-header {
            flex-direction: column;
            align-items: flex-start;
            gap: 12px;
        }

        .invoice-total {
            flex-direction: column;
            align-items: flex-start;
            gap: 8px;
        }

    }

    @media print {

        .btn-print,
        .btn-dashboard {
            display: none;
        }

        body {
            background: white;
        }

        .invoice-card {
            box-shadow: none;
        }

    }
</style>

<section class="invoice-page">

    <div class="container">

        <div class="invoice-card">

            {{-- HEADER --}}
            <div class="invoice-header">

                <div>

                    <h1>
                        Invoice
                    </h1>

                    <p>
                        iRent Premium Rental
                    </p>

                </div>

                <div class="invoice-status">
                    {{ strtoupper($payment->status) }}
                </div>

            </div>

            {{-- INFO --}}
            <div class="invoice-info">

                <div>
                    <span>Invoice ID</span>
                    <strong>#{{ $payment->id }}</strong>
                </div>

                <div>
                    <span>Tanggal</span>
                    <strong>{{ $payment->created_at->format('d M Y') }}</strong>
                </div>

                <div>
                    <span>Metode</span>
                    <strong>{{ strtoupper($payment->payment_method) }}</strong>
                </div>

            </div>

            {{-- USER --}}
            <div class="invoice-user">

                <h3>Data Penyewa</h3>

                <p>{{ $payment->user->name }}</p>

                <p>{{ $payment->user->email }}</p>

            </div>

            {{-- TABLE --}}
            <table class="invoice-table">

                <thead>

                    <tr>
                        <th>Produk</th>
                        <th>Durasi</th>
                        <th>Total</th>
                    </tr>

                </thead>

                <tbody>

                    @foreach ($payment->carts as $cart)

                    <tr>

                        <td>
                            {{ $cart->product->name }}
                        </td>

                        <td>
                            {{ $cart->duration }} Hari
                        </td>

                        <td>
                            Rp{{ number_format($cart->total,0,',','.') }}
                        </td>

                    </tr>

                    @endforeach

                </tbody>

            </table>

            {{-- TOTAL --}}
            <div class="invoice-total">

                <span>
                    Total Pembayaran
                </span>

                <h2>
                    Rp{{ number_format($payment->total,0,',','.') }}
                </h2>

            </div>

            {{-- ACTION --}}
            <div class="invoice-actions">

                <button onclick="window.print()" class="btn-print">
                    Print
                </button>

                <a href="{{ route('dashboard') }}" class="btn-dashboard">
                    Riwayat Transaksi
                </a>

            </div>

        </div>

    </div>

</section>

@endsection
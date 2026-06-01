@extends('layouts.app')

@section('title', 'Riwayat Transaksi')

@section('content')

<style>
    .container {
        padding: 40px 20px 80px;
    }

    .hero {
        margin-bottom: 35px;
    }

    .hero h1 {
        font-size: 34px;
        font-weight: 800;
        color: #0f172a;
        margin-bottom: 10px;
    }

    .hero p {
        color: #64748b;
        font-size: 15px;
    }

    .summary {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(180px, 1fr));
        gap: 20px;
        margin-bottom: 35px;
    }

    .box {
        background: white;
        padding: 24px;
        border-radius: 22px;
        box-shadow: 0 10px 30px rgba(15, 23, 42, .06);
    }

    .box div {
        color: #64748b;
        margin-bottom: 8px;
    }

    .box strong {
        font-size: 28px;
        color: #0f172a;
    }

    .list {
        display: flex;
        flex-direction: column;
        gap: 25px;
    }

    .card {
        background: white;
        border-radius: 26px;
        padding: 28px;
        box-shadow: 0 12px 35px rgba(15, 23, 42, .06);
    }

    .top {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 25px;
        flex-wrap: wrap;
        gap: 15px;
    }

    .date {
        color: #64748b;
        font-size: 14px;
        margin-top: 6px;
    }

    .status {
        padding: 10px 16px;
        border-radius: 999px;
        font-size: 13px;
        font-weight: 700;
    }

    .status.paid {
        background: #dcfce7;
        color: #166534;
    }

    .status.pending {
        background: #fef3c7;
        color: #92400e;
    }

    .items {
        display: flex;
        flex-direction: column;
        gap: 18px;
    }

    .row {
        display: flex;
        justify-content: space-between;
        gap: 20px;
        padding-bottom: 18px;
        border-bottom: 1px solid #e2e8f0;
    }

    .name {
        font-weight: 700;
        color: #0f172a;
    }

    .name span {
        display: block;
        margin-top: 6px;
        font-size: 14px;
        color: #64748b;
        font-weight: 500;
    }

    .price {
        font-weight: 700;
        color: #2563eb;
    }

    .bottom {
        margin-top: 24px;
        font-size: 18px;
        font-weight: 800;
        color: #0f172a;
    }

    .rental-section {
        margin-top: 25px;
        padding-top: 20px;
        border-top: 1px solid #e2e8f0;
    }

    .rental-title {
        font-size: 15px;
        font-weight: 700;
        color: #0f172a;
        margin-bottom: 15px;
    }

    .rental-badge {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        padding: 10px 16px;
        border-radius: 999px;
        font-size: 13px;
        font-weight: 700;
        margin-bottom: 20px;
    }

    .rental-badge.belum_diambil {
        background: #fef3c7;
        color: #92400e;
    }

    .rental-badge.disewakan {
        background: #dbeafe;
        color: #1d4ed8;
    }

    .rental-badge.selesai {
        background: #dcfce7;
        color: #166534;
    }

    .rating-box {
        background: #f8fafc;
        padding: 20px;
        border-radius: 18px;
    }

    .rating-box h4 {
        margin-bottom: 15px;
        color: #0f172a;
    }

    .rating-box select,
    .rating-box textarea {
        width: 100%;
        border: 1px solid #dbe2ea;
        border-radius: 14px;
        padding: 14px;
        margin-bottom: 14px;
        outline: none;
    }

    .rating-box textarea {
        min-height: 100px;
        resize: none;
    }

    .rating-btn {
        padding: 14px 20px;
        border: none;
        border-radius: 14px;
        background: #2563eb;
        color: white;
        font-weight: 700;
        cursor: pointer;
        transition: .3s;
    }

    .rating-btn:hover {
        background: #1d4ed8;
    }

    .rating-result {
        background: #eff6ff;
        padding: 18px;
        border-radius: 16px;
    }

    .rating-result strong {
        display: block;
        margin-bottom: 8px;
        color: #0f172a;
    }

    .empty {
        text-align: center;
        padding: 60px 20px;
        color: #64748b;
    }

    .wa-btn {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 10px;
        padding: 14px 18px;
        border-radius: 14px;
        background: #22c55e;
        color: white;
        text-decoration: none;
        font-weight: 700;
        margin-top: 18px;
        transition: .3s;
    }

    .wa-btn:hover {
        background: #16a34a;
    }

    @media(max-width:768px) {

        .row {
            flex-direction: column;
        }

        .top {
            align-items: flex-start;
        }

    }
</style>

<section class="container">

    {{-- HERO --}}
    <div class="hero">

        <h1>Riwayat Transaksi</h1>

        <p>
            Semua rental iPhone kamu tersimpan lengkap beserta detail produk.
        </p>

    </div>

    {{-- SUMMARY --}}
    <div class="summary">

        <div class="box">
            <div>Total</div>
            <strong>{{ $payments->count() }}</strong>
        </div>

        <div class="box">
            <div>Lunas</div>
            <strong>{{ $payments->where('status','paid')->count() }}</strong>
        </div>

        <div class="box">
            <div>Aktif</div>
            <strong>{{ $payments->where('rental_status','disewakan')->count() }}</strong>
        </div>

    </div>

    {{-- LIST --}}
    <div class="list">

        @forelse ($payments as $payment)

        <div class="card">

            {{-- HEADER --}}
            <div class="top">

                <div>

                    <strong>
                        #{{ $payment->id }}
                    </strong>

                    <div class="date">
                        {{ $payment->created_at->format('d M Y') }}
                    </div>

                </div>

                <span class="status {{ $payment->status }}">
                    {{ ucfirst($payment->status) }}
                </span>

            </div>

            {{-- ITEMS --}}
            <div class="items">

                @foreach ($payment->carts as $cart)

                <div class="row">

                    <div class="name">

                        {{ $cart->product->name ?? $cart->product_name }}

                        <span>
                            {{ $cart->product->storage ?? $cart->product_storage }}
                            • {{ $cart->duration }} hari
                        </span>

                    </div>

                    <div class="price">
                        Rp{{ number_format($cart->total,0,',','.') }}
                    </div>

                </div>

                @endforeach

            </div>

            {{-- TOTAL --}}
            <div class="bottom">

                Total:
                Rp{{ number_format($payment->total,0,',','.') }}

            </div>

            {{-- RENTAL STATUS --}}
            <div class="rental-section">

                <div class="rental-title">
                    Status Rental
                </div>

                <span class="rental-badge {{ $payment->rental_status }}">
                    {{ str_replace('_', ' ', ucfirst($payment->rental_status)) }}
                </span>

                {{-- WHATSAPP ADMIN --}}
                <div>
                    <a href="https://wa.me/6281234567890?text=Halo admin, saya ingin bertanya tentang pesanan%20%23{{ $payment->id }}"
                        target="_blank" class="wa-btn">
                        Hubungi Admin
                    </a>
                </div>

                {{-- RATING --}}
                @if($payment->rental_status == 'selesai')

                <div class="rating-box" style="margin-top:20px;">

                    @if(!$payment->rating)

                    <h4>Berikan Rating</h4>

                    <form action="{{ route('payment.storeRating', $payment->id) }}" method="POST">

                        @csrf

                        <select name="rating" required>

                            <option value="">
                                Pilih Rating
                            </option>

                            <option value="5">
                                ⭐⭐⭐⭐⭐
                            </option>

                            <option value="4">
                                ⭐⭐⭐⭐
                            </option>

                            <option value="3">
                                ⭐⭐⭐
                            </option>

                            <option value="2">
                                ⭐⭐
                            </option>

                            <option value="1">
                                ⭐
                            </option>

                        </select>

                        <textarea name="review" placeholder="Tulis review pengalaman rental..."></textarea>

                        <button type="submit" class="rating-btn">
                            Kirim Rating
                        </button>

                    </form>

                    @else

                    <div class="rating-result">

                        <strong>
                            Rating Customer
                        </strong>

                        <div style="font-size:20px;margin-bottom:8px;">
                            {{ str_repeat('⭐', $payment->rating) }}
                        </div>

                        <div>
                            {{ $payment->review }}
                        </div>

                    </div>

                    @endif

                </div>

                @endif

            </div>

        </div>

        @empty

        <p class="empty">
            Belum ada transaksi
        </p>

        @endforelse

    </div>

</section>

@endsection
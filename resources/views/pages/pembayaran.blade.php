@extends('layouts.app')

@section('title', 'Pembayaran')

@section('content')

<style>
    .payment-page {
        padding: 40px 0;
    }

    .payment-header {
        margin-bottom: 30px;
    }

    .payment-header h2 {
        font-size: 34px;
        font-weight: 800;
        color: #0f172a;
        margin-bottom: 10px;
    }

    .payment-header p {
        color: #64748b;
        font-size: 15px;
    }

    .payment-grid {
        display: grid;
        grid-template-columns: 1.7fr 1fr;
        gap: 28px;
        align-items: start;
    }

    .payment-list {
        display: flex;
        flex-direction: column;
        gap: 18px;
    }

    .payment-card {
        background: #fff;
        border-radius: 24px;
        padding: 20px;
        box-shadow: 0 10px 30px rgba(15, 23, 42, .06);
        display: flex;
        justify-content: space-between;
        align-items: center;
        gap: 20px;
    }

    .payment-left {
        display: flex;
        align-items: center;
        gap: 18px;
    }

    .payment-left img {
        width: 95px;
        height: 95px;
        object-fit: cover;
        border-radius: 18px;
        background: #f8fafc;
    }

    .payment-info-product h3 {
        font-size: 18px;
        font-weight: 700;
        color: #0f172a;
        margin-bottom: 8px;
    }

    .payment-info-product p {
        color: #64748b;
        font-size: 14px;
        margin: 0;
    }

    .price-text {
        font-size: 20px;
        font-weight: 800;
        color: #2563eb;
        margin: 0;
        white-space: nowrap;
    }

    .payment-summary {
        background: #fff;
        border-radius: 28px;
        padding: 28px;
        box-shadow: 0 10px 30px rgba(15, 23, 42, .06);
        position: sticky;
        top: 20px;
    }

    .summary-item,
    .summary-total {
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .summary-item {
        padding-bottom: 20px;
        border-bottom: 1px solid #e2e8f0;
        margin-bottom: 20px;
    }

    .summary-item span {
        color: #64748b;
    }

    .summary-total span {
        font-size: 15px;
        color: #64748b;
    }

    .summary-total h2 {
        font-size: 28px;
        color: #0f172a;
        font-weight: 800;
        margin: 0;
    }

    .payment-method {
        margin-top: 28px;
    }

    .payment-method label {
        display: block;
        margin-bottom: 10px;
        font-weight: 700;
        color: #0f172a;
    }

    .payment-method select {
        width: 100%;
        padding: 14px 16px;
        border-radius: 14px;
        border: 1px solid #dbe2ea;
        background: #f8fafc;
        outline: none;
        font-size: 15px;
    }

    .payment-info {
        margin-top: 18px;
        background: #f8fafc;
        border-radius: 18px;
        padding: 20px;
        display: none;
    }

    .payment-info h4 {
        margin-bottom: 12px;
        color: #0f172a;
        font-size: 18px;
    }

    .payment-info p {
        color: #475569;
        margin-bottom: 8px;
        line-height: 1.7;
    }

    .qris-image {
        width: 220px;
        max-width: 100%;
        border-radius: 18px;
        margin-top: 10px;
    }

    .btn-checkout {
        width: 100%;
        margin-top: 28px;
        border: none;
        background: #2563eb;
        color: white;
        padding: 16px;
        border-radius: 16px;
        font-size: 16px;
        font-weight: 700;
        cursor: pointer;
        transition: .3s;
    }

    .btn-checkout:hover {
        background: #1d4ed8;
    }

    .alert-success {
        background: #dcfce7;
        color: #166534;
        padding: 16px 18px;
        border-radius: 14px;
        margin-bottom: 20px;
        font-weight: 600;
    }

    .alert-error {
        background: #fee2e2;
        color: #991b1b;
        padding: 16px 18px;
        border-radius: 14px;
        margin-bottom: 20px;
        font-weight: 600;
    }

    @media(max-width: 992px) {

        .payment-grid {
            grid-template-columns: 1fr;
        }

        .payment-summary {
            position: relative;
        }

    }

    @media(max-width: 600px) {

        .payment-card {
            flex-direction: column;
            align-items: flex-start;
        }

        .payment-left {
            width: 100%;
        }

        .price-text {
            width: 100%;
        }

    }
</style>

<section class="payment-page">

    <div class="container">

        {{-- ALERT --}}
        @if(session('success'))

        <div class="alert-success">
            {{ session('success') }}
        </div>

        @endif

        @if(session('error'))

        <div class="alert-error">
            {{ session('error') }}
        </div>

        @endif

        {{-- HEADER --}}
        <div class="payment-header">

            <h2>Pembayaran</h2>

            <p>
                Konfirmasi pembayaran rental iPhone kamu
            </p>

        </div>

        <div class="payment-grid">

            {{-- LEFT --}}
            <div class="payment-list">

                @forelse ($carts as $cart)

                <div class="payment-card">

                    <div class="payment-left">

                        <img src="{{ asset('storage/' . $cart->product->image) }}" alt="{{ $cart->product->name }}">

                        <div class="payment-info-product">

                            <h3>
                                {{ $cart->product->name }}
                            </h3>

                            <p>
                                Rental {{ $cart->duration }} Hari
                            </p>

                        </div>

                    </div>

                    <h3 class="price-text">
                        Rp{{ number_format($cart->total, 0, ',', '.') }}
                    </h3>

                </div>

                @empty

                <div class="payment-card">

                    <div>

                        <h3>Keranjang kosong</h3>

                        <p>
                            Silakan tambahkan produk terlebih dahulu
                        </p>

                    </div>

                </div>

                @endforelse

            </div>

            {{-- RIGHT --}}
            <div class="payment-summary">

                <div class="summary-item">

                    <span>Total</span>

                    <strong>
                        Rp{{ number_format($grandTotal, 0, ',', '.') }}
                    </strong>

                </div>

                <div class="summary-total">

                    <span>Total Bayar</span>

                    <h2>
                        Rp{{ number_format($grandTotal, 0, ',', '.') }}
                    </h2>

                </div>

                <form action="{{ route('pembayaran.store') }}" method="POST">

                    @csrf

                    <div class="payment-method">

                        <label>Metode Pembayaran</label>

                        <select name="payment_method" id="payment_method" required>

                            <option value="">
                                -- Pilih Metode --
                            </option>

                            <option value="cash">
                                Cash
                            </option>

                            <option value="transfer">
                                Transfer Bank
                            </option>

                            <option value="qris">
                                QRIS
                            </option>

                            <option value="ewallet">
                                E-Wallet
                            </option>

                        </select>

                    </div>

                    {{-- CASH --}}
                    <div class="payment-info" id="cashBox">

                        <h4>Pembayaran Cash</h4>

                        <p>
                            Silakan datang langsung ke store iRent untuk melakukan pembayaran.
                        </p>

                    </div>

                    {{-- TRANSFER --}}
                    <div class="payment-info" id="transferBox">

                        <h4>Transfer Bank</h4>

                        <p>BCA : 1234567890</p>

                        <p>A/N iRent Indonesia</p>

                    </div>

                    {{-- QRIS --}}
                    <div class="payment-info" id="qrisBox">

                        <h4>Scan QRIS</h4>

                        <img src="{{ asset('images/qris.png') }}" class="qris-image" alt="QRIS">

                    </div>

                    {{-- EWALLET --}}
                    <div class="payment-info" id="ewalletBox">

                        <h4>E-Wallet</h4>

                        <p>DANA / OVO / GoPay</p>

                        <p>0812-3456-7890</p>

                    </div>

                    <button type="submit" class="btn-checkout">
                        Bayar Sekarang
                    </button>

                </form>

            </div>

        </div>

    </div>

</section>

<script>
    const paymentMethod = document.getElementById('payment_method');

    const cashBox = document.getElementById('cashBox');
    const transferBox = document.getElementById('transferBox');
    const qrisBox = document.getElementById('qrisBox');
    const ewalletBox = document.getElementById('ewalletBox');

    function hideAllPayments() {

        cashBox.style.display = 'none';
        transferBox.style.display = 'none';
        qrisBox.style.display = 'none';
        ewalletBox.style.display = 'none';

    }

    hideAllPayments();

    paymentMethod.addEventListener('change', function() {

        hideAllPayments();

        if (this.value === 'cash') {
            cashBox.style.display = 'block';
        }

        if (this.value === 'transfer') {
            transferBox.style.display = 'block';
        }

        if (this.value === 'qris') {
            qrisBox.style.display = 'block';
        }

        if (this.value === 'ewallet') {
            ewalletBox.style.display = 'block';
        }

    });
</script>

@endsection
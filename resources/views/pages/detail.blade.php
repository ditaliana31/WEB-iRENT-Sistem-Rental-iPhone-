@extends('layouts.app')

@section('title', $product->name)

@section('content')

<style>
    .detail-section {
        padding: 40px 0;
        background: #f5f7fb;
        min-height: 100vh;
    }

    .detail-wrapper {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 28px;
        background: #fff;
        border-radius: 24px;
        padding: 28px;
        border: 1px solid #e5e7eb;
        box-shadow: 0 10px 30px rgba(0, 0, 0, .04);
    }

    .detail-image-card {
        background: #f8fafc;
        border-radius: 22px;
        padding: 24px;
        display: flex;
        align-items: center;
        justify-content: center;
        min-height: 500px;
    }

    .detail-image-card img {
        width: 100%;
        max-width: 400px;
        height: 400px;
        object-fit: contain;
    }

    .detail-badge {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        padding: 8px 16px;
        border-radius: 999px;
        font-size: 13px;
        font-weight: 700;
        margin-bottom: 16px;
    }

    .badge-available {
        background: #dcfce7;
        color: #16a34a;
    }

    .badge-rented {
        background: #fee2e2;
        color: #dc2626;
    }

    .detail-content h1 {
        font-size: 38px;
        line-height: 1.2;
        color: #0f172a;
        margin-bottom: 12px;
        font-weight: 800;
    }

    .detail-price {
        font-size: 34px;
        font-weight: 800;
        color: #2563eb;
        margin-bottom: 18px;
    }

    .detail-price span {
        font-size: 16px;
        color: #64748b;
        font-weight: 500;
    }

    .detail-description {
        color: #64748b;
        line-height: 1.8;
        font-size: 15px;
        margin-bottom: 28px;
    }

    .detail-specs {
        display: grid;
        grid-template-columns: repeat(2, 1fr);
        gap: 16px;
        margin-bottom: 30px;
    }

    .spec-card {
        background: #f8fafc;
        border: 1px solid #e2e8f0;
        border-radius: 18px;
        padding: 18px;
    }

    .spec-card h4 {
        color: #64748b;
        font-size: 13px;
        margin-bottom: 8px;
        font-weight: 600;
    }

    .spec-card p {
        font-size: 18px;
        font-weight: 700;
        color: #0f172a;
        margin: 0;
    }

    .rental-box {
        background: #f8fafc;
        border-radius: 22px;
        padding: 24px;
        border: 1px solid #e2e8f0;
        margin-bottom: 24px;
    }

    .rental-box h3 {
        font-size: 22px;
        margin-bottom: 22px;
        color: #0f172a;
        font-weight: 700;
    }

    .rental-grid {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 18px;
        margin-bottom: 18px;
    }

    .form-group label {
        display: block;
        margin-bottom: 10px;
        font-size: 14px;
        font-weight: 700;
        color: #334155;
    }

    .form-group input,
    .form-group select {
        width: 100%;
        padding: 15px 18px;
        border-radius: 14px;
        border: 1px solid #dbe2ea;
        font-size: 15px;
        background: white;
        outline: none;
        transition: .2s;
    }

    .form-group input:focus,
    .form-group select:focus {
        border-color: #2563eb;
        box-shadow: 0 0 0 4px rgba(37, 99, 235, .1);
    }

    .date-result {
        margin-top: 10px;
        font-size: 13px;
        color: #64748b;
        font-weight: 500;
    }

    .total-box {
        background: white;
        border-radius: 18px;
        padding: 20px;
        border: 1px solid #e2e8f0;
        margin-top: 20px;
    }

    .total-box h4 {
        font-size: 14px;
        color: #64748b;
        margin-bottom: 8px;
    }

    .total-price {
        font-size: 34px;
        font-weight: 800;
        color: #0f172a;
    }

    .detail-buttons {
        display: flex;
        gap: 14px;
        flex-wrap: wrap;
    }

    .btn-rent,
    .btn-disabled,
    .btn-back {
        padding: 16px 24px;
        border-radius: 16px;
        font-size: 15px;
        font-weight: 700;
        text-decoration: none;
        border: none;
        cursor: pointer;
        transition: .2s;
    }

    .btn-rent {
        background: #2563eb;
        color: white;
        box-shadow: 0 10px 20px rgba(37, 99, 235, .2);
    }

    .btn-rent:hover {
        transform: translateY(-2px);
    }

    .btn-disabled {
        background: #cbd5e1;
        color: #64748b;
        cursor: not-allowed;
    }

    .btn-back {
        background: #e2e8f0;
        color: #0f172a;
    }

    .alert-danger {
        background: #fee2e2;
        color: #b91c1c;
        padding: 16px;
        border-radius: 14px;
        margin-bottom: 20px;
        font-weight: 600;
    }

    @media(max-width:992px) {

        .detail-wrapper {
            grid-template-columns: 1fr;
        }

        .detail-content h1 {
            font-size: 34px;
        }
    }

    @media(max-width:768px) {

        .detail-section {
            padding: 20px 0;
        }

        .detail-wrapper {
            padding: 20px;
            border-radius: 20px;
        }

        .detail-image-card {
            min-height: auto;
        }

        .detail-image-card img {
            height: 280px;
        }

        .detail-specs {
            grid-template-columns: 1fr;
        }

        .rental-grid {
            grid-template-columns: 1fr;
        }

        .detail-buttons {
            flex-direction: column;
        }

        .btn-rent,
        .btn-disabled,
        .btn-back {
            width: 100%;
            text-align: center;
        }

        .detail-content h1 {
            font-size: 28px;
        }

        .detail-price {
            font-size: 28px;
        }

        .total-price {
            font-size: 30px;
        }
    }
</style>

<section class="detail-section">

    <div class="container">

        @if(session('error'))

        <div class="alert-danger">
            {{ session('error') }}
        </div>

        @endif

        <div class="detail-wrapper">

            {{-- IMAGE --}}
            <div class="detail-image-card">

                <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}">

            </div>

            {{-- CONTENT --}}
            <div class="detail-content">

                <div class="detail-badge 
                    {{ $product->status == 'Available' ? 'badge-available' : 'badge-rented' }}">

                    ● {{ $product->status }}

                </div>

                <h1>
                    {{ $product->name }}
                </h1>

                <div class="detail-price">

                    Rp{{ number_format($product->price, 0, ',', '.') }}

                    <span>/ hari</span>

                </div>

                <p class="detail-description">
                    {{ $product->description }}
                </p>

                {{-- SPECS --}}
                <div class="detail-specs">

                    <div class="spec-card">
                        <h4>Storage</h4>
                        <p>{{ $product->storage ?? '-' }}</p>
                    </div>

                    <div class="spec-card">
                        <h4>Battery Health</h4>
                        <p>{{ $product->battery ?? '-' }}</p>
                    </div>

                    <div class="spec-card">
                        <h4>Stock</h4>
                        <p>{{ $product->stock ?? '0' }} Unit</p>
                    </div>

                    <div class="spec-card">
                        <h4>Status</h4>
                        <p>{{ $product->status ?? '-' }}</p>
                    </div>

                </div>

                <form action="{{ route('keranjang.store', $product->id) }}" method="POST">

                    @csrf

                    <div class="rental-box">

                        <h3>
                            Atur Penyewaan
                        </h3>

                        <div class="rental-grid">

                            {{-- DURASI --}}
                            <div class="form-group">

                                <label>
                                    Durasi Sewa
                                </label>

                                <select id="rentalDays" name="duration"
                                    {{ $product->status == 'Rented' ? 'disabled' : '' }}>

                                    <option value="1">1 Hari</option>
                                    <option value="3">3 Hari</option>
                                    <option value="7">7 Hari</option>
                                    <option value="14">14 Hari</option>

                                </select>

                            </div>

                            {{-- TANGGAL --}}
                            <div class="form-group">

                                <label>
                                    Tanggal Mulai
                                </label>

                                <input type="date" id="startDate" name="start_date" required
                                    {{ $product->status == 'Rented' ? 'disabled' : '' }}>

                            </div>

                        </div>

                        {{-- TANGGAL SELESAI --}}
                        <div class="form-group">

                            <label>
                                Tanggal Selesai
                            </label>

                            <input type="text" id="endDate" readonly>

                            <div class="date-result">
                                Tanggal selesai otomatis dihitung dari durasi sewa
                            </div>

                        </div>

                        {{-- TOTAL --}}
                        <div class="total-box">

                            <h4>Total Estimasi</h4>

                            <div class="total-price" id="totalPrice">

                                Rp0

                            </div>

                        </div>

                    </div>

                    <div class="detail-buttons">

                        @if($product->status == 'Available')

                        <button type="submit" class="btn-rent">

                            Tambah ke Keranjang 🛒

                        </button>

                        @else

                        <button type="button" class="btn-disabled">

                            Produk Sedang Disewa

                        </button>

                        @endif

                        <a href="{{ route('katalog') }}" class="btn-back">

                            Kembali

                        </a>

                    </div>

                </form>

            </div>

        </div>

    </div>

</section>

<script>
    const rentalDays = document.getElementById('rentalDays');
    const totalPrice = document.getElementById('totalPrice');
    const startDate = document.getElementById('startDate');
    const endDate = document.getElementById('endDate');

    const hargaPerHari = Number('{{ $product->price }}');

    function updateTotal() {

        if (!rentalDays) return;

        const days = parseInt(rentalDays.value);

        const total = hargaPerHari * days;

        totalPrice.innerHTML =
            'Rp' + total.toLocaleString('id-ID');
    }

    function updateEndDate() {

        if (!startDate.value) {

            endDate.value = '';
            return;
        }

        const days = parseInt(rentalDays.value);

        let start = new Date(startDate.value);

        start.setDate(start.getDate() + days);

        const year = start.getFullYear();
        const month = String(start.getMonth() + 1).padStart(2, '0');
        const day = String(start.getDate()).padStart(2, '0');

        endDate.value = `${day}-${month}-${year}`;
    }

    if (rentalDays) {

        rentalDays.addEventListener('change', () => {

            updateTotal();
            updateEndDate();

        });

    }

    if (startDate) {

        startDate.addEventListener('change', updateEndDate);

    }

    updateTotal();
</script>

@endsection
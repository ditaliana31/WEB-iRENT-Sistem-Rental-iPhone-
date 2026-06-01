@extends('layouts.admin')

@section('title', 'Tambah Produk')

@section('content')

<div class="container-fluid py-4">

    {{-- HEADER --}}
    <div class="d-flex justify-content-between align-items-center mb-4">

        <div>

            <h2 class="fw-bold mb-1">
                Tambah Produk
            </h2>

            <p class="text-muted mb-0">
                Tambahkan produk iPhone baru ke katalog iRent.
            </p>

        </div>

        <a href="{{ route('admin.products.index') }}" class="btn btn-light rounded-3 px-4">

            ← Kembali
        </a>

    </div>

    {{-- ALERT --}}
    @if ($errors->any())

    <div class="alert alert-danger rounded-4 border-0 shadow-sm">

        <ul class="mb-0">

            @foreach ($errors->all() as $error)

            <li>{{ $error }}</li>

            @endforeach

        </ul>

    </div>

    @endif

    {{-- FORM CARD --}}
    <div class="card border-0 shadow-sm rounded-4">

        <div class="card-body p-4">

            <form action="{{ route('admin.products.store') }}" method="POST" enctype="multipart/form-data">

                @csrf

                <div class="row g-4">

                    {{-- NAMA --}}
                    <div class="col-md-6">

                        <label class="form-label fw-semibold">
                            Nama Produk
                        </label>

                        <input type="text" name="name" value="{{ old('name') }}" class="form-control rounded-3"
                            placeholder="iPhone 15 Pro Max">

                    </div>

                    {{-- HARGA --}}
                    <div class="col-md-6">

                        <label class="form-label fw-semibold">
                            Harga Sewa / Hari
                        </label>

                        <div class="input-group">

                            <span class="input-group-text">
                                Rp
                            </span>

                            <input type="number" name="price" value="{{ old('price') }}"
                                class="form-control rounded-end-3" placeholder="200000">

                        </div>

                    </div>

                    {{-- STORAGE --}}
                    <div class="col-md-6">

                        <label class="form-label fw-semibold">
                            Storage
                        </label>

                        <input type="text" name="storage" value="{{ old('storage') }}" class="form-control rounded-3"
                            placeholder="256GB">

                    </div>

                    {{-- BATTERY --}}
                    <div class="col-md-6">

                        <label class="form-label fw-semibold">
                            Battery Health
                        </label>

                        <input type="text" name="battery" value="{{ old('battery') }}" class="form-control rounded-3"
                            placeholder="95%">

                    </div>

                    {{-- STOCK --}}
                    <div class="col-md-6">

                        <label class="form-label fw-semibold">
                            Stock
                        </label>

                        <input type="number" name="stock" value="{{ old('stock') }}" class="form-control rounded-3"
                            placeholder="10">

                    </div>

                    {{-- STATUS --}}
                    <div class="col-md-6">

                        <label class="form-label fw-semibold">
                            Status
                        </label>

                        <select name="status" class="form-select rounded-3">

                            <option value="Available">
                                Available
                            </option>

                            <option value="Rented">
                                Rented
                            </option>

                        </select>

                    </div>

                    {{-- GAMBAR --}}
                    <div class="col-12">

                        <label class="form-label fw-semibold">
                            Gambar Produk
                        </label>

                        <input type="file" name="image" class="form-control rounded-3">

                        <small class="text-muted">
                            Format: JPG, PNG, WEBP (maksimal 2MB)
                        </small>

                    </div>

                    {{-- DESKRIPSI --}}
                    <div class="col-12">

                        <label class="form-label fw-semibold">
                            Deskripsi
                        </label>

                        <textarea name="description" rows="5" class="form-control rounded-3"
                            placeholder="Masukkan deskripsi produk...">{{ old('description') }}</textarea>

                    </div>

                </div>

                {{-- BUTTON --}}
                <div class="d-flex justify-content-end gap-2 mt-4">

                    <a href="{{ route('admin.products.index') }}" class="btn btn-light rounded-3 px-4">

                        Batal
                    </a>

                    <button type="submit" class="btn btn-primary rounded-3 px-4">

                        Simpan Produk
                    </button>

                </div>

            </form>

        </div>

    </div>

</div>

@endsection
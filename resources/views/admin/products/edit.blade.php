@extends('layouts.admin')

@section('title', 'Edit Produk')

@section('content')

<div class="container-fluid py-4">

    {{-- HEADER --}}
    <div class="d-flex justify-content-between align-items-center mb-4">

        <div>

            <h2 class="fw-bold mb-1">
                Edit Produk
            </h2>

            <p class="text-muted mb-0">
                Perbarui data produk iRent dengan lengkap dan benar.
            </p>

        </div>

        <a href="{{ route('admin.products.index') }}" class="btn btn-light rounded-3 px-4">

            ← Kembali
        </a>

    </div>

    {{-- ALERT ERROR --}}
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

            <form method="POST" action="{{ route('admin.products.update', $product->id) }}"
                enctype="multipart/form-data">

                @csrf
                @method('PUT')

                <div class="row g-4">

                    {{-- NAMA PRODUK --}}
                    <div class="col-md-6">

                        <label class="form-label fw-semibold">
                            Nama Produk
                        </label>

                        <input type="text" name="name" value="{{ old('name', $product->name) }}"
                            class="form-control rounded-3" placeholder="iPhone 15 Pro Max">

                        @error('name')

                        <small class="text-danger">
                            {{ $message }}
                        </small>

                        @enderror

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

                            <input type="number" name="price" value="{{ old('price', $product->price) }}"
                                class="form-control rounded-end-3" placeholder="200000">

                        </div>

                        @error('price')

                        <small class="text-danger">
                            {{ $message }}
                        </small>

                        @enderror

                    </div>

                    {{-- STORAGE --}}
                    <div class="col-md-6">

                        <label class="form-label fw-semibold">
                            Storage
                        </label>

                        <input type="text" name="storage" value="{{ old('storage', $product->storage) }}"
                            class="form-control rounded-3" placeholder="256GB">

                        @error('storage')

                        <small class="text-danger">
                            {{ $message }}
                        </small>

                        @enderror

                    </div>

                    {{-- BATTERY --}}
                    <div class="col-md-6">

                        <label class="form-label fw-semibold">
                            Battery Health
                        </label>

                        <input type="text" name="battery" value="{{ old('battery', $product->battery) }}"
                            class="form-control rounded-3" placeholder="95%">

                        @error('battery')

                        <small class="text-danger">
                            {{ $message }}
                        </small>

                        @enderror

                    </div>

                    {{-- STOCK --}}
                    <div class="col-md-6">

                        <label class="form-label fw-semibold">
                            Stock
                        </label>

                        <input type="number" name="stock" value="{{ old('stock', $product->stock) }}"
                            class="form-control rounded-3" placeholder="10">

                        @error('stock')

                        <small class="text-danger">
                            {{ $message }}
                        </small>

                        @enderror

                    </div>

                    {{-- STATUS --}}
                    <div class="col-md-6">

                        <label class="form-label fw-semibold">
                            Status
                        </label>

                        <select name="status" class="form-select rounded-3">

                            <option value="Available" {{ $product->status == 'Available' ? 'selected' : '' }}>

                                ✅ Available
                            </option>

                            <option value="Rented" {{ $product->status == 'Rented' ? 'selected' : '' }}>

                                🚫 Rented
                            </option>

                        </select>

                        @error('status')

                        <small class="text-danger">
                            {{ $message }}
                        </small>

                        @enderror

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

                        {{-- PREVIEW IMAGE --}}
                        @if($product->image)

                        <div class="mt-3">

                            <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}"
                                class="rounded-4 border shadow-sm"
                                style="width: 180px; height: 180px; object-fit: cover;">

                        </div>

                        @endif

                        @error('image')

                        <small class="text-danger d-block mt-2">
                            {{ $message }}
                        </small>

                        @enderror

                    </div>

                    {{-- DESKRIPSI --}}
                    <div class="col-12">

                        <label class="form-label fw-semibold">
                            Deskripsi Produk
                        </label>

                        <textarea name="description" rows="5" class="form-control rounded-3"
                            placeholder="Masukkan deskripsi produk...">{{ old('description', $product->description) }}</textarea>

                        @error('description')

                        <small class="text-danger">
                            {{ $message }}
                        </small>

                        @enderror

                    </div>

                </div>

                {{-- BUTTON --}}
                <div class="d-flex justify-content-end gap-2 mt-4">

                    <a href="{{ route('admin.products.index') }}" class="btn btn-light rounded-3 px-4">

                        Batal
                    </a>

                    <button type="submit" class="btn btn-primary rounded-3 px-4">

                        💾 Update Produk
                    </button>

                </div>

            </form>

        </div>

    </div>

</div>

@endsection
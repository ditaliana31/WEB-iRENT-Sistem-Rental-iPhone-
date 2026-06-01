@extends('layouts.admin')

@section('title', 'Daftar Produk')

@section('content')

<div class="container-fluid py-4">

    {{-- HEADER --}}
    <div class="d-flex justify-content-between align-items-center mb-4">

        <div>

            <h2 class="fw-bold mb-1">
                Daftar Produk
            </h2>

            <p class="text-muted mb-0">
                Kelola semua produk iPhone iRent.
            </p>

        </div>

        <a href="{{ route('admin.products.create') }}" class="btn btn-primary rounded-3 px-4">

            + Tambah Produk
        </a>

    </div>

    {{-- SUCCESS MESSAGE --}}
    @if(session('success'))

    <div class="alert alert-success rounded-4 border-0 shadow-sm">

        {{ session('success') }}

    </div>

    @endif

    {{-- TABLE CARD --}}
    <div class="card border-0 shadow-sm rounded-4">

        <div class="card-body p-4">

            <div class="table-responsive">

                <table class="table align-middle">

                    <thead>

                        <tr>

                            <th>Gambar</th>
                            <th>Produk</th>
                            <th>Harga</th>
                            <th>Storage</th>
                            <th>Stock</th>
                            <th>Status</th>
                            <th width="180">Action</th>

                        </tr>

                    </thead>

                    <tbody>

                        @forelse($products as $product)

                        <tr>

                            {{-- IMAGE --}}
                            <td>

                                @if($product->image)

                                <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}"
                                    class="rounded-3 border" style="width: 70px; height: 70px; object-fit: cover;">

                                @else

                                <div class="bg-light rounded-3 d-flex align-items-center justify-content-center"
                                    style="width: 70px; height: 70px;">

                                    📱

                                </div>

                                @endif

                            </td>

                            {{-- NAME --}}
                            <td>

                                <div class="fw-semibold">

                                    {{ $product->name }}

                                </div>

                                <small class="text-muted">

                                    {{ $product->battery }}

                                </small>

                            </td>

                            {{-- PRICE --}}
                            <td>

                                Rp {{ number_format($product->price, 0, ',', '.') }}

                            </td>

                            {{-- STORAGE --}}
                            <td>

                                {{ $product->storage }}

                            </td>

                            {{-- STOCK --}}
                            <td>

                                {{ $product->stock }}

                            </td>

                            {{-- STATUS --}}
                            <td>

                                @if($product->status == 'Available')

                                <span class="badge bg-success rounded-pill px-3 py-2">

                                    Available

                                </span>

                                @else

                                <span class="badge bg-danger rounded-pill px-3 py-2">

                                    Rented

                                </span>

                                @endif

                            </td>

                            {{-- ACTION --}}
                            <td>

                                <div class="d-flex gap-2">

                                    <a href="{{ route('admin.products.edit', $product->id) }}"
                                        class="btn btn-warning btn-sm rounded-3">

                                        Edit
                                    </a>

                                    <form action="{{ route('admin.products.destroy', $product->id) }}" method="POST">

                                        @csrf
                                        @method('DELETE')

                                        <button type="submit" class="btn btn-danger btn-sm rounded-3"
                                            onclick="return confirm('Yakin ingin menghapus produk ini?')">

                                            Hapus
                                        </button>

                                    </form>

                                </div>

                            </td>

                        </tr>

                        @empty

                        <tr>

                            <td colspan="7" class="text-center py-5 text-muted">

                                Belum ada produk.

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
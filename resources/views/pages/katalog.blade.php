@extends('layouts.app')

@section('title', 'Katalog')

@section('content')

<section class="page-section">

    <div class="container">

        <div class="section-title">
            <h2>Katalog iPhone</h2>
            <p>Pilih iPhone premium terbaik untuk kebutuhan kamu</p>
        </div>

        <div class="card-grid">

            @foreach ($products as $product)

            <div class="iphone-card">

                {{-- IMAGE --}}
                <div class="catalog-image">

                    <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}">

                    <div class="catalog-badge">
                        {{ $product->status }}
                    </div>

                </div>

                {{-- CONTENT --}}
                <div class="card-content">

                    <div>

                        <h3>{{ $product->name }}</h3>

                        <p class="catalog-desc">
                            {{ $product->description }}
                        </p>

                        <div class="catalog-spec">
                            📦 {{ $product->storage }}
                        </div>

                        <div class="catalog-spec">
                            🔋 {{ $product->battery }}
                        </div>

                    </div>

                    <div class="catalog-price">

                        <h2>
                            Rp{{ number_format($product->price, 0, ',', '.') }}
                        </h2>

                        <span>/ hari</span>

                    </div>

                    <a href="{{ route('detail', $product->id) }}" class="catalog-btn">

                        Lihat Detail

                    </a>

                </div>

            </div>

            @endforeach

        </div>

    </div>

</section>

@endsection
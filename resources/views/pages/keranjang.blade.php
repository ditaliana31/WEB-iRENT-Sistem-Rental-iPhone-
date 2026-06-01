@extends('layouts.app')

@section('title', 'Keranjang')

@section('content')

<section class="page-section">

    <div class="container">

        {{-- TITLE --}}
        <div class="section-title">
            <h2>Keranjang Sewa</h2>
            <p>Kelola iPhone yang ingin kamu sewa</p>
        </div>

        <div class="cart-wrapper">

            {{-- LEFT --}}
            <div class="cart-left">

                @php
                $grandTotal = 0;
                @endphp

                @foreach ($carts as $cart)

                @php
                $grandTotal += $cart->total;
                @endphp

                <div class="cart-card">

                    {{-- IMAGE --}}
                    <div class="cart-image">

                        <img src="{{ asset('storage/' . $cart->product->image) }}" alt="{{ $cart->product->name }}">

                    </div>

                    {{-- CONTENT --}}
                    <div class="cart-content">

                        <h3>{{ $cart->product->name }}</h3>

                        <p class="cart-desc">
                            {{ $cart->product->storage }}
                            • Battery {{ $cart->product->battery }}
                        </p>

                        <div class="cart-info">

                            <span>
                                Harga:
                                <strong>
                                    Rp{{ number_format($cart->product->price, 0, ',', '.') }}
                                    / hari
                                </strong>
                            </span>

                        </div>

                        {{-- CRUD --}}
                        <div class="cart-crud">

                            {{-- UPDATE --}}
                            <form action="{{ route('keranjang.update', $cart->id) }}" method="POST">

                                @csrf
                                @method('PUT')

                                <div class="qty-box">

                                    {{-- MINUS --}}
                                    <button type="submit" name="duration" value="{{ max(1, $cart->duration - 1) }}"
                                        class="qty-btn">
                                        -
                                    </button>

                                    {{-- INPUT --}}
                                    <input type="text" value="{{ $cart->duration }}" class="qty-input" readonly>

                                    {{-- PLUS --}}
                                    <button type="submit" name="duration" value="{{ $cart->duration + 1 }}"
                                        class="qty-btn">
                                        +
                                    </button>

                                </div>

                            </form>

                            {{-- DELETE --}}
                            <form action="{{ route('keranjang.delete', $cart->id) }}" method="POST">

                                @csrf
                                @method('DELETE')

                                <button type="submit" class="btn-remove">
                                    Hapus
                                </button>

                            </form>

                        </div>

                    </div>

                    {{-- PRICE --}}
                    <div class="cart-price">

                        <h4>
                            Rp{{ number_format($cart->total, 0, ',', '.') }}
                        </h4>

                    </div>

                </div>

                @endforeach

            </div>

            {{-- RIGHT --}}
            <div class="cart-summary">

                <h3>Ringkasan Pembayaran</h3>

                <div class="summary-item">

                    <span>Total Sewa</span>

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

                <a href="{{ route('pembayaran') }}" class="btn-checkout">
                    Lanjut Pembayaran
                </a>

            </div>

        </div>

    </div>

</section>

@endsection
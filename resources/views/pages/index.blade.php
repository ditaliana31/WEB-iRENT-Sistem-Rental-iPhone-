@extends('layouts.app')

@section('title', 'Home')

@section('content')

<style>
    /* =========================
    GLOBAL
========================== */
    .container {
        max-width: 1100px;
        margin: auto;
    }

    /* =========================
    HERO
========================== */
    .home-hero {
        padding: 60px 20px 50px;
        background: linear-gradient(to bottom, #ffffff, #f8fafc);
        overflow: hidden;
    }

    .home-hero-wrapper {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
        align-items: center;
        gap: 35px;
    }

    .hero-badge {
        display: inline-flex;
        align-items: center;
        padding: 8px 14px;
        background: #eef4ff;
        color: #2563eb;
        border-radius: 999px;
        font-size: 12px;
        font-weight: 600;
        margin-bottom: 18px;
    }

    .home-hero-content h1 {
        font-size: 42px;
        line-height: 1.2;
        font-weight: 800;
        color: #0f172a;
        margin-bottom: 18px;
    }

    .home-hero-content p {
        font-size: 15px;
        line-height: 1.7;
        color: #64748b;
        max-width: 500px;
        margin-bottom: 25px;
    }

    .hero-buttons {
        display: flex;
        flex-wrap: wrap;
        gap: 12px;
    }

    .hero-btn-primary,
    .hero-btn-secondary {
        padding: 12px 18px;
        border-radius: 12px;
        font-weight: 600;
        text-decoration: none;
        transition: .3s;
        font-size: 14px;
    }

    .hero-btn-primary {
        background: #2563eb;
        color: white;
    }

    .hero-btn-primary:hover {
        background: #1d4ed8;
    }

    .hero-btn-secondary {
        background: white;
        border: 1px solid #e2e8f0;
        color: #0f172a;
    }

    .hero-circle {
        position: absolute;
        width: 320px;
        height: 320px;
        background: linear-gradient(135deg, #2563eb, #60a5fa);
        border-radius: 50%;
        opacity: .12;
        filter: blur(10px);
    }

    .home-hero-image img {
        position: relative;
        width: 100%;
        max-width: 320px;
        border-radius: 24px;
        object-fit: cover;
        z-index: 2;
        box-shadow: 0 20px 40px rgba(0, 0, 0, .12);
    }

    /* =========================
    SECTION TITLE
========================== */
    .section-title {
        text-align: center;
        margin-bottom: 40px;
    }

    .section-title h2 {
        font-size: 32px;
        font-weight: 800;
        color: #0f172a;
        margin-bottom: 10px;
    }

    .section-title p {
        font-size: 14px;
        color: #64748b;
    }

    /* =========================
    PRODUCT
========================== */
    .home-product {
        padding: 60px 20px;
    }

    .home-card-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(240px, 1fr));
        gap: 20px;
    }

    .home-product-card {
        background: white;
        border-radius: 20px;
        overflow: hidden;
        border: 1px solid #eef2f7;
        box-shadow: 0 10px 30px rgba(0, 0, 0, .04);
        transition: .3s;
    }

    .home-product-card:hover {
        transform: translateY(-5px);
    }

    .product-image {
        height: 200px;
        overflow: hidden;
    }

    .product-image img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    .product-content {
        padding: 18px;
    }

    .product-category {
        display: inline-block;
        padding: 6px 10px;
        background: #eff6ff;
        color: #2563eb;
        border-radius: 999px;
        font-size: 12px;
        margin-bottom: 12px;
    }

    .product-content h3 {
        font-size: 20px;
        margin-bottom: 10px;
    }

    .product-content p {
        font-size: 14px;
        color: #64748b;
        margin-bottom: 18px;
    }

    .product-bottom {
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .product-bottom h4 {
        font-size: 18px;
        color: #2563eb;
    }

    .product-bottom h4 span {
        font-size: 12px;
        color: #94a3b8;
    }

    .product-btn {
        padding: 10px 14px;
        background: #2563eb;
        color: white;
        border-radius: 10px;
        font-size: 13px;
        text-decoration: none;
    }

    /* =========================
    TESTIMONIAL
========================== */
    .testimonial-section {
        padding: 60px 20px;
        background: #f8fafc;
    }

    .testimonial-card {
        background: white;
        padding: 25px;
        border-radius: 20px;
        box-shadow: 0 10px 25px rgba(0, 0, 0, .04);
    }

    /* =========================
    CTA
========================== */
    .cta-section {
        padding: 60px 20px;
    }

    .cta-wrapper {
        background: linear-gradient(135deg, #2563eb, #3b82f6);
        padding: 30px;
        border-radius: 20px;
        color: white;
    }

    .cta-content h2 {
        font-size: 28px;
    }

    .cta-content p {
        font-size: 14px;
        opacity: .9;
    }

    .cta-btn-primary,
    .cta-btn-secondary {
        padding: 10px 16px;
        border-radius: 10px;
        font-size: 13px;
        text-decoration: none;
    }

    /* =========================
    RESPONSIVE
========================== */
    @media (max-width: 768px) {

        .home-hero-content h1 {
            font-size: 32px;
        }

        .section-title h2 {
            font-size: 26px;
        }

        .hero-buttons {
            justify-content: center;
        }

    }
</style>

{{-- HERO --}}
<section class="home-hero">
    <div class="container">
        <div class="home-hero-wrapper">

            <div class="home-hero-content">
                <span class="hero-badge">Rental iPhone Premium 🚀</span>

                <h1>Sewa iPhone Modern & Premium</h1>

                <p>
                    Nikmati pengalaman rental iPhone dengan desain modern, proses cepat, harga terjangkau.
                </p>

                <div class="hero-buttons">
                    <a href="{{ route('katalog') }}" class="hero-btn-primary">Lihat Katalog</a>
                    <a href="{{ route('dashboard') }}" class="hero-btn-secondary">Riwayat</a>
                </div>
            </div>

            <div class="home-hero-image">
                <div class="hero-circle"></div>
                <img src="{{ asset('assets/img/logo.png') }}" alt="iPhone">
            </div>

        </div>
    </div>
</section>

{{-- PRODUCT --}}
<section class="home-product">
    <div class="container">

        <div class="section-title">
            <h2>iPhone Populer</h2>
            <p>Device premium paling diminati</p>
        </div>

        <div class="home-card-grid">

            @foreach ($products as $product)

            <div class="home-product-card">

                <div class="product-image">
                    <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}">
                </div>

                <div class="product-content">

                    <span class="product-category">{{ $product->status }}</span>

                    <h3>{{ $product->name }}</h3>

                    <p>{{ Str::limit($product->description, 80) }}</p>

                    <div class="product-bottom">
                        <h4>
                            Rp{{ number_format($product->price, 0, ',', '.') }}
                            <span>/hari</span>
                        </h4>

                        <a href="{{ route('detail', $product->id) }}" class="product-btn">
                            Detail
                        </a>
                    </div>

                </div>

            </div>

            @endforeach

        </div>

    </div>
</section>

{{-- TESTIMONIAL --}}
<section class="testimonial-section">
    <div class="container">

        <div class="section-title">
            <h2>Apa Kata Mereka?</h2>
            <p>Pengalaman customer iRent</p>
        </div>

        <div class="testimonial-grid">

            @forelse ($reviews as $review)

            <div class="testimonial-card">

                <div> {{ str_repeat('⭐', $review->rating) }} </div>

                <p>“{{ $review->review }}”</p>

                <strong>{{ $review->user->name ?? 'User' }}</strong>

            </div>

            @empty

            <p style="text-align:center;">Belum ada review</p>

            @endforelse

        </div>

    </div>
</section>

{{-- CTA --}}
<section class="cta-section">
    <div class="container">

        <div class="cta-wrapper">

            <div class="cta-content">
                <h2>Siap Rental iPhone?</h2>
                <p>Mulai sekarang dan nikmati layanan premium.</p>
            </div>

            <div class="hero-buttons">
                <a href="{{ route('katalog') }}" class="cta-btn-primary">Katalog</a>
                <a href="https://wa.me/6281234567890" class="cta-btn-secondary">WhatsApp</a>
            </div>

        </div>

    </div>
</section>

@include('partials.whatsapp')

@endsection
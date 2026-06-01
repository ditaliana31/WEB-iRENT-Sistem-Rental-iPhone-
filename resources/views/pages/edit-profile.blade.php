@extends('layouts.app')

@section('title', 'Edit Profile')

@section('content')

<section class="edit-profile-page">

    <div class="container">

        <div class="edit-profile-card">

            <div class="edit-header">

                <h1>Edit Profile</h1>

                <p>
                    Ubah data akun kamu di bawah ini.
                </p>

            </div>

            @if(session('success'))

            <div class="alert-success">
                {{ session('success') }}
            </div>

            @endif

            <form action="{{ route('profile.update') }}" method="POST">

                @csrf
                @method('PUT')

                <div class="form-group">

                    <label>Nama</label>

                    <input type="text" name="name" value="{{ auth()->user()->name }}" required>

                </div>

                <div class="form-group">

                    <label>Email</label>

                    <input type="email" name="email" value="{{ auth()->user()->email }}" required>

                </div>

                <div class="form-group">

                    <label>Password Baru</label>

                    <input type="password" name="password" placeholder="Kosongkan jika tidak diganti">

                </div>

                <div class="form-group">

                    <label>Konfirmasi Password</label>

                    <input type="password" name="password_confirmation" placeholder="Ulangi password baru">

                </div>

                <div class="edit-actions">

                    <button type="submit" class="btn-save">
                        Simpan Perubahan
                    </button>

                    <a href="{{ route('profile') }}" class="btn-cancel">
                        Batal
                    </a>

                </div>

            </form>

        </div>

    </div>

</section>

@endsection
@extends('layouts.master')

@section('title', 'Isi Review Pengalaman Wisata Anda')
@section('meta_description', 'Berikan ulasan Anda terhadap pengalaman paket wisata yang Anda ikuti bersama Lestari Wisata Dieng.')

@section('content')
<section class="container-fluid">
    {{-- Header --}}
    <header class="row custom-container-header text-white mb-2">
        <h2 class="text-center fw-bold responsive-text">Form Review</h2>
        <p class="mt-3 text-center responsive-text-content">Bagikan pengalaman wisata Anda dan bantu pengunjung lain memilih paket terbaik!</p>
    </header>

    {{-- Form Review --}}
    <section class="pt-4 col-12 d-flex justify-content-center">
        <div class="py-4 px-3 my-3 mx-2 custom-border-kontak row w-100" style="max-width: 900px; background: rgba(255, 255, 255, 0.1); border-radius: 20px;">
            <div class="col-12">
                {{-- Alert --}}
                @if (session('success'))
                    <div class="alert alert-success">{{ session('success') }}</div>
                @endif
                @if (session('error'))
                    <div class="alert alert-danger">{{ session('error') }}</div>
                @endif

                <form action="{{ route('review.store') }}" method="POST">
                    @csrf

                    {{-- Nama --}}
                    <div class="input-group mb-3">
                        <span class="input-group-text"><i class="ri-user-line"></i></span>
                        <input 
                            type="text" 
                            name="nama" 
                            class="form-control responsive-text-content" 
                            placeholder="Nama Anda" 
                            value="{{ old('nama') }}" 
                            required>
                    </div>

                    {{-- Paket (readonly + hidden) --}}
                    @php
                        $selectedPaket = $pakets->firstWhere('id', $paket_id);
                    @endphp
                    <div class="mb-3">
                        <label class="form-label text-dark">Paket Wisata</label>
                        <input type="text" class="form-control" value="{{ $selectedPaket->paket_title ?? 'Paket tidak ditemukan' }}" readonly>
                        <input type="hidden" name="paket_id" value="{{ $paket_id }}">
                    </div>

                    {{-- Isi Review --}}
                    <div class="input-group mb-3">
                        <span class="input-group-text"><i class="ri-chat-3-line"></i></span>
                        <textarea 
                            name="isi_review" 
                            rows="4" 
                            class="form-control responsive-text-content" 
                            placeholder="Tulis pengalaman wisata Anda di sini..." 
                            required>{{ old('isi_review') }}</textarea>
                    </div>

                    {{-- Rating --}}
                    <div class="mb-3">
                        <label class="form-label text-dark">Rating</label>
                        <div class="rating-stars d-flex gap-1 fs-3">
                        @for ($i = 5; $i >= 1; $i--)
                            <input type="radio" name="bintang" id="star{{ $i }}" value="{{ $i }}">
                            <label for="star{{ $i }}" class="star">&#9733;</label>
                        @endfor
                        </div>
                        @error('bintang')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    {{-- No HP --}}
                    <div class="input-group mb-4">
                        <span class="input-group-text"><i class="ri-phone-line"></i></span>
                        <input 
                            type="text" 
                            name="no_hp" 
                            class="form-control responsive-text-content" 
                            placeholder="Nomor WhatsApp aktif" 
                            value="{{ old('no_hp') }}" 
                            required>
                    </div>

                    {{-- Submit --}}
                    <div class="d-grid">
                        <button type="submit" class="btn btn-warning text-dark fw-bold">Kirim Review</button>
                    </div>
                </form>
            </div>
        </div>
    </section>
</section>

@endsection

@extends('layouts.master')

@section('title', 'Paket Lestari Wisata Dieng | Paket Wisata Terbaik ke Negeri di Atas Awan')
@section('meta_description',
    'Jelajahi Keindahan Dieng dengan Hemat! Pilih Paket Wisata Dieng Terbaik untuk Liburan
    Anda')
@section('content')
    <section class="container-fluid mb-5">
        {{-- Header --}}
        <header class="row custom-container-header text-white mb-2">
            <h2 class="text-center fw-bold  responsive-text">Paket Wisata Terbaik ke Negeri di Atas Awan</h2>
            <p class="mt-3 text-center responsive-text-content">Jelajahi Keindahan Dieng dengan Hemat! Pilih Paket Wisata
                Dieng Terbaik untuk Liburan Anda</p>
        </header>
        {{-- /Header --}}
        {{-- Card --}}
        <section class="row container-section justify-content-center">
            @foreach ($pakets as $paket)
                <article class="col-md-4 col-sm-12 mb-4">
                    <div class="custom-card">
                        <div class="card-image-wrapper">
                            <img src="{{ asset('/image/paket/' . $paket->paket_image) }}" alt="{{ $paket->paket_title }}">
                            <div class="overlay-gradient"></div>
                            <div class="card-title-overlay">
                                <h3>{{ $paket->paket_title }}</h3>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="d-flex align-items-center mb-3">
                                <i class="ri-timer-2-line me-2"></i>
                                <p class="mb-0">{{ $paket->paket_sub_title_date }}</p>
                            </div>
                            <div class="d-flex align-items-center mb-3">
                                <i class="ri-group-line me-2"></i>
                                <p class="mb-0">Kapasitas Maksimal {{ $paket->paket_detail }} Orang</p>
                            </div>
                            <a href="{{ url('/paket-detail/' . $paket->id) }}" class="btn-detail">Lihat Paket</a>
                        </div>
                    </div>
                </article>
            @endforeach
        </section>
    </section>
    {{-- /Card --}}
    </section>
@endsection

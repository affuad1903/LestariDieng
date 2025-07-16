@extends('layouts.master')

@section('title', 'Paket Lestari Wisata Dieng | Paket Wisata Terbaik ke Negeri di Atas Awan')
@section('meta_description', 'Jelajahi Keindahan Dieng dengan Hemat! Pilih Paket Wisata Dieng Terbaik untuk Liburan Anda')
@section('content')
<section class="container-fluid mb-5">
    {{-- Header --}}
    <header class="row custom-container-header text-white mb-2">
        <h2 class="text-center fw-bold  responsive-text">Paket Wisata Terbaik ke Negeri di Atas Awan</h2>
        <p class="mt-3 text-center responsive-text-content">Jelajahi Keindahan Dieng dengan Hemat! Pilih Paket Wisata Dieng Terbaik untuk Liburan Anda</p>
    </header>
    {{-- /Header --}}
    {{-- Card --}}
    <section class="row container-section">
        <article class="col-md-4 col-sm-12 mt-2">
            <div class="card custom-cardShadow">
                <div class="row">
                    <div class="col-12">
                        <img style="" src="{{ asset('/image/head.jpg') }}" class="card-img-top" alt="...">
                    </div>
                </div>
                <div class="card-body">
                    <h3 class="text-uppercase fw-bold text-center custom-contentHeader">Trip Dieng 1 Hari</h3>
                    <div class="d-flex justify-content-start flex-row my-4 responsive-text-content">
                        <i class="ri-timer-2-line me-1"></i>
                        <p class="card-text">1 Day 1 Malam</p>
                    </div>
                    <hr>
                    <div class="row mt-3 text-center">
                        <div class="col-12">
                            <a href="">
                                <button class="rounded-pill text-center custom-borderContent responsive-text-content">Lihat Detail</button>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </article>
        <article class="col-md-4 col-sm-12 mt-2">
            <div class="card custom-cardShadow">
                <div class="row">
                    <div class="col-12">
                        <img style="" src="{{ asset('/image/head.jpg') }}" class="card-img-top" alt="...">
                    </div>
                </div>
                <div class="card-body">
                    <h3 class="text-uppercase fw-bold text-center custom-contentHeader">Trip Dieng 1 Hari</h3>
                    <div class="d-flex justify-content-start flex-row my-4 responsive-text-content">
                        <i class="ri-timer-2-line me-1"></i>
                        <p class="card-text">1 Day 1 Malam</p>
                    </div>
                    <hr>
                    <div class="row mt-3 text-center">
                        <div class="col-12">
                            <a href="{{url('/paket-show')}}">
                                <button class="rounded-pill text-center custom-borderContent responsive-text-content">Lihat Detail</button>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </article>
        <article class="col-md-4 col-sm-12 mt-2">
            <div class="card custom-cardShadow">
                <div class="row">
                    <div class="col-12">
                        <img style="" src="{{ asset('/image/head.jpg') }}" class="card-img-top" alt="...">
                    </div>
                </div>
                <div class="card-body">
                    <h3 class="text-uppercase fw-bold text-center custom-contentHeader">Trip Dieng 1 Hari</h3>
                    <div class="d-flex justify-content-start flex-row my-4 responsive-text-content">
                        <i class="ri-timer-2-line me-1"></i>
                        <p class="card-text">1 Day 1 Malam</p>
                    </div>
                    <hr>
                    <div class="row mt-3 text-center">
                        <div class="col-12">
                            <a href="">
                                <button class="rounded-pill text-center custom-borderContent responsive-text-content">Lihat Detail</button>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </article>
    </section>
    {{-- /Card --}}
</section>
@endsection

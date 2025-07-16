@extends('layouts.master')

@section('title', 'KANTOR NOTARIS SANTI & REKAN - Lestari Wisata Dieng')
@section('meta_description', 'Jelajahi keindahan alam Dieng bersama Lestari Wisata. Temukan momen terbaik dari perjalanan wisata Anda melalui galeri foto dan video kami.')

@section('content')

<section class="container-fluid mb-5 p-0">
    {{-- Jumbotron --}}
    <section class="container-fluid p-0">
        <header class="d-flex justify-content-center align-items-center text-white text-center" style="background: url('{{ asset('/image/head.jpg') }}') center/cover no-repeat; height: 570px;">
            <div class="overlay w-100 h-100" style="background: rgba(0, 0, 0, 0.5);"></div>
            <div class="position-absolute">
                <h2 class="responsive-text fw-bold">KANTOR NOTARIS SANTI & REKAN</h2>
                <a href=""><button class="border mt-4 rounded-pill border-white text-center custom-borderHead responsive-text-content">Lihat Galeri</button></a>
            </div>
        </header>
    </section>
    {{-- /Jumbotron --}}
    {{-- Section --}}
    <div class="container-fluid container-section">
        <section class="row custom-containerContentGaleri">
            <section class="col-sm-6 col-md-4 col-lg-4 col-xl-4">
                <a class=" borderImgGaleriShow" href="{{ asset('/image/head.jpg') }}" data-lightbox="gallery">
                    <img class="containerImg" src="{{ asset('/image/head.jpg') }}" alt="Galeri Lestari WIsata Dieng">
                </a>
            </section>
            <section class="col-sm-6 col-md-4 col-lg-4 col-xl-4">
                <a class=" borderImgGaleriShow" href="{{ asset('/image/head.jpg') }}" data-lightbox="gallery">
                    <img class="containerImg" src="{{ asset('/image/head.jpg') }}" alt="Galeri Lestari WIsata Dieng">
                </a>
            </section>
            <section class="col-sm-6 col-md-4 col-lg-4 col-xl-4">
                <a class=" borderImgGaleriShow" href="{{ asset('/image/head.jpg') }}" data-lightbox="gallery">
                    <img class="containerImg" src="{{ asset('/image/head.jpg') }}" alt="Galeri Lestari WIsata Dieng">
                </a>
            </section>
        </section>
    </div>
    {{-- /Section --}}
</section>
@endsection
@extends('layouts.master')

@section('title', 'KANTOR NOTARIS SANTI & REKAN - Lestari Wisata Dieng')
@section('meta_description', 'Jelajahi keindahan alam Dieng bersama Lestari Wisata. Temukan momen terbaik dari perjalanan wisata Anda melalui galeri foto dan video kami.')

@section('content')

<section class="container-fluid mb-5 p-0">
    {{-- Jumbotron --}}
    <section class="container-fluid p-0">
        @php
            $firstImage = $galery->galery_img->first();
            $imageUrl = $firstImage ? asset('image/galery/' . $galery->id . '/' . $firstImage->image) : asset('image/default.jpg');
        @endphp
        <header class="d-flex justify-content-center align-items-center text-white text-center"
            style="background: url('{{ $imageUrl }}') center/cover no-repeat; height: 570px;">
            <div class="overlay w-100 h-100" style="background: rgba(0, 0, 0, 0.5);"></div>
            <div class="position-absolute">
                <h2 class="responsive-text fw-bold">{{ $galery->title }}</h2>
                <a href="#galeri-section">
                    <button class="border mt-4 rounded-pill border-white text-center custom-borderHead responsive-text-content">Lihat Galeri</button>
                </a>
            </div>
        </header>
    </section>
    {{-- /Jumbotron --}}

    {{-- Section --}}
    <div id="galeri-section" class="container-fluid container-section mt-5">
        <section class="row custom-containerContentGaleri">
            @forelse($galery->galery_img as $img)
                <section class="col-sm-6 col-md-4 col-lg-4 col-xl-4 mb-4">
                    <a class="borderImgGaleriShow" href="{{ asset('image/galery/'  . $galery->id . '/' .  $img->image) }}" data-lightbox="gallery">
                        <img class="containerImg" src="{{ asset('image/galery/'  . $galery->id . '/' .  $img->image) }}" alt="Galeri {{ $galery->title }}">
                    </a>
                </section>
            @empty
                <p class="text-center">Belum ada gambar di galeri ini.</p>
            @endforelse
        </section>
    </div>
    {{-- /Section --}}
</section>

@endsection

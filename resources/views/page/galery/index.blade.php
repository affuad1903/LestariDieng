@extends('layouts.master')

@section('title', 'Galeri Lestari Wisata Dieng | Koleksi Foto Lestari Wisata Dieng')
@section('meta_description', 'Jelajahi keindahan alam Dieng bersama Lestari Wisata. Temukan momen terbaik dari perjalanan wisata Anda melalui galeri foto dan video kami.')
@section('content')
<section class="container-fluid mb-5">
    {{-- Header --}}
    <header class="row custom-containerHeaderGaleri text-white">
        <section class="column containerHeaderGaleri" >
            <h2 class="fw-bold custom-contentHeader text-white">Galeri Lestari Wisata Dieng</h2>
            <p class="my-3 responsive-text-content">Menampilkan pesona Dieng melalui lensa yang bercerita, mengajak Anda menjelajahi keindahan alam dan kekayaan budaya yang memikat.</p>
            <button class="px-3 py-1 rounded-pill custom-borderContent  responsive-text-content"><a href="#galeri">Lihat Galeri</a></button>
        </section>
        <section class="column">
            <div class="containerImg">
                <img class="borderImgGaleri" src="{{ asset('/image/head.jpg') }}" alt="Galeri Lestari WIsata Dieng">
            </div>
        </section>
    </header>
    {{-- /Header --}}
    {{-- Section --}}
    <div class="container-fluid">
        <section class="row custom-containerContentGaleri" id="galeri">
            @foreach($galeries as $galeri)
            <section class="col-sm-6 col-md-4 col-lg-4 col-xl-3">
                @php
                    $firstImage = $galeri->galery_img->first();
                    $imageUrl = $firstImage ? asset('image/galery/' . $galeri->id . '/' . $firstImage->image) : asset('image/default.jpg');
                @endphp
                <div class="text-white galeri-img columnContent text-center"
                    onclick="onclickGaleri(this)" 
                    onmouseover="mouseOverGaleri(this)" 
                    onmouseout="mouseOutGaleri(this)"
                    style="background: url('{{ $imageUrl }}') center/cover no-repeat; height: 300px;">
                    
                    <h2 class="fw-bold galeri-title uppercase">{{ $galeri->title }}</h2>
                    <button class="px-3 py-1 mt-3 rounded-pill showButton">
                        <a href="{{ route('galeryshow', $galeri->id) }}">Lihat Detail</a>
                    </button>
                </div>
            </section>
            @endforeach
        </section>
    </div>
    {{-- /Section --}}
</section>
@endsection

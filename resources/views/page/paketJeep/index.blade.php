@extends('layouts.master')

@section('title', 'Paket Jeep Lestari Wisata Dieng | Eksplorasi Curug Sikarim, Kawah Sikidang & Lebih Banyak Lagi!')
@section('meta_description', 'Jelajahi keindahan Dieng dengan Paket Jeep Lestari Wisata! Kunjungi Curug Sikarim, Kawah Sikidang, dan destinasi menarik lainnya dengan perjalanan seru dan nyaman.')
@section('content')
<section class="container-fluid mb-5">
    {{-- Header --}}
    <header class="row custom-container-header text-white mb-2">
        <h2 class="text-center fw-bold  responsive-text">Paket Jeep Lestari Wisata Dieng</h2>
        <p class="mt-3 text-center responsive-text-content">Eksplorasi Curug Sikarim, Kawah Sikidang, Dieng Park, dan tempat wisata Dieng lainnya dengan perjalanan nyaman menggunakan jeep wisata kami.</p>
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
                    <h3 class="text-uppercase fw-bold text-center custom-contentHeader">Jeep Dieng Park & Sikidang</h3>
                    <div class="d-flex justify-content-start flex-row my-4 responsive-text-content">
                        <i class="ri-roadster-line me-1"></i>
                        <p class="card-text">1 Jeep Di Isi 4 Peserta</p>
                    </div>
                    <hr>
                    <div class="row mt-3 text-center">
                        <div class="col-12">
                            <a href="{{url('/paket-jeep-show')}}">
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
                    <h3 class="text-uppercase fw-bold text-center custom-contentHeader">Jeep Dieng Park & Sikidang</h3>
                    <div class="d-flex justify-content-start flex-row my-4 responsive-text-content">
                        <i class="ri-roadster-line me-1"></i>
                        <p class="card-text">1 Jeep Di Isi 4 Peserta</p>
                    </div>
                    <hr>
                    <div class="row mt-3 text-center">
                        <div class="col-12">
                            <a href="{{url('/paket-jeep-show')}}">
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
                    <h3 class="text-uppercase fw-bold text-center custom-contentHeader">Jeep Dieng Park & Sikidang</h3>
                    <div class="d-flex justify-content-start flex-row my-4 responsive-text-content">
                        <i class="ri-roadster-line me-1"></i>
                        <p class="card-text">1 Jeep Di Isi 4 Peserta</p>
                    </div>
                    <hr>
                    <div class="row mt-3 text-center">
                        <div class="col-12">
                            <a href="{{url('/paket-jeep-show')}}">
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
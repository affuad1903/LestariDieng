@extends('layouts.master')

@section('title', 'Lestari Wisata Dieng - Keindahan Alam Wisata Dieng')
@section('meta_description',
    'Jelajahi wisata Dieng yang penuh pesona, dari Candi Dieng hingga panorama alam yang
    memukau di Wonosobo.')
@section('content')
    {{-- Jumbotron --}}
    <section class="container-fluid p-0">
        <header class="d-flex justify-content-center align-items-center text-white text-center"
            style="background: url('{{ asset('/image/head.jpg') }}') center/cover no-repeat; height: 570px;">
            <div class="overlay w-100 h-100" style="background: rgba(0, 0, 0, 0.5);"></div>
            <div class="position-absolute">
                <h2 class="responsive-text fw-bold">Selamat Datang di Lestari Wisata Dieng</h2>
                <a href="{{ url('/paket-index') }}"><button
                        class="border mt-4 rounded-pill border-white text-center custom-borderHead responsive-text-content">Lihat
                        Paket</button></a>
            </div>
        </header>
    </section>
    {{-- /Jumbotron --}}

    {{-- Destinasi Wisata --}}
    <section class="container-fluid container-section">
        {{-- Header --}}
        <header class="row">
            <h2 class="text-center fw-bold custom-contentHeader">Destinasi Wisata Dieng
                <script>
                    document.write(new Date().getFullYear());
                </script>
            </h2>
        </header>
        {{-- /Header --}}
        {{-- Card --}}
        <section class="row container-section">
            @foreach ($destinations as $item)
                <article class="col-xl-3 col-lg-4 col-md-6 col-sm-12 mb-2">
                    <div class="custom-overlay d-flex text-white"
                        style="background: url('{{ asset('/image/destination/' . $item->thumbnail_image) }}') center/cover no-repeat; height: clamp(15rem, 40vw, 19rem);">
                        <div class="overlay custom-overlay w-100 h-100 ">
                            <h3 class="fw-bold custom-titleCard text-center">{{ $item->content_title }}</h3>
                            <div class="row mx-3 my-2">
                                <p class="fw-bold">{{ $item->content_title }}</p>
                                <p class="responsive-text-content">{{ Str::limit(strip_tags($item->content_summary), 120) }}
                                </p>
                                <a href="/destinasi-show/{{ $item->id }}" class="text-center mt-4">
                                    <button
                                        class="rounded-pill border-white py-2 px-4 custom-borderHead responsive-text-content">Selengkapnya</button>
                                </a>
                            </div>
                        </div>
                    </div>
                </article>
            @endforeach
        </section>
        {{-- /Card --}}
        {{-- CTA --}}
        <section class="row text-center">
            <div class="col-12">
                <a href="{{ url('/destinasi-index') }}">
                    <button class="rounded-pill text-center custom-borderContent responsive-text-content">Lihat
                        Lainnya</button>
                </a>
            </div>
        </section>
        {{-- /CTA --}}
    </section>
    {{-- Destinasi Wisata --}}

    {{-- Paket Wisata --}}
    <section class="container-fluid container-section custom-background">
        {{-- Header --}}
        <header class="row">
            <h2 class="text-center fw-bold custom-contentHeader">
                Paket Wisata Dieng
                <script>
                    document.write(new Date().getFullYear());
                </script>
            </h2>
        </header>
        {{-- /Header --}}

        {{-- Card --}}
        <section class="container-fluid container-section custom-background">
            {{-- Header --}}
            <header class="row mb-4">
                <h2 class="text-center fw-bold custom-contentHeader">
                    Paket Wisata Dieng
                    <script>
                        document.write(new Date().getFullYear());
                    </script>
                </h2>
            </header>
            {{-- Card --}}
            <section class="row container-section justify-content-center">
                @foreach ($pakets->take(3) as $paket)
                    <article class="col-md-4 col-sm-12 mb-4">
                        <div class="custom-card">
                            <div class="card-image-wrapper">
                                <img src="{{ asset('/image/paket/' . $paket->paket_image) }}"
                                    alt="{{ $paket->paket_title }}">
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

            {{-- CTA --}}
            <section class="row text-center">
                <div class="col-12">
                    <a href="{{ url('/paket-index') }}">
                        <button class="rounded-pill text-center custom-borderContent responsive-text-content">Lihat Semua
                            Paket</button>
                    </a>
                </div>
            </section>
        </section>

        {{-- /Card --}}

    </section>
    {{-- Paket Wisata --}}

    {{-- Review --}}
    <section class="container-fluid container-section">
        {{-- Header --}}
        <header class="row">
            <h2 class="text-center fw-bold custom-contentHeader">Tour Dieng Berkesan! Simak Review Mereka</h2>
        </header>
        {{-- /Header --}}
        {{-- Card Review --}}
        <section class="overflow d-flex py-4">
            <article class="col-12 col-sm-6 col-md-6 col-lg-4 col-xl-3 mt-2 mx-2">
                <div class="card custom-cardShadow custom-background ">
                    <div class="card-body">
                        <header class="d-flex justify-content-between">
                            <div class="row me-1">
                                <div class="d-inline-flex">
                                    <section class="custom-reviewContainerImg">
                                        <img src="{{ asset('image/profil.jpg') }}" alt="">
                                    </section>
                                    <section class="ms-2 custom-reviewName">
                                        <h3>Affandi Putra Pradana</h3>
                                        <time>2022-12-2</time>
                                    </section>
                                </div>
                            </div>
                        </header>
                        <hr class="my-3">
                        <section class="row">
                            <p>saya sangat puas sekali dalam perjalanan ini</p>
                        </section>
                    </div>
                </div>
            </article>
            <article class="col-12 col-sm-6 col-md-6 col-lg-4 col-xl-3 mt-2 mx-2">
                <div class="card custom-cardShadow custom-background ">
                    <div class="card-body">
                        <header class="d-flex justify-content-between">
                            <div class="row me-1">
                                <div class="d-inline-flex">
                                    <section class="custom-reviewContainerImg">
                                        <img src="{{ asset('image/profil.jpg') }}" alt="">
                                    </section>
                                    <section class="ms-2 custom-reviewName">
                                        <h3>Affandi Putra Pradana</h3>
                                        <time>2022-12-2</time>
                                    </section>
                                </div>
                            </div>
                        </header>
                        <hr class="my-3">
                        <section class="row">
                            <p>saya sangat puas sekali dalam perjalanan ini</p>
                        </section>
                    </div>
                </div>
            </article>
            <article class="col-12 col-sm-6 col-md-6 col-lg-4 col-xl-3 mt-2 mx-2">
                <div class="card custom-cardShadow custom-background ">
                    <div class="card-body">
                        <header class="d-flex justify-content-between">
                            <div class="row me-1">
                                <div class="d-inline-flex">
                                    <section class="custom-reviewContainerImg">
                                        <img src="{{ asset('image/profil.jpg') }}" alt="">
                                    </section>
                                    <section class="ms-2 custom-reviewName">
                                        <h3>Affandi Putra Pradana</h3>
                                        <time>2022-12-2</time>
                                    </section>
                                </div>
                            </div>
                        </header>
                        <hr class="my-3">
                        <section class="row">
                            <p>saya sangat puas sekali dalam perjalanan ini</p>
                        </section>
                    </div>
                </div>
            </article>
            <article class="col-12 col-sm-6 col-md-6 col-lg-4 col-xl-3 mt-2 mx-2">
                <div class="card custom-cardShadow custom-background ">
                    <div class="card-body">
                        <header class="d-flex justify-content-between">
                            <div class="row me-1">
                                <div class="d-inline-flex">
                                    <section class="custom-reviewContainerImg">
                                        <img src="{{ asset('image/profil.jpg') }}" alt="">
                                    </section>
                                    <section class="ms-2 custom-reviewName">
                                        <h3>Affandi Putra Pradana</h3>
                                        <time>2022-12-2</time>
                                    </section>
                                </div>
                            </div>
                        </header>
                        <hr class="my-3">
                        <section class="row">
                            <p>saya sangat puas sekali dalam perjalanan ini</p>
                        </section>
                    </div>
                </div>
            </article>
            <article class="col-12 col-sm-6 col-md-6 col-lg-4 col-xl-3 mt-2 mx-2">
                <div class="card custom-cardShadow custom-background ">
                    <div class="card-body">
                        <header class="d-flex justify-content-between">
                            <div class="row me-1">
                                <div class="d-inline-flex">
                                    <section class="custom-reviewContainerImg">
                                        <img src="{{ asset('image/profil.jpg') }}" alt="">
                                    </section>
                                    <section class="ms-2 custom-reviewName">
                                        <h3>Affandi Putra Pradana</h3>
                                        <time>2022-12-2</time>
                                    </section>
                                </div>
                            </div>
                        </header>
                        <hr class="my-3">
                        <section class="row">
                            <p>saya sangat puas sekali dalam perjalanan ini</p>
                        </section>
                    </div>
                </div>
            </article>
        </section>
        <section class="row">
            <h2 class="text-center fw-bold custom-contentHeader">Review Perjalanan Kamu</h2>
            <form action="">
                <textarea style="height: 100px;" class="border border-2 form-control mb-2 responsive-text-content" name=""
                    id=""></textarea>
            </form>
        </section>
        {{-- /Card Review --}}
    </section>
    {{-- Review --}}
@endsection

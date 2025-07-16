@extends('layouts.master')

@section('title','Lestari Wisata Dieng - Keindahan Alam Wisata Dieng')
@section('meta_description', 'Jelajahi wisata Dieng yang penuh pesona, dari Candi Dieng hingga panorama alam yang memukau di Wonosobo.')
@section('content')
    {{-- Jumbotron --}}
    <section class="container-fluid p-0">
        <header class="d-flex justify-content-center align-items-center text-white text-center" style="background: url('{{ asset('/image/head.jpg') }}') center/cover no-repeat; height: 570px;">
            <div class="overlay w-100 h-100" style="background: rgba(0, 0, 0, 0.5);"></div>
            <div class="position-absolute">
                <h2 class="responsive-text fw-bold">Selamat Datang di Lestari Wisata Dieng</h2>
                <a href="{{url('/paket-index')}}"><button class="border mt-4 rounded-pill border-white text-center custom-borderHead responsive-text-content">Lihat Paket</button></a>
            </div>
        </header>
    </section>
    {{-- /Jumbotron --}}

    {{-- Destinasi Wisata --}}
    <section class="container-fluid container-section">
        {{-- Header --}}
        <header class="row">
            <h2 class="text-center fw-bold custom-contentHeader">Destinasi Wisata Dieng <script>document.write(new Date().getFullYear());</script></h2>
        </header>
        {{-- /Header --}}
        {{-- Card --}}
        <section class="row container-section">
            <article class="col-xl-3 col-lg-4 col-md-6 col-sm-12 mb-2" >
                <div class="custom-overlay d-flex text-white" style="background: url('{{ asset('/image/head.jpg') }}') center/cover no-repeat; height: clamp(15rem, 40vw, 19rem);">
                    <div class="overlay custom-overlay w-100 h-100 ">
                        <h3 class="fw-bold custom-titleCard text-center">Candi Dieng</h3>
                        <div class="row mx-3 my-2">
                            <p class="fw-bold">Candi Dieng</p>
                            <p class="responsive-text-content">Kompleks candi tertua yang ada di Pulau Jawa berada pada ketinggian 2.000 mdpl dan menjadi salah satu kompleks candi tertinggi.</p>
                            <a href="" class="text-center mt-4">
                                <button class="rounded-pill border-white py-2 px-4 custom-borderHead responsive-text-content">Selengkapnya</button>
                            </a>
                        </div>
                    </div>
                </div>
            </article>
            <article class="col-xl-3 col-lg-4 col-md-6 col-sm-12 mb-2" >
                <div class="custom-overlay d-flex text-white" style="background: url('{{ asset('/image/head.jpg') }}') center/cover no-repeat; height: clamp(15rem, 40vw, 19rem);">
                    <div class="overlay custom-overlay w-100 h-100 ">
                        <h3 class="fw-bold custom-titleCard text-center">Candi Dieng</h3>
                        <div class="row mx-3 my-2">
                            <p class="fw-bold">Candi Dieng</p>
                            <p class="responsive-text-content">Kompleks candi tertua yang ada di Pulau Jawa berada pada ketinggian 2.000 mdpl dan menjadi salah satu kompleks candi tertinggi.</p>
                            <a href="" class="text-center mt-4">
                                <button class="rounded-pill border-white py-2 px-4 custom-borderHead responsive-text-content">Selengkapnya</button>
                            </a>
                        </div>
                    </div>
                </div>
            </article>
            <article class="col-xl-3 col-lg-4 col-md-6 col-sm-12 mb-2" >
                <div class="custom-overlay d-flex text-white" style="background: url('{{ asset('/image/head.jpg') }}') center/cover no-repeat; height: clamp(15rem, 40vw, 19rem);">
                    <div class="overlay custom-overlay w-100 h-100 ">
                        <h3 class="fw-bold custom-titleCard text-center">Candi Dieng</h3>
                        <div class="row mx-3 my-2">
                            <p class="fw-bold">Candi Dieng</p>
                            <p class="responsive-text-content">Kompleks candi tertua yang ada di Pulau Jawa berada pada ketinggian 2.000 mdpl dan menjadi salah satu kompleks candi tertinggi.</p>
                            <a href="" class="text-center mt-4">
                                <button class="rounded-pill border-white py-2 px-4 custom-borderHead responsive-text-content">Selengkapnya</button>
                            </a>
                        </div>
                    </div>
                </div>
            </article>
            <article class="col-xl-3 col-lg-4 col-md-6 col-sm-12 mb-2" >
                <div class="custom-overlay d-flex text-white" style="background: url('{{ asset('/image/head.jpg') }}') center/cover no-repeat; height: clamp(15rem, 40vw, 19rem);">
                    <div class="overlay custom-overlay w-100 h-100 ">
                        <h3 class="fw-bold custom-titleCard text-center">Candi Dieng</h3>
                        <div class="row mx-3 my-2">
                            <p class="fw-bold">Candi Dieng</p>
                            <p class="responsive-text-content">Kompleks candi tertua yang ada di Pulau Jawa berada pada ketinggian 2.000 mdpl dan menjadi salah satu kompleks candi tertinggi.</p>
                            <a href="" class="text-center mt-4">
                                <button class="rounded-pill border-white py-2 px-4 custom-borderHead responsive-text-content">Selengkapnya</button>
                            </a>
                        </div>
                    </div>
                </div>
            </article>
        </section>
        {{-- /Card --}}
        {{-- CTA --}}
        <section class="row text-center">
            <div class="col-12">
                <a href="{{url('/destinasi-index')}}">
                    <button class="rounded-pill text-center custom-borderContent responsive-text-content">Lihat Lainnya</button>
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
            <h2 class="text-center fw-bold custom-contentHeader">Paket Wisata Dieng <script>document.write(new Date().getFullYear());</script></h2>
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

        {{-- CTA --}}
        <section class="row text-center">
            <div class="col-12">
                <a href="{{url('/paket-index')}}">
                    <button class="rounded-pill text-center custom-borderContent responsive-text-content">Lihat Semua Paket</button>
                </a>
            </div>
        </section>
        {{-- /CTA --}}
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
                                        <img src="{{asset('image/profil.jpg')}}" alt="">
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
                                        <img src="{{asset('image/profil.jpg')}}" alt="">
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
                                        <img src="{{asset('image/profil.jpg')}}" alt="">
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
                                        <img src="{{asset('image/profil.jpg')}}" alt="">
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
                                        <img src="{{asset('image/profil.jpg')}}" alt="">
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
                <textarea style="height: 100px;" class="border border-2 form-control mb-2 responsive-text-content" name="" id=""></textarea>
            </form>
        </section>
        {{-- /Card Review --}}
    </section>
    {{-- Review --}}
@endsection

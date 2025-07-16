@extends('layouts.master')

@section('title', 'Candi Dieng - Lestari Wisata Dieng')
@section('meta_description', 'Jelajahi keindahan Candi Dieng di Wonosobo, termasuk sejarah Candi Arjuna, keunikan, dan daya tarik wisata lainnya di Dataran Tinggi Dieng.')
@section('content')
<section class="container-fluid mb-5">
    {{-- CTA Back --}}
    <button class="custom-back fw-bold" id="back">
        <i class="ri-arrow-left-s-line"></i>
        <a href="{{url('/destinasi-index')}}">Kembali</a>
    </button>
    {{-- /CTA Back --}}

    {{-- Header --}}
    <header class="row custom-container-header text-white mb-2">
        <span class="text-center responsive-text-content">Wisata Wonosobo</span>
        <h2 class="text-center fw-bold  responsive-text">Candi Dieng</h2>
    </header>
    {{-- /Header --}}

    {{-- Section: Deskripsi Candi Arjuna --}}
    <section class="row container-section">
        <div class="mb-3 col-sm-12 col-md-12 col-lg-6 d-flex align-items-center">
            <img class="shadow rounded" src="{{ asset('/image/head.jpg') }}" alt="Keindahan Candi Arjuna" title="Candi Arjuna - Salah Satu Candi Hindu Tertua di Indonesia"  loading="lazy">
        </div>
        <div class="col-sm-12 col-md-12 col-lg-6">
            <h3 class="responsive-text fw-bold custom-contentHeader">Candi Arjuna</h3>
            <p class="responsive-text-content">Candi Arjuna Wonosobo adalah salah satu kompleks candi Hindu tertua di Indonesia yang terletak di Dataran Tinggi Dieng, Wonosobo, Jawa Tengah. Candi ini diperkirakan dibangun pada abad ke-8 pada masa Kerajaan Mataram Kuno dan didedikasikan untuk pemujaan Dewa Siwa.</p>
            <h3 class="responsive-text fw-bold custom-contentHeader">Kompleks Candi Arjuna</h3>
            <p class="responsive-text-content">Kompleks candi tertua di Pulau Jawa ini terletak di ketinggian 2.000 mdpl, menjadikannya salah satu kompleks candi tertinggi. Banyak orang keliru menyebut kompleks ini sebagai Candi Arjuna, padahal Arjuna hanyalah salah satu candi di dalamnya. Kompleks ini terdiri dari tiga kelompok candi, yaitu Arjuna, Dwarawati, dan Gatotkaca, serta satu candi yang berdiri sendiri, yaitu Candi Bima.</p>
            <p class="responsive-text-content fw-bold">Baca Juga : <a href="" style="color: rgb(24, 111, 120)" class="custom-footerLink">Link</a></p>
        </div>
    </section>
    {{-- /Section: Deskripsi Candi Arjuna --}}

    {{-- Section: Keunikan Candi Arjuna --}}
    <section class="row container-section custom-background ">
        <h3 class="fw-bold custom-contentHeader">Keunikan Candi Arjuna</h3>
        <article class="col-xl-3 col-lg-4 col-md-6 col-sm-12 mb-2" >
            <div class="custom-overlay d-flex text-white" style="background: url('{{ asset('/image/head.jpg') }}') center/cover no-repeat; height: clamp(15rem, 40vw, 19rem);">
                <div class="overlay custom-overlay w-100 h-100 ">
                    <h3 class="fw-bold custom-titleCard text-center">Arsitektur Unik</h3>
                    <section class="row mx-3 my-2">
                        <p class="fw-bold">Detail Relief</p>
                        <p class="responsive-text-content">Candi Arjuna memiliki relief dan struktur khas Hindu yang masih terjaga.</p>
                    </section>
                </div>
            </div>
        </article>
        <article class="col-xl-3 col-lg-4 col-md-6 col-sm-12 mb-2" >
            <div class="custom-overlay d-flex text-white" style="background: url('{{ asset('/image/head.jpg') }}') center/cover no-repeat; height: clamp(15rem, 40vw, 19rem);">
                <div class="overlay custom-overlay w-100 h-100 ">
                    <h3 class="fw-bold custom-titleCard text-center">Arsitektur Unik</h3>
                    <section class="row mx-3 my-2">
                        <p class="fw-bold">Detail Relief</p>
                        <p class="responsive-text-content">Candi Arjuna memiliki relief dan struktur khas Hindu yang masih terjaga.</p>
                    </section>
                </div>
            </div>
        </article>
        <article class="col-xl-3 col-lg-4 col-md-6 col-sm-12 mb-2" >
            <div class="custom-overlay d-flex text-white" style="background: url('{{ asset('/image/head.jpg') }}') center/cover no-repeat; height: clamp(15rem, 40vw, 19rem);">
                <div class="overlay custom-overlay w-100 h-100 ">
                    <h3 class="fw-bold custom-titleCard text-center">Arsitektur Unik</h3>
                    <section class="row mx-3 my-2">
                        <p class="fw-bold">Detail Relief</p>
                        <p class="responsive-text-content">Candi Arjuna memiliki relief dan struktur khas Hindu yang masih terjaga.</p>
                    </section>
                </div>
            </div>
        </article>
    </section>
    {{-- /Section: Keunikan Candi Arjuna --}}

    {{-- Section: Lokasi dan Akses --}}
    <section class="row container-section">
        <h3 class="fw-bold custom-contentHeader mt-4">Lokasi dan Akses</h3>
        <p class="px-3 my-1 responsive-text-content">Candi Arjuna terletak di Kompleks Candi Dieng, Desa Dieng Kulon, Kecamatan Batur, Kabupaten Banjarnegara, Jawa Tengah. Berada di ketinggian sekitar 2.000 mdpl, candi ini dikelilingi oleh pemandangan alam yang indah dengan udara sejuk dan kabut yang sering menyelimuti.</p>
        <p class="px-3 my-1 responsive-text-content">Akses menuju Candi Arjuna dapat ditempuh dari Wonosobo (26 km / ±1 jam perjalanan) dengan kendaraan pribadi atau minibus dari Terminal Mendolo. Dari Semarang atau Yogyakarta (±3-4 jam perjalanan), wisatawan bisa menggunakan kendaraan pribadi atau naik bus ke Wonosobo, lalu melanjutkan dengan minibus ke Dieng. Tiket masuk ke kawasan ini sekitar Rp 20.000 - Rp 30.000, dengan jam operasional 07.00 - 17.00 WIB.</p>
    </section>
    {{-- /Section: Lokasi dan Akses --}}
    {{-- Section: Wisata Lain --}}
    <section class="row container-section">
        <h3 class="fw-bold custom-contentHeader mt-4 elementor-divider-separator">
            Wisata Lainnya
        </h3> 
        <article class="col-xl-3 col-lg-4 col-md-6 col-sm-12 mb-2" >
            <div class="custom-overlay d-flex text-white" style="background: url('{{ asset('/image/head.jpg') }}') center/cover no-repeat; height: clamp(15rem, 40vw, 19rem);">
                <div class="overlay custom-overlay w-100 h-100 ">
                    <h3 class="fw-bold custom-titleCard text-center">Candi Dieng</h3>
                    <section class="row mx-3 my-2">
                        <p class="fw-bold">Candi Dieng</p>
                        <p class="responsive-text-content">Kompleks candi tertua yang ada di Pulau Jawa berada pada ketinggian 2.000 mdpl dan menjadi salah satu kompleks candi tertinggi.</p>
                        <a href="{{url('/destinasi-show')}}" class="text-center mt-4">
                            <button class="rounded-pill border-white py-2 px-4 custom-borderHead responsive-text-content">Selengkapnya</button>
                        </a>
                    </section>
                </div>
            </div>
        </article>
        <article class="col-xl-3 col-lg-4 col-md-6 col-sm-12 mb-2" >
            <div class="custom-overlay d-flex text-white" style="background: url('{{ asset('/image/head.jpg') }}') center/cover no-repeat; height: clamp(15rem, 40vw, 19rem);">
                <div class="overlay custom-overlay w-100 h-100 ">
                    <h3 class="fw-bold custom-titleCard text-center">Candi Dieng</h3>
                    <section class="row mx-3 my-2">
                        <p class="fw-bold">Candi Dieng</p>
                        <p class="responsive-text-content">Kompleks candi tertua yang ada di Pulau Jawa berada pada ketinggian 2.000 mdpl dan menjadi salah satu kompleks candi tertinggi.</p>
                        <a href="{{url('/destinasi-show')}}" class="text-center mt-4">
                            <button class="rounded-pill border-white py-2 px-4 custom-borderHead responsive-text-content">Selengkapnya</button>
                        </a>
                    </section>
                </div>
            </div>
        </article>
        <article class="col-xl-3 col-lg-4 col-md-6 col-sm-12 mb-2" >
            <div class="custom-overlay d-flex text-white" style="background: url('{{ asset('/image/head.jpg') }}') center/cover no-repeat; height: clamp(15rem, 40vw, 19rem);">
                <div class="overlay custom-overlay w-100 h-100 ">
                    <h3 class="fw-bold custom-titleCard text-center">Candi Dieng</h3>
                    <section class="row mx-3 my-2">
                        <p class="fw-bold">Candi Dieng</p>
                        <p class="responsive-text-content">Kompleks candi tertua yang ada di Pulau Jawa berada pada ketinggian 2.000 mdpl dan menjadi salah satu kompleks candi tertinggi.</p>
                        <a href="{{url('/destinasi-show')}}" class="text-center mt-4">
                            <button class="rounded-pill border-white py-2 px-4 custom-borderHead responsive-text-content">Selengkapnya</button>
                        </a>
                    </section>
                </div>
            </div>
        </article>
        {{-- CTA --}}
        <section class="text-center">
            <div class="col-12">
                <a href="{{url('/destinasi-index')}}">
                    <button class="rounded-pill text-center custom-borderContent responsive-text-content">Lihat Lainnya</button>
                </a>
            </div>
        </section>
        {{-- /CTA --}}
    </section>
    {{-- /Section: Wisata Lain --}}
</section>
@endsection


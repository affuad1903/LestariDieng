@extends('layouts.master')

@section('title', 'Destinasi Wisata Wonosobo | Eksplorasi Keindahan Budaya dan Pesona Wisata Wonosobo!')
@section('meta_description', 'Rasakan sensasi petualangan seru dan kekayaan budaya Wonosobo yang akan mengisi setiap langkah perjalanan Anda dengan keajaiban dan kenangan yang tak terlupakan!')
@section('content')
<section class="container-fluid mb-5">
    {{-- Header --}}
    <header class="row custom-container-header text-white mb-2">
        <h2 class="text-center fw-bold  responsive-text">Eksplorasi Keindahan Budaya dan Pesona Wisata Wonosobo!</h2>
        <p class="mt-3 text-center responsive-text-content">Rasakan sensasi petualangan seru dan kekayaan budaya Wonosobo yang akan mengisi setiap langkah perjalanan Anda dengan keajaiban dan kenangan yang tak terlupakan!</p>
    </header>
    {{-- /Header --}}
    {{-- Card --}}
    <section class="row container-section">
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
    </section>
    {{-- /Card --}}
</section>

@endsection

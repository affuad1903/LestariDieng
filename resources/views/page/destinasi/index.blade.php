@extends('layouts.master')

@section('title', 'Destinasi Wisata Wonosobo | Eksplorasi Keindahan Budaya dan Pesona Wisata Wonosobo!')
@section('meta_description',
    'Rasakan sensasi petualangan seru dan kekayaan budaya Wonosobo yang akan mengisi setiap
    langkah perjalanan Anda dengan keajaiban dan kenangan yang tak terlupakan!')
@section('content')
    <section class="container-fluid mb-5">
        {{-- Header --}}
        <header class="row custom-container-header text-white mb-2">
            <h2 class="text-center fw-bold  responsive-text">Eksplorasi Keindahan Budaya dan Pesona Wisata Wonosobo!</h2>
            <p class="mt-3 text-center responsive-text-content">Rasakan sensasi petualangan seru dan kekayaan budaya Wonosobo
                yang akan mengisi setiap langkah perjalanan Anda dengan keajaiban dan kenangan yang tak terlupakan!</p>
        </header>
        {{-- /Header --}}
        {{-- Card --}}
        <section class="row container-section">
            @foreach ($destination as $item)
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
    </section>

@endsection

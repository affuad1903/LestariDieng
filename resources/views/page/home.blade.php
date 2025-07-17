@extends('layouts.master')

@section('title')
    {{ $home->title }} - Keindahan Alam Wisata Dieng
@endsection
@section('meta_description')
    Jelajahi wisata {{ $home->title }} yang penuh pesona, dari Candi Dieng hingga panorama alam yang
    memukau di Wonosobo.
@endsection

@section('content')
@php use Illuminate\Support\Str; @endphp
    {{-- Jumbotron --}}
    <section class="container-fluid p-0">
        <header class="d-flex justify-content-center align-items-center text-white text-center"
            style="background: url('{{ asset('/image/home/'.$home->hero_image) }}') center/cover no-repeat; height: 570px;">
            <div class="overlay w-100 h-100" style="background: rgba(0, 0, 0, 0.5);"></div>
            <div class="position-absolute">
                <h2 class="responsive-text fw-bold">Selamat Datang di {{$home->title}}</h2>
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
            {{-- Card --}}
            <section class="row container-section justify-content-center">
                @foreach ($pakets->take(3) as $paket)
                    <article class="col-md-6 col-lg-4 col-sm-12 mb-4">
                        <div class="custom-card">
                            <div class="card-image-wrapper">
                                <img src="{{ asset('/image/paket/' . $paket->paket_image) }}"
                                    alt="{{ $paket->paket_title }}">
                                <div class="overlay-gradient"></div>
                                <div class="card-title-overlay">
                                    <h3>{{ $paket->paket_title }}</h3>
                                </div>
                            </div>
                            <div class="card-body d-flex flex-column">
                                <div class="d-flex align-items-center mb-3">
                                    <i class="ri-timer-2-line me-2"></i>
                                    <p class="mb-0">{{ $paket->paket_sub_title_date }}</p>
                                </div>
                                <div class="d-flex align-items-center mb-3">
                                    <i class="ri-group-line me-2"></i>
                                    <p class="mb-0">Kapasitas Minimal {{ $paket->paket_detail }} Orang</p>
                                </div>
                                <a href="{{ url('/paket-show/' . $paket->id) }}" class="btn-detail text-center">Lihat Paket</a>
                            </div>
                        </div>
                    </article>
                @endforeach
            </section>

            {{-- CTA --}}
            <section class="row text-center">
                <div class="col-12">
                    <a href="{{ url('/paket-index') }}">
                        <button class="rounded-pill text-center custom-borderContent responsive-text-content">Lihat Semua Paket</button>
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
        <section class="row justify-content-center py-4">
            @forelse ($reviews as $review)
                <article class="col-12 col-sm-6 col-md-4 col-lg-3 mb-4">
                    <div class="card custom-cardShadow custom-background h-100">
                        <div class="card-body">
                            <header class="mb-2">
                                <h5 class="fw-bold">{{ $review->nama }}</h5>
                                <time class="text-muted small">{{ $review->created_at->format('d M Y') }}</time>
                            </header>
                            <hr class="my-2">
                            <section>
                                <div class="mb-2">
                                    @for ($i = 0; $i < $review->bintang; $i++)
                                        <i class="ri-star-fill text-warning"></i>
                                    @endfor
                                    @for ($i = $review->bintang; $i < 5; $i++)
                                        <i class="ri-star-line text-muted"></i>
                                    @endfor
                                </div>
                               <p class="responsive-text-content mb-0"> {{ Str::words(strip_tags($review->isi_review), 15, '...') }}
</p>
                            </section>
                        </div>
                    </div>
                </article>
            @empty
                <p class="text-center">Belum ada review yang tersedia saat ini.</p>
            @endforelse
        </section>
        {{-- /Card Review --}}
    </section>
    {{-- /Review --}}

@endsection

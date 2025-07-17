@extends('layouts.master')

@section('title', 'Candi Dieng - Lestari Wisata Dieng')
@section('meta_description',
    'Jelajahi keindahan Candi Dieng di Wonosobo, termasuk sejarah Candi Arjuna, keunikan, dan
    daya tarik wisata lainnya di Dataran Tinggi Dieng.')
@section('content')
    <section class="container-fluid mb-5">
        {{-- CTA Back --}}
        <button class="custom-back fw-bold" id="back">
            <i class="ri-arrow-left-s-line"></i>
            <a href="{{ url('/destinasi-index') }}">Kembali</a>
        </button>
        {{-- /CTA Back --}}

        {{-- Header --}}
        <header class="row custom-container-header text-white mb-2">
            <span class="text-center responsive-text-content">Wisata Dieng</span>
            <h2 class="text-center fw-bold  responsive-text">
                {{ $destination->content_title }}
            </h2>
        </header>
        {{-- /Header --}}

        {{-- Section Deskripsi --}}
        <section class="row container-section">
            <div class="mb-3 col-sm-12 col-md-12 col-lg-6 d-flex align-items-center">
                <img class="shadow rounded" src="{{ asset('/image/destination/' . $destination->thumbnail_image) }}"
                    alt="{{$destination->title}}"
                    loading="lazy">
            </div>
            @php
                $firstSection = $destination->destination_section->first();
            @endphp

            @if ($firstSection)
            <div class="col-sm-12 col-md-12 col-lg-6">
                <h3 class="responsive-text fw-bold custom-contentHeader">{{ $firstSection->title }}</h3>
                <p class="responsive-text-content">{{ $firstSection->detail }}</p>
            </div>
            @else
                <h3 class="responsive-text fw-bold custom-contentHeader">Informasi belum tersedia</h3>
                <p class="responsive-text-content">Konten untuk destinasi ini belum dilengkapi.</p>
            @endif

        </section>
        {{-- /Section Deskripsi --}}

        {{-- Section: Keunikan  --}}
        <section class="row container-section custom-background ">
            <h3 class="fw-bold custom-contentHeader">Keunikan Candi Arjuna</h3>
            @forelse ($destination->destination_uniq as $item)
                <article class="col-xl-3 col-lg-4 col-md-6 col-sm-12 mb-2">
                    <div class="custom-overlay d-flex text-white"
                        style="background: url('{{ asset('/image/destination/uniq/'. $item->uniq_image) }}') center/cover no-repeat; height: clamp(15rem, 40vw, 19rem);">
                        <div class="overlay custom-overlay w-100 h-100 ">
                            <h3 class="fw-bold custom-titleCard text-center">{{$item->uniq_title}}</h3>
                            <section class="row mx-3 my-2">
                                <p class="fw-bold">{{$item->uniq_sub_title}}</p>
                                <p class="responsive-text-content">{{$item->uniq_detail}}</p>
                            </section>
                        </div>
                    </div>
                </article>
            @empty
                <p class="text-center">Tidak ada keunikan yang ditemukan untuk Candi Arjuna.</p>
            @endforelse
        </section>
        {{-- /Section: Keunikan --}}

        {{-- Section: Lokasi dan Akses --}}
        <section class="row container-section">
            <h3 class="fw-bold custom-contentHeader mt-4 elementor-divider-separator">
                Wisata Lainnya
            </h3>
            @if ($randomDestination->isEmpty())
                <p class="text-center">Belum ada wisata lain yang ditampilkan.</p>
            @else
                @foreach ($randomDestination as $item)
                    <article class="col-xl-3 col-lg-4 col-md-6 col-sm-12 mb-2">
                        <div class="custom-overlay d-flex text-white"
                            style="background: url('{{ asset('/image/destination/' . $item->thumbnail_image) }}') center/cover no-repeat; height: clamp(15rem, 40vw, 19rem);">
                            <div class="overlay custom-overlay w-100 h-100 ">
                                <h3 class="fw-bold custom-titleCard text-center">{{ $item->content_title }}</h3>
                                <div class="row mx-3 my-2">
                                    <p class="fw-bold">{{ $item->content_title }}</p>
                                    <p class="responsive-text-content">
                                        {{ Str::limit(strip_tags($item->content_summary), 120) }}
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
            @endif

            {{-- CTA --}}
            <section class="text-center">
                <div class="col-12">
                    <a href="{{ url('/destinasi-index') }}">
                        <button class="rounded-pill text-center custom-borderContent responsive-text-content">Lihat
                            Lainnya</button>
                    </a>
                </div>
            </section>
            {{-- /CTA --}}
        </section>
        {{-- /Section: Wisata Lain --}}
    </section>
@endsection

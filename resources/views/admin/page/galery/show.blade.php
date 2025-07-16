@extends('admin.layouts.master')

@section('icon-title')
<span class="page-title-icon bg-gradient-success text-white me-2">
    <i class="mdi mdi-eye"></i>
</span>
@endsection

@section('title') Detail Galeri @endsection

@section('content')
<section class="row">
    <div class="col-12 grid-margin">
        <div class="card shadow">
            <div class="card-body row">
                <h2 class="card-title text-center text-white mb-4">{{ $galery->title }}</h2>

                <div class="row justify-content-center">
                    @forelse($galery->galery_img as $img)
                        <div class="col-12 col-sm-6 col-md-4 col-lg-3 mb-4 d-flex justify-content-center">
                            <div class="card shadow-sm border border-secondary" style="width: 100%; max-width: 250px;">
                                <div style="height: 180px; overflow: hidden;">
                                    <img src="{{ asset('image/galery/' . $galery->id . '/' . $img->image) }}"
                                        class="w-100 h-100 object-fit-cover" style="object-fit: cover;" alt="gambar">
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="col-12 text-center">
                            <p class="text-muted">Belum ada gambar di galeri ini.</p>
                        </div>
                    @endforelse
                </div>
                <a href="{{ route('galery.index') }}" class="btn btn-secondary mt-3 px-4 py-2">Kembali</a>
               
            </div>
        </div>
    </div>
</section>
@endsection

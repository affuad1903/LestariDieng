@extends('admin.layouts.master')

@section('icon-title')
<span class="page-title-icon bg-gradient-info text-white me-2">
    <span class="mdi mdi-pencil"></span>
</span>
@endsection

@section('title') Edit Galeri @endsection

@section('content')
<section class="row">
    <div class="col-12 grid-margin">
        <div class="card shadow">
            <div class="card-body row">
                <h2 class="card-title text-center text-md-start">Tambah Gambar ke: {{ $galery->title }}</h2>

                @if(session('success'))
                    <div class="alert alert-success">{{ session('success') }}</div>
                @endif

                {{-- Upload Gambar Tambahan --}}
                <form method="POST" action="{{ route('galery.addImages', $galery->id) }}" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-3">
                        <label>Tambah Gambar Baru</label>
                        <input type="file" name="images[]" class="form-control" multiple required>
                    </div>
                    <button class="btn btn-primary">Tambah</button>
                </form>

                {{-- List Gambar --}}
                <hr>
                <h4 class="mt-4 text-white">Gambar Saat Ini</h4>
                <div class="row">
                    @foreach($galery->galery_img as $img)
                        <div class="col-md-3 col-sm-4 col-6 mb-4 d-flex justify-content-center">
                            <div class="position-relative" style="width: 200px; height: 200px;">
                                <img src="{{ asset('image/galery/' . $galery->id . '/' . $img->image) }}"
                                    class="w-100 h-100 rounded shadow"
                                    style="object-fit: cover; border: 2px solid #555;">
                                <form action="{{ route('galery.deleteImage', $img->id) }}" method="POST"
                                    class="position-absolute bottom-0 start-50 translate-middle-x mb-2">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger px-3">Hapus</button>
                                </form>
                            </div>
                        </div>
                    @endforeach
                </div>
                <a href="{{ route('galery.index') }}" class="btn btn-secondary mt-3">Kembali</a>
            </div>
        </div>
    </div>
</section>
@endsection

@extends('admin.layouts.master')

@section('content')
<section class="row">
    <div class="col-12 grid-margin">
        <div class="card">
            <div class="card-body">
                <h2 class="card-title">Edit Fasilitas</h2>
                <form action="{{ route('daftar-fasilitas.update', $daftar_fasilitas->id) }}" method="POST" class="row">
                    @csrf
                    @method('PUT')
                    <section class="forms-sample col-12">

                        {{-- Nama Fasilitas --}}
                        <section class="form-group">
                            <h3 class="m-0"><label for="nama_fasilitas">Nama Fasilitas</label></h3>
                            <input type="text" class="form-control text-dark" name="nama_fasilitas" id="nama_fasilitas"
                                value="{{ old('nama_fasilitas', $daftar_fasilitas->nama_fasilitas) }}">
                            @error('nama_fasilitas')
                                <div class="alert alert-danger py-0 my-1">{{ $message }}</div>
                            @enderror
                        </section>

                        {{-- Pilih Paket --}}
                        <section class="ps-4 mt-3 row">
                            <h3 class="p-0 m-0"><label>Pilih Paket yang Tersedia</label></h3>
                            <section class="row list-scroll">
                                @forelse ($paket as $item)
                                <div class="col-12 p-0">
                                    <section class="input-group checkbox">
                                        <input type="checkbox"
                                               class="form-check-input m-0 border rounded"
                                               name="paket[]"
                                               value="{{ $item->id }}"
                                               id="paket_{{ $item->id }}"
                                               {{ $daftar_fasilitas->paket && $daftar_fasilitas->paket->contains('id', $item->id) ? 'checked' : '' }}>
                                        <label class="form-check-label text-white ms-1"
                                               for="paket_{{ $item->id }}">
                                            {{ $item->paket_title }}
                                        </label>
                                    </section>
                                </div>
                                @empty
                                    <p class="text-muted">Belum ada data paket tersedia</p>
                                @endforelse
                            </section>
                        </section>

                    </section>

                    {{-- Tombol --}}
                    <button type="submit" class="btn btn-primary mt-3">Simpan Perubahan</button>
                    <a href="{{ route('daftar-fasilitas.index') }}" class="btn btn-light mt-3">Batal</a>
                </form>
            </div>
        </div>
    </div>
</section>
@endsection

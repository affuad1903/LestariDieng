@extends('admin.layouts.master')

@section('icon-title')
<span class="page-title-icon bg-gradient-primary text-white me-2">
    <i class="mdi mdi-calendar-clock"></i>
</span>
@endsection

@section('title') Edit Detail Itinerary @endsection

@section('content')
<section class="row">
    <div class="col-md-8 offset-md-2 col-12">
        <div class="card shadow">
            <div class="card-body">
                <h3 class="mb-4">Edit Detail Itinerary</h3>

                @if (session('error'))
                    <div class="alert alert-danger">{{ session('error') }}</div>
                @endif

                <form action="{{ route('detail-itinerary.update', $detailItinerary->id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    {{-- Pilih Paket --}}
                    <div class="mb-3">
                        <label for="paket_id" class="form-label">Paket</label>
                        <select name="paket_id" id="paket_id" class="form-select" required>
                            <option value="">-- Pilih Paket --</option>
                            @foreach ($pakets as $paket)
                                <option value="{{ $paket->id }}" {{ $detailItinerary->paket_id == $paket->id ? 'selected' : '' }}>
                                    {{ $paket->paket_title }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    {{-- Hari ke- --}}
                    <div class="mb-3">
                        <label for="day" class="form-label">Hari ke-</label>
                        <input type="number"
                               name="day"
                               id="day"
                               min="1"
                               max="31"
                               class="form-control"
                               required
                               value="{{ old('day', $detailItinerary->day) }}"
                               placeholder="Contoh: 1">
                    </div>

                    {{-- Jam --}}
                    <div class="mb-3">
                        <label for="time" class="form-label">Jam</label>
                        <input type="time"
                               name="time"
                               id="time"
                               class="form-control"
                               required
                               value="{{ old('time', $detailItinerary->time) }}">
                    </div>

                    {{-- Detail --}}
                    <div class="mb-3">
                        <label for="detail" class="form-label">Detail Itinerary</label>
                        <textarea name="detail" id="detail" rows="4" class="form-control" required>{{ old('detail', $detailItinerary->detail) }}</textarea>
                    </div>

                    {{-- Tombol --}}
                    <div class="d-flex justify-content-between">
                        <a href="{{ route('detail-itinerary.index') }}" class="btn btn-secondary">Kembali</a>
                        <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>
@endsection

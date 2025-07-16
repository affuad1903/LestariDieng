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

                    <div class="mb-3">
                        <label for="day_itinerary_id" class="form-label">Hari</label>
                        <select name="day_itinerary_id" id="day_itinerary_id" class="form-select" required>
                            <option value="">-- Pilih Hari --</option>
                            @foreach ($dayItinerary as $day)
                                <option value="{{ $day->id }}" {{ $detailItinerary->day_itinerary_id == $day->id ? 'selected' : '' }}>
                                    {{ $day->nama_hari }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="time_itinerary_id" class="form-label">Jam</label>
                        <select name="time_itinerary_id" id="time_itinerary_id" class="form-select" required>
                            <option value="">-- Pilih Jam --</option>
                            @foreach ($timeItinerary as $time)
                                <option value="{{ $time->id }}" {{ $detailItinerary->time_itinerary_id == $time->id ? 'selected' : '' }}>
                                    {{ \Carbon\Carbon::parse($time->waktu)->format('H:i') }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="detail" class="form-label">Detail Itinerary</label>
                        <textarea name="detail" id="detail" rows="4" class="form-control" required>{{ old('detail', $detailItinerary->detail) }}</textarea>
                    </div>

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

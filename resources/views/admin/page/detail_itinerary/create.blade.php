@extends('admin.layouts.master')

@push('styles')
<link rel="stylesheet" href="{{ asset('css/admin/admin-forms.css') }}">
@endpush

@section('icon-title')
<i class="fas fa-plus-circle"></i>
@endsection

@section('title', 'Tambah Detail Itinerary')

@section('content')

<!-- Flash Messages -->
@include('admin.components.flash-messages')

<div class="container-fluid px-4">
    <div class="row justify-content-center">
        <div class="col-xl-8 col-lg-10">
            <div class="card admin-form-container">
                <div class="admin-form-header">
                    <h4>
                        <i class="fas fa-calendar-plus me-2"></i>Tambah Detail Itinerary
                    </h4>
                </div>
                <div class="admin-form-body">
                    <form method="POST" action="{{ route('detail-itinerary.store') }}" enctype="multipart/form-data">
                        @csrf
                        
                        {{-- Pilih Paket --}}
                        <div class="admin-form-group">
                            <label class="admin-form-label">
                                <i class="fas fa-box me-2"></i>Pilih Paket
                                <span class="required">*</span>
                            </label>
                            <div class="admin-form-help-text mb-3">
                                Pilih paket yang akan ditambahkan itinerary
                            </div>
                            <div class="row">
                                @foreach ($paket as $item)
                                <div class="col-md-6 col-12 mb-2">
                                    <div class="form-check admin-checkbox">
                                        <input type="radio" 
                                               class="form-check-input" 
                                               name="paket_id" 
                                               value="{{ $item->id }}"
                                               id="paket_{{ $item->id }}"
                                               {{ old('paket_id') == $item->id ? 'checked' : '' }}>
                                        <label class="form-check-label" for="paket_{{ $item->id }}">
                                            {{ $item->paket_title }}
                                        </label>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                            @error('paket_id')
                                <div class="admin-error-message">
                                    <i class="fas fa-exclamation-circle"></i>{{ $message }}
                                </div>
                            @enderror
                        </div>

                        {{-- Pilih Hari --}}
                        <div class="admin-form-group">
                            <label for="day_itinerary_id" class="admin-form-label">
                                <i class="fas fa-calendar-day me-2"></i>Pilih Hari
                                <span class="required">*</span>
                            </label>
                            <select name="day_itinerary_id" 
                                    id="day_itinerary_id" 
                                    class="admin-form-control @error('day_itinerary_id') is-invalid @enderror">
                                <option value="">-- Pilih Hari --</option>
                                @foreach ($day_itinerary as $item)
                                    <option value="{{ $item->id }}" {{ old('day_itinerary_id') == $item->id ? 'selected' : '' }}>
                                        {{ $item->nama_hari }}
                                    </option>
                                @endforeach
                            </select>
                            @error('day_itinerary_id')
                                <div class="admin-error-message">
                                    <i class="fas fa-exclamation-circle"></i>{{ $message }}
                                </div>
                            @enderror
                        </div>

                        {{-- Tambah Hari Baru --}}
                        <div class="admin-form-group">
                            <label for="new_day" class="admin-form-label">
                                <i class="fas fa-plus me-2"></i>Atau Tambah Hari Baru
                            </label>
                            <input type="text" 
                                   name="new_day" 
                                   id="new_day" 
                                   class="admin-form-control @error('new_day') is-invalid @enderror"
                                   placeholder="Contoh: Day 3, Day 4"
                                   value="{{ old('new_day') }}">
                            <div class="admin-form-help-text">
                                Kosongkan jika memilih dari daftar hari yang tersedia
                            </div>
                            @error('new_day')
                                <div class="admin-error-message">
                                    <i class="fas fa-exclamation-circle"></i>{{ $message }}
                                </div>
                            @enderror
                        </div>

                        {{-- Pilih Waktu --}}
                        <div class="admin-form-group">
                            <label for="time_itinerary_id" class="admin-form-label">
                                <i class="fas fa-clock me-2"></i>Pilih Waktu
                                <span class="required">*</span>
                            </label>
                            <select name="time_itinerary_id" 
                                    id="time_itinerary_id" 
                                    class="admin-form-control @error('time_itinerary_id') is-invalid @enderror">
                                <option value="">-- Pilih Waktu --</option>
                                @foreach ($time_itinerary as $item)
                                    <option value="{{ $item->id }}" {{ old('time_itinerary_id') == $item->id ? 'selected' : '' }}>
                                        {{ \Carbon\Carbon::parse($item->waktu)->format('H:i') }}
                                    </option>
                                @endforeach
                            </select>
                            @error('time_itinerary_id')
                                <div class="admin-error-message">
                                    <i class="fas fa-exclamation-circle"></i>{{ $message }}
                                </div>
                            @enderror
                        </div>

                        {{-- Tambah Waktu Baru --}}
                        <div class="admin-form-group">
                            <label for="new_time" class="admin-form-label">
                                <i class="fas fa-plus me-2"></i>Atau Tambah Waktu Baru
                            </label>
                            <input type="time" 
                                   name="new_time" 
                                   id="new_time" 
                                   class="admin-form-control @error('new_time') is-invalid @enderror"
                                   value="{{ old('new_time') }}">
                            <div class="admin-form-help-text">
                                Kosongkan jika memilih dari daftar waktu yang tersedia
                            </div>
                            @error('new_time')
                                <div class="admin-error-message">
                                    <i class="fas fa-exclamation-circle"></i>{{ $message }}
                                </div>
                            @enderror
                        </div>

                        {{-- Detail --}}
                        <div class="admin-form-group">
                            <label for="detail" class="admin-form-label">
                                <i class="fas fa-file-alt me-2"></i>Detail Aktivitas
                                <span class="required">*</span>
                            </label>
                            <textarea name="detail" 
                                      id="detail" 
                                      class="admin-form-control @error('detail') is-invalid @enderror" 
                                      rows="4" 
                                      placeholder="Contoh: Kunjungan ke Telaga Warna, menikmati pemandangan sunrise">{{ old('detail') }}</textarea>
                            <div class="admin-form-help-text">
                                Jelaskan aktivitas yang akan dilakukan pada waktu dan hari tersebut
                            </div>
                            @error('detail')
                                <div class="admin-error-message">
                                    <i class="fas fa-exclamation-circle"></i>{{ $message }}
                                </div>
                            @enderror
                        </div>

                        {{-- Submit Button --}}
                        <div class="d-grid gap-2 mt-4">
                            <button type="submit" class="btn btn-register text-white">
                                <i class="fas fa-save me-2"></i>Simpan Detail Itinerary
                            </button>
                            <a href="{{ route('detail-itinerary.index') }}" class="btn btn-outline-secondary">
                                <i class="fas fa-arrow-left me-2"></i>Kembali ke Daftar
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script src="{{ asset('js/admin/admin-forms.js') }}"></script>
<script src="{{ asset('js/admin/form-enhancements.js') }}"></script>
@endpush
@endsection

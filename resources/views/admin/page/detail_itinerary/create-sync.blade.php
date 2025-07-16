@extends('admin.layouts.master')

@push('styles')
<link rel="stylesheet" href="{{ asset('css/admin/admin-forms.css') }}">
@endpush

@section('icon-title')
<i class="fas fa-calendar-plus"></i>
@endsection

@section('title', 'Tambah Itinerary ke Paket')

@section('content')

<!-- Flash Messages -->
@include('admin.components.flash-messages')

<div class="container-fluid px-4">
    <div class="row justify-content-center">
        <div class="col-xl-8 col-lg-10">
            <div class="card admin-form-container">
                <div class="admin-form-header">
                    <h4>
                        <i class="fas fa-calendar-plus me-2"></i>Tambah Itinerary ke Paket
                    </h4>
                </div>
                <div class="admin-form-body">
                    <!-- Info Paket Terpilih -->
                    <div class="selected-package-info mb-4">
                        <div class="alert alert-warning border-left-warning">
                            <div class="d-flex align-items-center">
                                <i class="fas fa-box fa-2x text-warning me-3"></i>
                                <div>
                                    <h5 class="mb-1 text-warning">Paket Terpilih</h5>
                                    <p class="mb-0 text-dark fw-bold">{{ $selected_paket->paket_title }}</p>
                                    <small class="text-muted">{{ $selected_paket->paket_sub_title_date }}</small>
                                </div>
                            </div>
                        </div>
                    </div>

                    <form method="POST" action="{{ route('detail-itinerary.store') }}" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="is_synchronized" value="1">
                        <input type="hidden" name="paket_id" value="{{ $selected_paket->id }}">
                        
                        {{-- Pilih Hari --}}
                        <div class="admin-form-group">
                            <label for="day_itinerary_id" class="admin-form-label">
                                <i class="fas fa-calendar-day me-2"></i>Pilih Hari
                                <span class="required">*</span>
                            </label>
                            <div class="admin-form-help-text mb-3">
                                Pilih hari untuk itinerary ini
                            </div>
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
                            <div class="admin-form-help-text mb-3">
                                Masukkan nama hari baru jika tidak ada di daftar di atas
                            </div>
                            <input type="text" 
                                   name="new_day" 
                                   id="new_day" 
                                   class="admin-form-control @error('new_day') is-invalid @enderror"
                                   placeholder="Contoh: Day 3, Day 4, Hari Pertama"
                                   value="{{ old('new_day') }}">
                            <div class="admin-form-help-text mt-2">
                                <i class="fas fa-info-circle text-info me-1"></i>
                                Kosongkan jika memilih dari daftar hari yang tersedia di atas
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
                            <div class="admin-form-help-text mb-3">
                                Pilih waktu untuk kegiatan ini
                            </div>
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
                            <div class="admin-form-help-text mb-3">
                                Masukkan waktu baru jika tidak ada di daftar di atas
                            </div>
                            <input type="time" 
                                   name="new_time" 
                                   id="new_time" 
                                   class="admin-form-control @error('new_time') is-invalid @enderror"
                                   value="{{ old('new_time') }}">
                            <div class="admin-form-help-text mt-2">
                                <i class="fas fa-info-circle text-info me-1"></i>
                                Kosongkan jika memilih dari daftar waktu yang tersedia di atas
                            </div>
                            @error('new_time')
                                <div class="admin-error-message">
                                    <i class="fas fa-exclamation-circle"></i>{{ $message }}
                                </div>
                            @enderror
                        </div>

                        {{-- Detail Kegiatan --}}
                        <div class="admin-form-group">
                            <label for="detail" class="admin-form-label">
                                <i class="fas fa-clipboard-list me-2"></i>Detail Kegiatan
                                <span class="required">*</span>
                            </label>
                            <div class="admin-form-help-text mb-3">
                                Jelaskan kegiatan yang akan dilakukan pada waktu tersebut
                            </div>
                            <textarea name="detail" 
                                      id="detail" 
                                      rows="4"
                                      class="admin-form-control @error('detail') is-invalid @enderror"
                                      placeholder="Contoh: Sarapan di hotel, Check out, Perjalanan menuju Candi Dieng, Foto di Telaga Warna"
                                      required>{{ old('detail') }}</textarea>
                            @error('detail')
                                <div class="admin-error-message">
                                    <i class="fas fa-exclamation-circle"></i>{{ $message }}
                                </div>
                            @enderror
                        </div>
                        
                        <!-- Submit Buttons -->
                        <div class="form-actions mt-4">
                            <div class="d-flex gap-3 justify-content-between flex-wrap">
                                <a href="{{ route('paket.show', $selected_paket->id) }}" class="btn btn-outline-secondary">
                                    <i class="fas fa-arrow-left me-2"></i>Kembali ke Detail Paket
                                </a>
                                <button type="submit" class="btn btn-register text-white">
                                    <i class="fas fa-save me-2"></i>Simpan Itinerary ke Paket
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script src="{{ asset('js/admin/admin-forms.js') }}"></script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    const daySelect = document.getElementById('day_itinerary_id');
    const newDayInput = document.getElementById('new_day');
    const timeSelect = document.getElementById('time_itinerary_id');
    const newTimeInput = document.getElementById('new_time');
    
    // Clear new day input when day select is changed
    daySelect.addEventListener('change', function() {
        if (this.value) {
            newDayInput.value = '';
        }
    });
    
    // Clear day select when new day is entered
    newDayInput.addEventListener('input', function() {
        if (this.value.trim()) {
            daySelect.value = '';
        }
    });
    
    // Clear new time input when time select is changed
    timeSelect.addEventListener('change', function() {
        if (this.value) {
            newTimeInput.value = '';
        }
    });
    
    // Clear time select when new time is entered
    newTimeInput.addEventListener('change', function() {
        if (this.value) {
            timeSelect.value = '';
        }
    });
    
    // Form validation
    const form = document.querySelector('form');
    form.addEventListener('submit', function(e) {
        const hasDay = daySelect.value || newDayInput.value.trim();
        const hasTime = timeSelect.value || newTimeInput.value;
        const hasDetail = document.getElementById('detail').value.trim();
        
        if (!hasDay) {
            e.preventDefault();
            alert('Pilih hari atau masukkan hari baru!');
            return false;
        }
        
        if (!hasTime) {
            e.preventDefault();
            alert('Pilih waktu atau masukkan waktu baru!');
            return false;
        }
        
        if (!hasDetail) {
            e.preventDefault();
            alert('Detail kegiatan harus diisi!');
            return false;
        }
    });
});
</script>
@endpush
@endsection

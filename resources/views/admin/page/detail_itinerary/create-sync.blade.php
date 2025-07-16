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

                        {{-- Hari ke- --}}
                        <div class="admin-form-group">
                            <label for="day" class="admin-form-label">
                                <i class="fas fa-calendar-day me-2"></i>Hari ke-
                                <span class="required">*</span>
                            </label>
                            <div class="admin-form-help-text mb-3">
                                Masukkan angka hari (contoh: 1, 2, 3)
                            </div>
                            <input type="number"
                                   name="day"
                                   id="day"
                                   min="1"
                                   max="31"
                                   class="admin-form-control @error('day') is-invalid @enderror"
                                   value="{{ old('day') }}"
                                   placeholder="Contoh: 1">
                            @error('day')
                                <div class="admin-error-message">
                                    <i class="fas fa-exclamation-circle"></i>{{ $message }}
                                </div>
                            @enderror
                        </div>

                        {{-- Waktu --}}
                        <div class="admin-form-group">
                            <label for="time" class="admin-form-label">
                                <i class="fas fa-clock me-2"></i>Waktu
                                <span class="required">*</span>
                            </label>
                            <div class="admin-form-help-text mb-3">
                                Masukkan waktu kegiatan (format 24 jam)
                            </div>
                            <input type="time"
                                   name="time"
                                   id="time"
                                   class="admin-form-control @error('time') is-invalid @enderror"
                                   value="{{ old('time') }}">
                            @error('time')
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
                                      placeholder="Contoh: Sarapan, Perjalanan, Foto-foto" required>{{ old('detail') }}</textarea>
                            @error('detail')
                                <div class="admin-error-message">
                                    <i class="fas fa-exclamation-circle"></i>{{ $message }}
                                </div>
                            @enderror
                        </div>

                        <!-- Tombol Aksi -->
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
@endpush

@endsection

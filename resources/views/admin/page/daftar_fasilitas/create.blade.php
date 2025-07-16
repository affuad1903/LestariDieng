@extends('admin.layouts.master')

@push('styles')
<link rel="stylesheet" href="{{ asset('css/admin/admin-forms.css') }}">
@endpush

@section('icon-title')
<i class="fas fa-plus-circle"></i>
@endsection

@section('title', 'Tambah Daftar Fasilitas')

@section('content')

<!-- Flash Messages -->
@include('admin.components.flash-messages')

<div class="container-fluid px-4">
    <div class="row justify-content-center">
        <div class="col-xl-8 col-lg-10">
            <div class="card admin-form-container">
                <div class="admin-form-header">
                    <h4>
                        <i class="fas fa-concierge-bell me-2"></i>Tambah Daftar Fasilitas
                    </h4>
                </div>
                <div class="admin-form-body">
                    <form method="POST" action="{{ route('daftar-fasilitas.store') }}" enctype="multipart/form-data">
                        @csrf

                        <!-- Pilih Paket yang Sudah Ada -->
                        <div class="admin-form-group">
                            <label class="admin-form-label">
                                <i class="fas fa-box me-2"></i>Pilih Paket yang Tersedia
                                <span class="required">*</span>
                            </label>
                            <div class="admin-form-help-text mb-3">
                                Pilih paket yang akan ditambahkan fasilitas
                            </div>
                            <div class="row">
                                @forelse ($paket as $item)
                                <div class="col-md-6 col-12 mb-2">
                                    <div class="form-check admin-checkbox">
                                        <input type="checkbox" 
                                               class="form-check-input @error('paket') is-invalid @enderror"
                                               name="paket[]" 
                                               value="{{ $item->id }}"
                                               id="paket_{{ $item->id }}"
                                               {{ (is_array(old('paket')) && in_array($item->id, old('paket'))) ? 'checked' : '' }}>
                                        <label class="form-check-label" for="paket_{{ $item->id }}">
                                            {{ $item->paket_title }}
                                        </label>
                                    </div>
                                </div>
                                @empty
                                <div class="col-12">
                                    <div class="alert alert-info">
                                        <i class="fas fa-info-circle me-2"></i>
                                        Belum ada paket yang tersedia. 
                                        <a href="{{ route('paket.create') }}" class="alert-link">Tambah paket baru</a>
                                    </div>
                                </div>
                                @endforelse
                            </div>
                            @error('paket')
                                <div class="admin-error-message">
                                    <i class="fas fa-exclamation-circle"></i>{{ $message }}
                                </div>
                            @enderror
                        </div>

                        <!-- Pilih Fasilitas yang Sudah Ada -->
                        <div class="admin-form-group">
                            <label class="admin-form-label">
                                <i class="fas fa-list me-2"></i>Pilih Fasilitas yang Tersedia
                            </label>
                            <div class="admin-form-help-text mb-3">
                                Pilih fasilitas yang sudah ada (opsional)
                            </div>
                            <div class="row">
                                @forelse ($daftar_fasilitas as $item)
                                <div class="col-md-6 col-12 mb-2">
                                    <div class="form-check admin-checkbox">
                                        <input type="checkbox" 
                                               class="form-check-input"
                                               name="daftar_fasilitas[]" 
                                               value="{{ $item->id }}"
                                               id="fasilitas_{{ $item->id }}"
                                               {{ (is_array(old('daftar_fasilitas')) && in_array($item->id, old('daftar_fasilitas'))) ? 'checked' : '' }}>
                                        <label class="form-check-label" for="fasilitas_{{ $item->id }}">
                                            {{ $item->nama_fasilitas }}
                                        </label>
                                    </div>
                                </div>
                                @empty
                                <div class="col-12">
                                    <div class="alert alert-info">
                                        <i class="fas fa-info-circle me-2"></i>
                                        Belum ada fasilitas yang tersedia
                                    </div>
                                </div>
                                @endforelse
                            </div>
                        </div>

                        <hr class="admin-form-divider">

                        <!-- Tambah Fasilitas Baru -->
                        <div class="admin-form-group">
                            <label for="nama_fasilitas_baru" class="admin-form-label">
                                <i class="fas fa-plus me-2"></i>Tambah Fasilitas Baru (Opsional)
                            </label>
                            <input type="text" 
                                   name="nama_fasilitas_baru" 
                                   id="nama_fasilitas_baru"
                                   class="admin-form-control @error('nama_fasilitas_baru') is-invalid @enderror"
                                   placeholder="Contoh: Transport Shuttle, Guide Lokal"
                                   value="{{ old('nama_fasilitas_baru') }}">
                            <div class="admin-form-help-text">
                                Masukkan nama fasilitas baru, pisahkan dengan koma jika lebih dari satu
                            </div>
                            @error('nama_fasilitas_baru')
                                <div class="admin-error-message">
                                    <i class="fas fa-exclamation-circle"></i>{{ $message }}
                                </div>
                            @enderror
                        </div>

                        <!-- Submit Button -->
                        <div class="d-grid gap-2 mt-4">
                            <button type="submit" class="btn btn-register text-white">
                                <i class="fas fa-save me-2"></i>Simpan Daftar Fasilitas
                            </button>
                            <a href="{{ route('daftar-fasilitas.index') }}" class="btn btn-outline-secondary">
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

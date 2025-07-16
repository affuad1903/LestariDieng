@extends('admin.layouts.master')

@push('styles')
<link rel="stylesheet" href="{{ asset('css/admin/admin-forms.css') }}">
<link rel="stylesheet" href="{{ asset('css/admin/flash-messages.css') }}">
@endpush

@section('icon-title')
<i class="mdi mdi-pencil"></i>
@endsection

@section('title', 'Edit Daftar Destinasi')

@section('content')

<!-- Flash Messages -->
@include('admin.components.flash-messages')

<div class="row justify-content-center">
    <div class="col-xl-8 col-lg-10">
        <div class="card admin-form-container">
            <div class="admin-form-header">
                <h4>
                    <i class="mdi mdi-pencil"></i>Edit Daftar Destinasi
                </h4>
            </div>
            <div class="admin-form-body">
                <form action="{{ route('daftar-d.update', $daftar_destinasi->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    
                    <!-- Nama Destinasi -->
                    <div class="admin-form-group">
                        <label for="nama_destinasi" class="admin-form-label">
                            <i class="mdi mdi-map-marker"></i>Nama Destinasi
                            <span class="required">*</span>
                        </label>
                        <input type="text" 
                               class="admin-form-control @error('nama_destinasi') is-invalid @enderror" 
                               name="nama_destinasi" 
                               id="nama_destinasi"
                               value="{{ old('nama_destinasi', $daftar_destinasi->nama_destinasi) }}"
                               placeholder="Masukkan nama destinasi"
                               required>
                        @error('nama_destinasi')
                            <div class="admin-error-message">
                                <i class="mdi mdi-alert-circle"></i>{{ $message }}
                            </div>
                        @enderror
                    </div>

                    <!-- Pilih Paket -->
                    <div class="admin-form-group">
                        <label class="admin-form-label">
                            <i class="mdi mdi-package-variant"></i>Pilih Paket yang Tersedia
                        </label>
                        <div class="checkbox-group">
                            @forelse ($paket as $item)
                            <div class="checkbox-item">
                                <input type="checkbox" 
                                       class="form-check-input"
                                       name="paket[]" 
                                       value="{{ $item->id }}"
                                       id="paket_{{ $item->id }}"
                                       {{ $daftar_destinasi->paket && $daftar_destinasi->paket->contains('id', $item->id) ? 'checked' : '' }}>
                                <label class="form-check-label" for="paket_{{ $item->id }}">
                                    {{ $item->paket_title }}
                                </label>
                            </div>
                            @empty
                            <div class="empty-option">
                                <p class="text-muted mb-2">Belum ada paket yang tersedia</p>
                                <a href="{{ route('paket.create') }}" class="btn btn-sm btn-outline-primary">
                                    <i class="mdi mdi-plus"></i>Tambah Paket
                                </a>
                            </div>
                            @endforelse
                        </div>
                    </div>
                    
                    <!-- Submit Button -->
                    <div class="admin-form-actions">
                        <button type="submit" class="btn btn-primary btn-lg">
                            <i class="mdi mdi-content-save me-2"></i>Simpan Perubahan
                        </button>
                        <a href="{{ route('daftar-d.index') }}" class="btn btn-outline-secondary btn-lg">
                            <i class="mdi mdi-arrow-left me-2"></i>Kembali
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

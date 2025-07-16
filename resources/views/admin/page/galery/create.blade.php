@extends('admin.layouts.master')

@push('styles')
<link rel="stylesheet" href="{{ asset('css/admin/admin-forms.css') }}">
<link rel="stylesheet" href="{{ asset('css/admin/flash-messages.css') }}">
@endpush

@section('icon-title')
<i class="mdi mdi-plus-circle"></i>
@endsection

@section('title', 'Tambah Galeri Foto')

@section('content')

<!-- Flash Messages -->
@include('admin.components.flash-messages')

<div class="row justify-content-center">
    <div class="col-xl-8 col-lg-10">
        <div class="card admin-form-container">
            <div class="admin-form-header">
                <h4>
                    <i class="mdi mdi-image-plus"></i>Tambah Galeri Foto Baru
                </h4>
            </div>
            <div class="admin-form-body">
                <form method="POST" action="{{ route('galery.store') }}" enctype="multipart/form-data">
                    @csrf

                    <!-- Title -->
                    <div class="admin-form-group">
                        <label for="title" class="admin-form-label">
                            <i class="mdi mdi-format-title"></i>Judul Galeri
                            <span class="required">*</span>
                        </label>
                        <input type="text" 
                               class="admin-form-control @error('title') is-invalid @enderror" 
                               name="title" 
                               id="title"
                               value="{{ old('title') }}"
                               placeholder="Contoh: Galeri Wisata Dieng, Foto Kegiatan, dll"
                               required>
                        @error('title')
                            <div class="admin-error-message">
                                <i class="mdi mdi-alert-circle"></i>{{ $message }}
                            </div>
                        @enderror
                    </div>

                    <!-- Description -->
                    <div class="admin-form-group">
                        <label for="description" class="admin-form-label">
                            <i class="mdi mdi-text"></i>Deskripsi Galeri
                        </label>
                        <textarea class="admin-form-control @error('description') is-invalid @enderror" 
                                  name="description" 
                                  id="description"
                                  rows="4"
                                  placeholder="Masukkan deskripsi galeri (opsional)">{{ old('description') }}</textarea>
                        <small class="form-text text-muted">
                            Berikan deskripsi singkat tentang galeri foto ini
                        </small>
                        @error('description')
                            <div class="admin-error-message">
                                <i class="mdi mdi-alert-circle"></i>{{ $message }}
                            </div>
                        @enderror
                    </div>

                    <!-- Images Upload -->
                    <div class="admin-form-group">
                        <label for="images" class="admin-form-label">
                            <i class="mdi mdi-image-multiple"></i>Upload Gambar
                            <span class="required">*</span>
                        </label>
                        <div class="admin-file-upload-container">
                            <input type="file" 
                                   name="images[]" 
                                   id="images" 
                                   class="admin-file-upload-input @error('images') is-invalid @enderror @error('images.*') is-invalid @enderror"
                                   accept="image/*"
                                   multiple
                                   data-allowed-types="image/jpeg,image/png,image/gif"
                                   required>
                            <div class="admin-file-upload-icon">
                                <i class="mdi mdi-cloud-upload"></i>
                            </div>
                            <div class="admin-file-upload-label">
                                Klik atau drag & drop gambar galeri di sini
                                <br><small class="text-muted">Format: JPG, PNG, GIF - Bisa pilih lebih dari satu gambar</small>
                            </div>
                        </div>
                        @error('images')
                            <div class="admin-error-message">
                                <i class="mdi mdi-alert-circle"></i>{{ $message }}
                            </div>
                        @enderror
                        @error('images.*')
                            <div class="admin-error-message">
                                <i class="mdi mdi-alert-circle"></i>{{ $message }}
                            </div>
                        @enderror
                    </div>

                    <!-- Submit Button -->
                    <div class="admin-form-actions">
                        <button type="submit" class="btn btn-primary btn-lg">
                            <i class="mdi mdi-content-save me-2"></i>Simpan Galeri
                        </button>
                        <a href="{{ route('galery.index') }}" class="btn btn-outline-secondary btn-lg">
                            <i class="mdi mdi-arrow-left me-2"></i>Kembali
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

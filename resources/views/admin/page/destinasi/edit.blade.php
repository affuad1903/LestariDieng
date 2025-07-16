@extends('admin.layouts.master')

@push('styles')
<link rel="stylesheet" href="{{ asset('css/admin/admin-forms.css') }}">
<link rel="stylesheet" href="{{ asset('css/admin/flash-messages.css') }}">
@endpush

@section('icon-title')
<i class="mdi mdi-pencil"></i>
@endsection

@section('title', 'Edit Destinasi')

@section('content')

<!-- Flash Messages -->
@include('admin.components.flash-messages')

<div class="row justify-content-center">
    <div class="col-xl-8 col-lg-10">
        <div class="card admin-form-container">
            <div class="admin-form-header">
                <h4>
                    <i class="mdi mdi-map-marker-outline"></i>Edit Destinasi: {{ $destination->content_title }}
                </h4>
            </div>
            <div class="admin-form-body">
                <form method="POST" action="/dashboard/destinasi/{{ $destination->id }}" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    
                    <!-- Is Main Page -->
                    <div class="form-group">
                        <label for="is_main_page" class="form-label">
                            <i class="mdi mdi-home me-2"></i>Tampilkan di Halaman Utama
                        </label>
                        <select class="form-select @error('is_main_page') is-invalid @enderror" 
                                name="is_main_page" 
                                id="is_main_page" required>
                            <option value="0" {{ $destination->is_main_page == 0 ? 'selected' : '' }}>Tidak</option>
                            <option value="1" {{ $destination->is_main_page == 1 ? 'selected' : '' }}>Ya</option>
                        </select>
                        @error('is_main_page')
                            <div class="admin-error-message">
                                <i class="mdi mdi-alert-circle"></i>{{ $message }}
                            </div>
                        @enderror
                    </div>

                    <!-- Content Title -->
                    <div class="form-group">
                        <label for="content_title" class="form-label">
                            <i class="mdi mdi-format-title me-2"></i>Judul Destinasi
                        </label>
                        <input type="text" 
                               class="form-control @error('content_title') is-invalid @enderror" 
                               name="content_title" 
                               id="content_title"
                               value="{{ old('content_title', $destination->content_title) }}"
                               placeholder="Masukkan judul destinasi"
                               required>
                        @error('content_title')
                            <div class="admin-error-message">
                                <i class="mdi mdi-alert-circle"></i>{{ $message }}
                            </div>
                        @enderror
                    </div>

                    <!-- Content Summary -->
                    <div class="form-group">
                        <label for="content_summary" class="form-label">
                            <i class="mdi mdi-text me-2"></i>Deskripsi Destinasi
                        </label>
                        <textarea class="form-control @error('content_summary') is-invalid @enderror" 
                                  name="content_summary" 
                                  id="content_summary"
                                  rows="4"
                                  placeholder="Masukkan deskripsi destinasi"
                                  required>{{ old('content_summary', $destination->content_summary) }}</textarea>
                        @error('content_summary')
                            <div class="admin-error-message">
                                <i class="mdi mdi-alert-circle"></i>{{ $message }}
                            </div>
                        @enderror
                    </div>

                    <!-- Content Location Title -->
                    <div class="form-group">
                        <label for="content_location_title" class="form-label">
                            <i class="mdi mdi-map-marker me-2"></i>Nama Lokasi
                        </label>
                        <input type="text" 
                               class="form-control @error('content_location_title') is-invalid @enderror" 
                               name="content_location_title" 
                               id="content_location_title"
                               value="{{ old('content_location_title', $destination->content_location_title) }}"
                               placeholder="Masukkan nama lokasi"
                               required>
                        @error('content_location_title')
                            <div class="admin-error-message">
                                <i class="mdi mdi-alert-circle"></i>{{ $message }}
                            </div>
                        @enderror
                    </div>

                    <!-- Content Location Detail -->
                    <div class="form-group">
                        <label for="content_location_detail" class="form-label">
                            <i class="mdi mdi-map-marker-outline me-2"></i>Detail Lokasi
                        </label>
                        <textarea class="form-control @error('content_location_detail') is-invalid @enderror" 
                                  name="content_location_detail" 
                                  id="content_location_detail"
                                  rows="3"
                                  placeholder="Masukkan detail lokasi (opsional)">{{ old('content_location_detail', $destination->content_location_detail) }}</textarea>
                        <small class="form-text text-muted">Informasi tambahan seperti alamat lengkap atau petunjuk arah</small>
                        @error('content_location_detail')
                            <div class="admin-error-message">
                                <i class="mdi mdi-alert-circle"></i>{{ $message }}
                            </div>
                        @enderror
                    </div>

                    <!-- Current Image Preview -->
                    @if($destination->thumbnail_image)
                    <div class="form-group">
                        <label class="form-label">
                            <i class="mdi mdi-image-outline me-2"></i>Gambar Saat Ini
                        </label>
                        <div class="current-image-preview">
                            <img src="{{ asset('/image/destination/'.$destination->thumbnail_image) }}" 
                                 alt="{{ $destination->content_title }}" 
                                 class="img-thumbnail" 
                                 style="max-width: 300px; max-height: 200px;">
                        </div>
                    </div>
                    @endif

                    <!-- Thumbnail Image -->
                    <div class="form-group">
                        <label for="thumbnail_image" class="form-label">
                            <i class="mdi mdi-image me-2"></i>Gambar Thumbnail {{ $destination->thumbnail_image ? '(Ganti Gambar)' : '' }}
                        </label>
                        <div class="admin-file-upload-container">
                            <input type="file" 
                                   name="thumbnail_image" 
                                   id="thumbnail_image" 
                                   class="admin-file-upload-input @error('thumbnail_image') is-invalid @enderror"
                                   accept="image/*"
                                   data-max-size="2"
                                   data-allowed-types="image/jpeg,image/png,image/gif">
                            <div class="admin-file-upload-icon">
                                <i class="mdi mdi-cloud-upload"></i>
                            </div>
                            <div class="admin-file-upload-label">
                                Klik atau drag & drop gambar destinasi di sini
                                <br><small class="text-muted">Format: JPG, PNG, GIF (Max: 2MB). Kosongkan jika tidak ingin mengubah gambar</small>
                            </div>
                        </div>
                        @error('thumbnail_image')
                            <div class="admin-error-message">
                                <i class="mdi mdi-alert-circle"></i>{{ $message }}
                            </div>
                        @enderror
                    </div>

                    <!-- Form Actions -->
                    <div class="form-actions">
                        <button type="submit" class="btn btn-primary">
                            <i class="mdi mdi-content-save me-2"></i>Update Destinasi
                        </button>
                        <a href="/dashboard/destinasi" class="btn btn-secondary">
                            <i class="mdi mdi-arrow-left me-2"></i>Kembali
                        </a>
                        <a href="/dashboard/destinasi/{{ $destination->id }}" class="btn btn-info">
                            <i class="mdi mdi-eye me-2"></i>Lihat Detail
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection

@push('scripts')
<script src="{{ asset('js/admin/admin-forms.js') }}"></script>
@endpush

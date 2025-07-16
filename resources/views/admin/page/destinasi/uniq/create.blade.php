@extends('admin.layouts.master')

@push('styles')
<link rel="stylesheet" href="{{ asset('css/admin/admin-forms.css') }}">
<link rel="stylesheet" href="{{ asset('css/admin/flash-messages.css') }}">
@endpush

@section('icon-title')
<i class="mdi mdi-plus-circle"></i>
@endsection

@section('title', 'Tambah Keunikan Destinasi')

@section('content')

<!-- Flash Messages -->
@include('admin.components.flash-messages')

<div class="row justify-content-center">
    <div class="col-xl-8 col-lg-10">
        <div class="card admin-form-container">
            <div class="admin-form-header">
                <h4>
                    <i class="mdi mdi-star-circle-outline"></i>Tambah Keunikan Destinasi
                </h4>
            </div>
            <div class="admin-form-body">
                <form method="POST" action="/dashboard/destinasi/uniq" enctype="multipart/form-data">
                    @csrf
                    
                    <!-- Destination Selection -->
                    <div class="form-group">
                        <label for="destination_id" class="form-label">
                            <i class="mdi mdi-map-marker me-2"></i>Pilih Destinasi
                        </label>
                        <select class="form-select @error('destination_id') is-invalid @enderror" 
                                name="destination_id" 
                                id="destination_id" required>
                            <option value="">--- Pilih Destinasi ---</option>
                            @foreach ($destination as $item)
                                <option value="{{ $item->id }}" {{ old('destination_id') == $item->id ? 'selected' : '' }}>
                                    {{ $item->content_title }}
                                </option>
                            @endforeach
                        </select>
                        @error('destination_id')
                            <div class="admin-error-message">
                                <i class="mdi mdi-alert-circle"></i>{{ $message }}
                            </div>
                        @enderror
                    </div>

                    <!-- Unique Title -->
                    <div class="form-group">
                        <label for="uniq_title" class="form-label">
                            <i class="mdi mdi-format-title me-2"></i>Judul Keunikan
                        </label>
                        <input type="text" 
                               class="form-control @error('uniq_title') is-invalid @enderror" 
                               name="uniq_title" 
                               id="uniq_title"
                               value="{{ old('uniq_title') }}"
                               placeholder="Contoh: Letusan Kawah Aktif"
                               required>
                        @error('uniq_title')
                            <div class="admin-error-message">
                                <i class="mdi mdi-alert-circle"></i>{{ $message }}
                            </div>
                        @enderror
                    </div>

                    <!-- Unique Sub Title -->
                    <div class="form-group">
                        <label for="uniq_sub_title" class="form-label">
                            <i class="mdi mdi-format-text me-2"></i>Sub Judul (Opsional)
                        </label>
                        <input type="text" 
                               class="form-control @error('uniq_sub_title') is-invalid @enderror" 
                               name="uniq_sub_title" 
                               id="uniq_sub_title"
                               value="{{ old('uniq_sub_title') }}"
                               placeholder="Contoh: Asap & Gas Alam">
                        <small class="form-text text-muted">Boleh dikosongkan jika tidak diperlukan</small>
                        @error('uniq_sub_title')
                            <div class="admin-error-message">
                                <i class="mdi mdi-alert-circle"></i>{{ $message }}
                            </div>
                        @enderror
                    </div>

                    <!-- Unique Detail -->
                    <div class="form-group">
                        <label for="uniq_detail" class="form-label">
                            <i class="mdi mdi-text me-2"></i>Detail Keunikan
                        </label>
                        <textarea class="form-control @error('uniq_detail') is-invalid @enderror" 
                                  name="uniq_detail" 
                                  id="uniq_detail"
                                  rows="4"
                                  placeholder="Contoh: Uap putih keluar dari kawah aktif panas yang menjadi daya tarik utama..."
                                  required>{{ old('uniq_detail') }}</textarea>
                        @error('uniq_detail')
                            <div class="admin-error-message">
                                <i class="mdi mdi-alert-circle"></i>{{ $message }}
                            </div>
                        @enderror
                    </div>

                    <!-- Unique Image -->
                    <div class="form-group">
                        <label for="uniq_image" class="form-label">
                            <i class="mdi mdi-image me-2"></i>Gambar Keunikan
                        </label>
                        <div class="admin-file-upload-container">
                            <input type="file" 
                                   name="uniq_image" 
                                   id="uniq_image"
                                   class="admin-file-upload-input @error('uniq_image') is-invalid @enderror"
                                   accept="image/*"
                                   data-max-size="2"
                                   data-allowed-types="image/jpeg,image/png,image/gif"
                                   required>
                            <div class="admin-file-upload-icon">
                                <i class="mdi mdi-cloud-upload"></i>
                            </div>
                            <div class="admin-file-upload-label">
                                Klik atau drag & drop gambar keunikan di sini
                                <br><small class="text-muted">Format: JPG, PNG, GIF (Max: 2MB)</small>
                            </div>
                        </div>
                        @error('uniq_image')
                            <div class="admin-error-message">
                                <i class="mdi mdi-alert-circle"></i>{{ $message }}
                            </div>
                        @enderror
                    </div>

                    <!-- Form Actions -->
                    <div class="form-actions">
                        <button type="submit" class="btn btn-primary">
                            <i class="mdi mdi-content-save me-2"></i>Simpan Keunikan
                        </button>
                        <a href="/dashboard/destinasi" class="btn btn-secondary">
                            <i class="mdi mdi-arrow-left me-2"></i>Kembali
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
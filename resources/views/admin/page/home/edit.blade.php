@extends('admin.layouts.master')

@push('styles')
<link rel="stylesheet" href="{{ asset('css/admin/admin-forms.css') }}">
@endpush

@section('content')

<!-- Flash Messages -->
@include('admin.components.flash-messages')

<div class="container-fluid px-4">
    <div class="row justify-content-center">
        <div class="col-xl-8 col-lg-10">
            <div class="card admin-form-container">
                <div class="admin-form-header">
                    <h4>
                        <i class="fas fa-edit"></i>
                        Edit Konten Beranda
                    </h4>
                </div>
                <div class="admin-form-body">
                    <form method="POST" action="/dashboard/home/{{$home->id}}" enctype="multipart/form-data">
                        @csrf
                        @method('put')
                        
                        {{-- Title --}}
                        <div class="admin-form-group">
                            <label for="title" class="admin-form-label">
                                <i class="fas fa-heading"></i>
                                Judul Halaman
                                <span class="required">*</span>
                            </label>
                            <input type="text" 
                                   name="title" 
                                   id="title" 
                                   class="admin-form-control @error('title') is-invalid @enderror" 
                                   value="{{ old('title', $home->title) }}"
                                   placeholder="Masukkan judul halaman"
                                   maxlength="100"
                                   required>
                            @error('title')
                                <div class="admin-error-message">
                                    <i class="fas fa-exclamation-circle"></i>{{ $message }}
                                </div>
                            @enderror
                        </div>

                        {{-- Logo --}}
                        <div class="admin-form-group">
                            <label for="logo" class="admin-form-label">
                                <i class="fas fa-image"></i>
                                Logo Website
                            </label>
                            <div class="admin-file-upload-container">
                                <input type="file" 
                                       name="logo" 
                                       id="logo" 
                                       class="admin-file-upload-input @error('logo') is-invalid @enderror"
                                       accept="image/*"
                                       data-max-size="2"
                                       data-allowed-types="image/jpeg,image/png,image/svg+xml">
                                <div class="admin-file-upload-icon">
                                    <i class="fas fa-cloud-upload-alt"></i>
                                </div>
                                <div class="admin-file-upload-label">
                                    Klik atau drag & drop logo di sini
                                    <br><small class="text-muted">Format: JPG, PNG, SVG (Max: 2MB)</small>
                                </div>
                            </div>
                            @error('logo')
                                <div class="admin-error-message">
                                    <i class="fas fa-exclamation-circle"></i>{{ $message }}
                                </div>
                            @enderror
                        </div>

                        {{-- Tag Line --}}
                        <div class="admin-form-group">
                            <label for="tag_line" class="admin-form-label">
                                <i class="fas fa-quote-left"></i>
                                Slogan Website
                                <span class="required">*</span>
                            </label>
                            <input type="text" 
                                   name="tag_line" 
                                   id="tag_line" 
                                   class="admin-form-control @error('tag_line') is-invalid @enderror" 
                                   value="{{ old('tag_line', $home->tag_line) }}"
                                   placeholder="Masukkan slogan yang menarik"
                                   maxlength="150"
                                   required>
                            @error('tag_line')
                                <div class="admin-error-message">
                                    <i class="fas fa-exclamation-circle"></i>{{ $message }}
                                </div>
                            @enderror
                        </div>

                        {{-- Hero Image --}}
                        <div class="admin-form-group">
                            <label for="hero_image" class="admin-form-label">
                                <i class="fas fa-photo-video"></i>
                                Gambar Utama (Hero Image)
                            </label>
                            <div class="admin-file-upload-container">
                                <input type="file" 
                                       name="hero_image" 
                                       id="hero_image" 
                                       class="admin-file-upload-input @error('hero_image') is-invalid @enderror"
                                       accept="image/*"
                                       data-max-size="5"
                                       data-allowed-types="image/jpeg,image/png">
                                <div class="admin-file-upload-icon">
                                    <i class="fas fa-images"></i>
                                </div>
                                <div class="admin-file-upload-label">
                                    Klik atau drag & drop gambar utama di sini
                                    <br><small class="text-muted">Format: JPG, PNG (Max: 5MB)</small>
                                </div>
                            </div>
                            @error('hero_image')
                                <div class="admin-error-message">
                                    <i class="fas fa-exclamation-circle"></i>{{ $message }}
                                </div>
                            @enderror
                        </div>

                        {{-- Submit Button --}}
                        <div class="d-grid gap-2 mt-4">
                            <button type="submit" class="btn btn-register text-white">
                                <i class="fas fa-save me-2"></i>Perbarui Data
                            </button>
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
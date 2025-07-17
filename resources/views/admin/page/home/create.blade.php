@extends('admin.layouts.master')

@push('styles')
<link rel="stylesheet" href="{{ asset('css/admin/dashboard-home.css') }}">
<link rel="stylesheet" href="{{ asset('css/admin/forms.css') }}">
<link rel="stylesheet" href="{{ asset('css/admin/admin-forms.css') }}">
<link rel="stylesheet" href="{{ asset('css/admin/flash-messages.css') }}">
@endpush

@section('icon-title')
<i class="mdi mdi-plus-circle"></i>
@endsection

@section('title')Tambah Konten Beranda @endsection

@section('content')

<!-- Flash Messages -->
@include('admin.components.flash-messages')

<div class="row justify-content-center">
    <div class="col-xl-8 col-lg-10">
        <div class="card form-container">
            <div class="card-header">
                <h5 class="mb-0">
                    <i class="mdi mdi-home-plus me-2"></i>Tambah Konten Beranda
                </h5>
            </div>
            <div class="card-body">
                <form method="POST" action="/dashboard/home" enctype="multipart/form-data">
                    @csrf
                    <section class="forms-sample col-12">
                        {{-- Title --}}
                        <section class="form-group">
                            <h3 class="m-0"><label for="title">Title</label></h3>
                            <input type="text" class="form-control text-dark" name="title" id="title">
                            @error('title')
                                <div class="alert alert-danger py-0 my-1">{{ $message }}</div>
                            @enderror
                        </section>

                        {{-- Logo --}}
                        <div class="form-group">
                            <label for="logo" class="form-label">
                                <i class="mdi mdi-image me-2"></i>Logo
                            </label>
                            <div class="admin-file-upload-container">
                                <input type="file" 
                                    name="logo" 
                                    id="logo" 
                                    class="admin-file-upload-input @error('logo') is-invalid @enderror"
                                    accept="image/*"
                                    data-allowed-types="image/jpeg,image/png,image/gif"
                                    required>
                                <div class="admin-file-upload-icon">
                                    <i class="mdi mdi-cloud-upload"></i>
                                </div>
                                <div class="admin-file-upload-label">
                                    Klik atau drag & drop gambar destinasi di sini
                                    <br><small class="text-muted">Format: JPG, PNG, GIF (Max: 2MB)</small>
                                </div>
                            </div>
                            @error('logo')
                                <div class="admin-error-message">
                                    <i class="mdi mdi-alert-circle"></i>{{ $message }}
                                </div>
                            @enderror
                        </div>

                        {{-- Tag Line --}}
                        <section class="form-group">
                            <h3 class="m-0"><label for="tag_line">Tag Line</label></h3>
                            <input type="text" class="form-control text-dark" name="tag_line" id="tag_line">
                            @error('tag_line')
                                <div class="alert alert-danger py-0 my-1">{{ $message }}</div>
                            @enderror
                        </section>

                        {{-- Hero Image --}}
                        <div class="form-group">
                            <label for="hero_image" class="form-label">
                                <i class="mdi mdi-image me-2"></i>Hero Image
                            </label>
                            <div class="admin-file-upload-container">
                                <input type="file" 
                                    name="hero_image" 
                                    id="hero_image" 
                                    class="admin-file-upload-input @error('hero_image') is-invalid @enderror"
                                    accept="image/*"
                                    data-allowed-types="image/jpeg,image/png,image/gif"
                                    required>
                                <div class="admin-file-upload-icon">
                                    <i class="mdi mdi-cloud-upload"></i>
                                </div>
                                <div class="admin-file-upload-label">
                                    Klik atau drag & drop gambar destinasi di sini
                                    <br><small class="text-muted">Format: JPG, PNG, GIF (Max: 2MB)</small>
                                </div>
                            </div>
                            @error('hero_image')
                                <div class="admin-error-message">
                                    <i class="mdi mdi-alert-circle"></i>{{ $message }}
                                </div>
                            @enderror
                        </div>
                    </section>
                    {{-- Submit --}}
                    <button type="submit" class="btn btn-primary mt-3">Submit</button>
                </form>
            </div>
        </div>
    </div>
</section>
@endsection
@push('scripts')
<script src="{{ asset('js/admin/admin-forms.js') }}"></script>
@endpush
@extends('admin.layouts.master')

@push('styles')
<link rel="stylesheet" href="{{ asset('css/admin/dashboard-home.css') }}">
<link rel="stylesheet" href="{{ asset('css/admin/forms.css') }}">
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
                        <section class="form-group">
                            <h3 class="m-0"><label for="logo">Logo</label></h3>
                            <input type="file" name="logo" class="file-upload-default text-dark" id="logoUpload">
                            @error('logo')
                                <div class="alert alert-danger py-0 my-1">{{ $message }}</div>
                            @enderror
                            <div class="input-group col-xs-12">
                                <input type="text" class="form-control file-upload-info" disabled placeholder="Upload Image">
                                <span class="input-group-append">
                                    <button class="file-upload-browse btn btn-gradient-primary my-2 px-3 py-1" type="button">Upload</button>
                                </span>
                            </div>
                        </section>

                        {{-- Tag Line --}}
                        <section class="form-group">
                            <h3 class="m-0"><label for="tag_line">Tag Line</label></h3>
                            <input type="text" class="form-control text-dark" name="tag_line" id="tag_line">
                            @error('tag_line')
                                <div class="alert alert-danger py-0 my-1">{{ $message }}</div>
                            @enderror
                        </section>

                        {{-- Hero Image --}}
                        <section class="form-group">
                            <h3 class="m-0"><label for="hero_image">Hero Image</label></h3>
                            <input type="file" name="hero_image" class="file-upload-default text-dark" id="heroUpload">
                            @error('hero_image')
                                <div class="alert alert-danger py-0 my-1">{{ $message }}</div>
                            @enderror
                            <section class="input-group col-xs-12">
                                <input type="text" class="form-control file-upload-info" disabled placeholder="Upload Hero Image">
                                <span class="input-group-append">
                                    <button class="file-upload-browse btn btn-gradient-primary my-2 px-3 py-1" type="button">Upload</button>
                                </span>
                            </section>
                        </section>
                    </section>
                    {{-- Submit --}}
                    <button type="submit" class="btn btn-primary mt-3">Submit</button>
                </form>
            </div>
        </div>
    </div>
</section>
@endsection
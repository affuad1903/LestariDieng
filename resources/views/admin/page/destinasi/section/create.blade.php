@extends('admin.layouts.master')

@push('styles')
<link rel="stylesheet" href="{{ asset('css/admin/admin-forms.css') }}">
<link rel="stylesheet" href="{{ asset('css/admin/flash-messages.css') }}">
@endpush

@section('icon-title')
<i class="mdi mdi-plus-circle"></i>
@endsection

@section('title', 'Tambah Konten Tambahan')

@section('content')

<!-- Flash Messages -->
@include('admin.components.flash-messages')

<div class="row justify-content-center">
    <div class="col-xl-8 col-lg-10">
        <div class="card admin-form-container">
            <div class="admin-form-header">
                <h4>
                    <i class="mdi mdi-file-document-plus"></i>Tambah Konten Tambahan Destinasi
                </h4>
            </div>
            <div class="admin-form-body">
                <form method="POST" action="/dashboard/destinasi/section" enctype="multipart/form-data">
                    @csrf
                    
                    <!-- Destination Selection -->
                    <input type="hidden" name="destination_id" value="{{ $selected_id }}">
<p class="mb-3">
    <i class="mdi mdi-map-marker me-2"></i>
    Destinasi: <strong>{{ $destination->firstWhere('id', $selected_id)?->content_title ?? 'Tidak Ditemukan' }}</strong>
</p>


                    <!-- Title -->
                    <div class="form-group">
                        <label for="title" class="form-label">
                            <i class="mdi mdi-format-title me-2"></i>Judul Konten
                        </label>
                        <input type="text" 
                               class="form-control @error('title') is-invalid @enderror" 
                               name="title" 
                               id="title"
                               value="{{ old('title') }}"
                               placeholder="Contoh: Kelestarian Alam Wisata"
                               required>
                        @error('title')
                            <div class="admin-error-message">
                                <i class="mdi mdi-alert-circle"></i>{{ $message }}
                            </div>
                        @enderror
                    </div>

                    <!-- Detail -->
                    <div class="form-group">
                        <label for="detail" class="form-label">
                            <i class="mdi mdi-text me-2"></i>Detail Konten
                        </label>
                        <textarea class="form-control @error('detail') is-invalid @enderror" 
                                  name="detail" 
                                  id="detail"
                                  rows="6"
                                  placeholder="Masukkan detail konten tambahan"
                                  required>{{ old('detail') }}</textarea>
                        @error('detail')
                            <div class="admin-error-message">
                                <i class="mdi mdi-alert-circle"></i>{{ $message }}
                            </div>
                        @enderror
                    </div>

                    {{-- Submit Button --}}
                    <div class="d-grid gap-2 mt-4">
                        <button type="submit" class="btn btn-register text-white">
                            <i class="fas fa-save me-2"></i>Simpan Data
                        </button>
                        <a href="/dashboard/paket" class="btn btn-outline-secondary">
                            <i class="fas fa-arrow-left me-2"></i>Kembali
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection
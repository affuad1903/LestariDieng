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

                    <!-- Form Actions -->
                    <div class="form-actions">
                        <button type="submit" class="btn btn-primary">
                            <i class="mdi mdi-content-save me-2"></i>Simpan Konten
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
@extends('admin.layouts.master')

@push('styles')
<link rel="stylesheet" href="{{ asset('css/admin/admin-forms.css') }}">
@endpush

@section('content')
<div class="container-fluid px-4">
    <div class="row justify-content-center">
        <div class="col-xl-8 col-lg-10">
            <div class="card admin-form-container">
                <div class="admin-form-header">
                    <h4>
                        <i class="fas fa-plus-circle"></i>
                        Tambah Legalitas
                    </h4>
                </div>
                <div class="admin-form-body">
                    <form method="POST" action="/dashboard/home/legality" enctype="multipart/form-data">
                        @csrf
                        
                        {{-- Type --}}
                        <div class="admin-form-group">
                            <label for="type" class="admin-form-label">
                                <i class="fas fa-certificate"></i>
                                Tipe Legalitas
                                <span class="required">*</span>
                            </label>
                            <input type="text" 
                                   name="type" 
                                   id="type" 
                                   class="admin-form-control @error('type') is-invalid @enderror" 
                                   value="{{ old('type') }}"
                                   placeholder="Contoh: NPWP, SIUP, NIB"
                                   maxlength="50"
                                   required>
                            @error('type')
                                <div class="admin-error-message">
                                    <i class="fas fa-exclamation-circle"></i>{{ $message }}
                                </div>
                            @enderror
                        </div>

                        {{-- Number --}}
                        <div class="admin-form-group">
                            <label for="number" class="admin-form-label">
                                <i class="fas fa-hashtag"></i>
                                Nomor Legalitas
                                <span class="required">*</span>
                            </label>
                            <input type="text" 
                                   name="number" 
                                   id="number" 
                                   class="admin-form-control @error('number') is-invalid @enderror" 
                                   value="{{ old('number') }}"
                                   placeholder="Contoh: 222.22.222.2-123.456"
                                   maxlength="100"
                                   required>
                            @error('number')
                                <div class="admin-error-message">
                                    <i class="fas fa-exclamation-circle"></i>{{ $message }}
                                </div>
                            @enderror
                        </div>

                        {{-- Submit Button --}}
                        <div class="d-grid gap-2 mt-4">
                            <button type="submit" class="btn btn-register text-white">
                                <i class="fas fa-save me-2"></i>Simpan Data
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
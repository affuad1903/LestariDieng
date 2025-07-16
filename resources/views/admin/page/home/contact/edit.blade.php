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
                        <i class="fas fa-edit"></i>
                        Edit Kontak
                    </h4>
                </div>
                <div class="admin-form-body">
                    <form method="POST" action="/dashboard/home/contact/{{$contact->id}}" enctype="multipart/form-data">
                        @csrf
                        @method('put')
                        
                        {{-- Platform --}}
                        <div class="admin-form-group">
                            <label for="platform" class="admin-form-label">
                                <i class="fas fa-share-alt"></i>
                                Platform Kontak
                                <span class="required">*</span>
                            </label>
                            <input type="text" 
                                   name="platform" 
                                   id="platform" 
                                   class="admin-form-control @error('platform') is-invalid @enderror" 
                                   value="{{ old('platform', $contact->platform) }}"
                                   placeholder="Contoh: WhatsApp, Email, Telepon"
                                   maxlength="50"
                                   required>
                            @error('platform')
                                <div class="admin-error-message">
                                    <i class="fas fa-exclamation-circle"></i>{{ $message }}
                                </div>
                            @enderror
                        </div>

                        {{-- URL --}}
                        <div class="admin-form-group">
                            <label for="url" class="admin-form-label">
                                <i class="fas fa-link"></i>
                                Link Kontak
                            </label>
                            <input type="url" 
                                   name="url" 
                                   id="url" 
                                   class="admin-form-control @error('url') is-invalid @enderror" 
                                   value="{{ old('url', $contact->url) }}"
                                   placeholder="https://wa.me/628123456789 atau mailto:contact@example.com"
                                   maxlength="255">
                            @error('url')
                                <div class="admin-error-message">
                                    <i class="fas fa-exclamation-circle"></i>{{ $message }}
                                </div>
                            @enderror
                        </div>
                        
                        {{-- Detail --}}
                        <div class="admin-form-group">
                            <label for="detail" class="admin-form-label">
                                <i class="fas fa-info-circle"></i>
                                Detail Kontak
                                <span class="required">*</span>
                            </label>
                            <input type="text" 
                                   name="detail" 
                                   id="detail" 
                                   class="admin-form-control @error('detail') is-invalid @enderror" 
                                   value="{{ old('detail', $contact->detail) }}"
                                   placeholder="085159466573 atau contact@example.com"
                                   maxlength="100"
                                   required>
                            @error('detail')
                                <div class="admin-error-message">
                                    <i class="fas fa-exclamation-circle"></i>{{ $message }}
                                </div>
                            @enderror
                        </div>

                        {{-- Icon --}}
                        <div class="admin-form-group">
                            <label for="icon" class="admin-form-label">
                                <i class="fas fa-icons"></i>
                                Ikon Kontak
                                <span class="required">*</span>
                            </label>
                            <select name="icon" 
                                    id="icon"
                                    class="admin-form-select @error('icon') is-invalid @enderror"
                                    required>
                                <option value="">----- Pilih Ikon Platform -----</option>
                                <option value="ri-whatsapp-line" {{ old('icon', $contact->icon) == 'ri-whatsapp-line' ? 'selected' : '' }}>WhatsApp</option>
                                <option value="ri-mail-line" {{ old('icon', $contact->icon) == 'ri-mail-line' ? 'selected' : '' }}>Email</option>
                                <option value="ri-phone-line" {{ old('icon', $contact->icon) == 'ri-phone-line' ? 'selected' : '' }}>Telepon</option>
                                <option value="ri-map-pin-line" {{ old('icon', $contact->icon) == 'ri-map-pin-line' ? 'selected' : '' }}>Alamat</option>
                                <option value="ri-global-line" {{ old('icon', $contact->icon) == 'ri-global-line' ? 'selected' : '' }}>Website</option>
                            </select>
                            @error('icon')
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
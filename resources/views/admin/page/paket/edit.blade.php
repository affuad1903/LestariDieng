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
                        <i class="fas fa-edit"></i>Edit Paket
                    </h4>
                </div>
                <div class="admin-form-body">
                    <form method="POST" action="/dashboard/paket/{{$paket->id}}" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        
                        {{-- Is Main Page --}}
                        <div class="admin-form-group">
                            <label for="is_main_page" class="admin-form-label">
                                <i class="fas fa-home"></i>Tampilkan di Halaman Utama
                                <span class="required">*</span>
                            </label>
                            <select class="admin-form-control @error('is_main_page') is-invalid @enderror" name="is_main_page" id="is_main_page" required>
                                <option value="0" {{ $paket->is_main_page == 0 ? 'selected' : '' }}>Tidak</option>
                                <option value="1" {{ $paket->is_main_page == 1 ? 'selected' : '' }}>Ya</option>
                            </select>
                            @error('is_main_page')
                                <div class="admin-error-message">
                                    <i class="fas fa-exclamation-circle"></i>{{ $message }}
                                </div>
                            @enderror
                        </div>

                        {{-- Paket Title --}}
                        <div class="admin-form-group">
                            <label for="paket_title" class="admin-form-label">
                                <i class="fas fa-heading"></i>Judul Paket
                                <span class="required">*</span>
                            </label>
                            <input type="text" 
                                   class="admin-form-control @error('paket_title') is-invalid @enderror" 
                                   name="paket_title" 
                                   id="paket_title" 
                                   value="{{ old('paket_title', $paket->paket_title) }}"
                                   placeholder="Masukkan judul paket"
                                   maxlength="100"
                                   required>
                            @error('paket_title')
                                <div class="admin-error-message">
                                    <i class="fas fa-exclamation-circle"></i>{{ $message }}
                                </div>
                            @enderror
                        </div>

                        {{-- Paket SubTitle Date --}}
                        <div class="admin-form-group">
                            <label for="paket_sub_title_date" class="admin-form-label">
                                <i class="fas fa-clock"></i>Waktu Durasi Paket
                                <span class="required">*</span>
                            </label>
                            <input type="text" 
                                   class="admin-form-control @error('paket_sub_title_date') is-invalid @enderror" 
                                   name="paket_sub_title_date" 
                                   id="paket_sub_title_date" 
                                   value="{{ old('paket_sub_title_date', $paket->paket_sub_title_date) }}"
                                   placeholder="Contoh: 3 Hari 2 Malam"
                                   maxlength="50"
                                   required>
                            @error('paket_sub_title_date')
                                <div class="admin-error-message">
                                    <i class="fas fa-exclamation-circle"></i>{{ $message }}
                                </div>
                            @enderror
                        </div>

                        {{-- Paket Price --}}
                        <div class="admin-form-group">
                            <label for="paket_price" class="admin-form-label">
                                <i class="fas fa-dollar-sign"></i>Harga Paket
                                <span class="required">*</span>
                            </label>
                            <div class="input-group">
                                <span class="input-group-text">Rp</span>
                                <input type="number" 
                                       class="admin-form-control @error('paket_price') is-invalid @enderror" 
                                       name="paket_price" 
                                       id="paket_price" 
                                       value="{{ old('paket_price', $paket->paket_price) }}"
                                       placeholder="0"
                                       min="0"
                                       required>
                            </div>
                            <div class="admin-form-help-text">
                                Masukkan harga dalam Rupiah tanpa titik atau koma
                            </div>
                            @error('paket_price')
                                <div class="admin-error-message">
                                    <i class="fas fa-exclamation-circle"></i>{{ $message }}
                                </div>
                            @enderror
                        </div>

                        {{-- Paket Detail --}}
                        <div class="admin-form-group">
                            <label for="paket_detail" class="admin-form-label">
                                <i class="fas fa-users"></i>Detail Jumlah Peserta Paket
                            </label>
                            <input type="text" 
                                   class="admin-form-control @error('paket_detail') is-invalid @enderror" 
                                   name="paket_detail" 
                                   id="paket_detail" 
                                   value="{{ old('paket_detail', $paket->paket_detail) }}"
                                   placeholder="Contoh: 4-6 orang per grup"
                                   maxlength="100">
                            <div class="admin-form-help-text">
                                Opsional - Jelaskan kapasitas atau detail peserta
                            </div>
                            @error('paket_detail')
                                <div class="admin-error-message">
                                    <i class="fas fa-exclamation-circle"></i>{{ $message }}
                                </div>
                            @enderror
                        </div>

                        {{-- Paket Image --}}
                        <div class="admin-form-group">
                            <label for="paket_image" class="admin-form-label">
                                <i class="fas fa-image"></i>Gambar Utama Paket
                            </label>
                            @if ($paket->paket_image)
                                <div class="current-image mb-3">
                                    <img src="{{ asset('image/paket/' . $paket->paket_image) }}" 
                                         alt="Current paket image" 
                                         class="img-thumbnail" 
                                         style="max-width: 200px;">
                                    <small class="d-block text-muted mt-1">Gambar saat ini</small>
                                </div>
                            @endif
                            <div class="admin-file-upload-container">
                                <input type="file" 
                                       name="paket_image" 
                                       id="paket_image" 
                                       class="admin-file-upload-input @error('paket_image') is-invalid @enderror"
                                       accept="image/*"
                                       data-max-size="5"
                                       data-allowed-types="image/jpeg,image/png">
                                <div class="admin-file-upload-icon">
                                    <i class="fas fa-cloud-upload-alt"></i>
                                </div>
                                <div class="admin-file-upload-label">
                                    Klik atau drag & drop gambar baru di sini
                                    <br><small class="text-muted">Format: JPG, PNG (Max: 5MB) - Kosongkan jika tidak ingin mengubah</small>
                                </div>
                            </div>
                            @error('paket_image')
                                <div class="admin-error-message">
                                    <i class="fas fa-exclamation-circle"></i>{{ $message }}
                                </div>
                            @enderror
                        </div>

                        <hr class="admin-form-divider">

                        {{-- Pilih Destinasi --}}
                        <div class="admin-form-group">
                            <label class="admin-form-label">
                                <i class="fas fa-map-marker-alt me-2"></i>Pilih Destinasi yang Tersedia
                            </label>
                            <div class="admin-form-help-text mb-3">
                                Pilih satu atau lebih destinasi yang akan dimasukkan dalam paket ini
                            </div>
                            
                            @if(count($daftar_destinasi) > 0)
                                <div class="checkbox-grid">
                                    @foreach ($daftar_destinasi as $item)
                                        <div class="checkbox-item">
                                            <div class="custom-checkbox">
                                                <input type="checkbox" 
                                                       class="checkbox-input"
                                                       name="daftar_destinasi[]" 
                                                       value="{{ $item->id }}"
                                                       id="destinasi_{{ $item->id }}"
                                                       {{ $paket->daftar_destinasi->contains('id', $item->id) ? 'checked' : '' }}>
                                                <label class="checkbox-label" for="destinasi_{{ $item->id }}">
                                                    <span class="checkbox-custom"></span>
                                                    <span class="checkbox-text">
                                                        <i class="fas fa-check me-2 text-success"></i>
                                                        {{ $item->nama_destinasi }}
                                                    </span>
                                                </label>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            @else
                                <div class="alert alert-light text-center">
                                    <i class="fas fa-info-circle text-muted mb-2" style="font-size: 2rem;"></i>
                                    <p class="text-muted mb-0">Belum ada destinasi yang tersedia</p>
                                </div>
                            @endif
                        </div>

                        <div class="divider my-4">
                            <span class="divider-text">ATAU</span>
                        </div>

                        {{-- Tambah Destinasi Baru --}}
                        <div class="admin-form-group">
                            <label for="nama_destinasi_baru" class="admin-form-label">
                                <i class="fas fa-plus-circle me-2"></i>Tambah Destinasi Baru (Opsional)
                            </label>
                            <div class="admin-form-help-text mb-3">
                                Masukkan nama destinasi baru yang ingin ditambahkan ke paket ini
                            </div>
                            <input type="text" 
                                   name="nama_destinasi_baru" 
                                   id="nama_destinasi_baru"
                                   class="admin-form-control" 
                                   placeholder="Contoh: Candi Dieng, Telaga Warna, Sikunir">
                            <div class="admin-form-help-text mt-2">
                                <i class="fas fa-lightbulb text-warning me-1"></i>
                                Pisahkan dengan koma jika ingin menambah lebih dari satu destinasi
                            </div>
                        </div>

                        <hr class="admin-form-divider">

                        {{-- Pilih Fasilitas --}}
                        <div class="admin-form-group">
                            <label class="admin-form-label">
                                <i class="fas fa-concierge-bell me-2"></i>Pilih Fasilitas yang Tersedia
                            </label>
                            <div class="admin-form-help-text mb-3">
                                Pilih fasilitas yang disediakan dalam paket ini
                            </div>
                            
                            @if(count($daftar_fasilitas) > 0)
                                <div class="checkbox-grid">
                                    @foreach ($daftar_fasilitas as $item)
                                        <div class="checkbox-item">
                                            <div class="custom-checkbox">
                                                <input type="checkbox" 
                                                       class="checkbox-input"
                                                       name="daftar_fasilitas[]" 
                                                       value="{{ $item->id }}"
                                                       id="fasilitas_{{ $item->id }}"
                                                       {{ $paket->daftar_fasilitas->contains('id', $item->id) ? 'checked' : '' }}>
                                                <label class="checkbox-label" for="fasilitas_{{ $item->id }}">
                                                    <span class="checkbox-custom"></span>
                                                    <span class="checkbox-text">
                                                        <i class="fas fa-check me-2 text-success"></i>
                                                        {{ $item->nama_fasilitas }}
                                                    </span>
                                                </label>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            @else
                                <div class="alert alert-light text-center">
                                    <i class="fas fa-info-circle text-muted mb-2" style="font-size: 2rem;"></i>
                                    <p class="text-muted mb-0">Belum ada fasilitas yang tersedia</p>
                                </div>
                            @endif
                        </div>

                        <div class="divider my-4">
                            <span class="divider-text">ATAU</span>
                        </div>

                        {{-- Tambah Fasilitas Baru --}}
                        <div class="admin-form-group">
                            <label for="nama_fasilitas_baru" class="admin-form-label">
                                <i class="fas fa-plus-circle me-2"></i>Tambah Fasilitas Baru (Opsional)
                            </label>
                            <div class="admin-form-help-text mb-3">
                                Masukkan nama fasilitas baru yang ingin ditambahkan ke paket ini
                            </div>
                            <input type="text" 
                                   name="nama_fasilitas_baru" 
                                   id="nama_fasilitas_baru"
                                   class="admin-form-control" 
                                   placeholder="Contoh: Transport shuttle, Guide Lokal">
                            <div class="admin-form-help-text mt-2">
                                <i class="fas fa-lightbulb text-warning me-1"></i>
                                Pisahkan dengan koma jika ingin menambah lebih dari satu fasilitas
                            </div>
                        </div>

                        {{-- Submit Button --}}
                        <div class="d-grid gap-2 mt-4">
                            <button type="submit" class="btn btn-register text-white">
                                <i class="fas fa-save me-2"></i>Perbarui Paket
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
</div>

@push('scripts')
<script src="{{ asset('js/admin/admin-forms.js') }}"></script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Enhanced checkbox interactions
    const checkboxes = document.querySelectorAll('.checkbox-input');
    
    checkboxes.forEach(checkbox => {
        checkbox.addEventListener('change', function() {
            const item = this.closest('.checkbox-item');
            if (this.checked) {
                item.classList.add('selected');
            } else {
                item.classList.remove('selected');
            }
        });
    });
    
    // Initialize already checked items
    checkboxes.forEach(checkbox => {
        if (checkbox.checked) {
            checkbox.closest('.checkbox-item').classList.add('selected');
        }
    });
});
</script>
@endpush
@endsection

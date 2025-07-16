@extends('admin.layouts.master')

@push('styles')
<link rel="stylesheet" href="{{ asset('css/admin/admin-forms.css') }}">
@endpush

@section('icon-title')
<i class="fas fa-concierge-bell"></i>
@endsection

@section('title', 'Tambah Fasilitas ke Paket')

@section('content')

<!-- Flash Messages -->
@include('admin.components.flash-messages')

<div class="container-fluid px-4">
    <div class="row justify-content-center">
        <div class="col-xl-8 col-lg-10">
            <div class="card admin-form-container">
                <div class="admin-form-header">
                    <h4>
                        <i class="fas fa-concierge-bell me-2"></i>Tambah Fasilitas ke Paket
                    </h4>
                </div>
                <div class="admin-form-body">
                    <!-- Info Paket Terpilih -->
                    <div class="selected-package-info mb-4">
                        <div class="alert alert-success border-left-success">
                            <div class="d-flex align-items-center">
                                <i class="fas fa-box fa-2x text-success me-3"></i>
                                <div>
                                    <h5 class="mb-1 text-success">Paket Terpilih</h5>
                                    <p class="mb-0 text-dark fw-bold">{{ $selected_paket->paket_title }}</p>
                                    <small class="text-muted">{{ $selected_paket->paket_sub_title_date }}</small>
                                </div>
                            </div>
                        </div>
                    </div>

                    <form method="POST" action="{{ route('daftar-fasilitas.store') }}" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="is_synchronized" value="1">
                        <input type="hidden" name="paket[]" value="{{ $selected_paket->id }}">
                        
                        <!-- Pilih Fasilitas yang Sudah Ada -->
                        <div class="admin-form-group">
                            <label class="admin-form-label">
                                <i class="fas fa-list-check me-2"></i>Pilih Fasilitas yang Tersedia
                            </label>
                            <div class="admin-form-help-text mb-3">
                                Pilih fasilitas yang sudah ada untuk ditambahkan ke paket ini (opsional)
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
                                                       {{ (is_array(old('daftar_fasilitas')) && in_array($item->id, old('daftar_fasilitas'))) ? 'checked' : '' }}>
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
                                    <p class="text-muted mb-0">Belum ada fasilitas yang tersedia untuk dipilih</p>
                                </div>
                            @endif
                        </div>

                        <div class="divider my-4">
                            <span class="divider-text">ATAU</span>
                        </div>

                        <!-- Tambah Fasilitas Baru -->
                        <div class="admin-form-group">
                            <label for="nama_fasilitas_baru" class="admin-form-label">
                                <i class="fas fa-plus-circle me-2"></i>Tambah Fasilitas Baru
                            </label>
                            <div class="admin-form-help-text mb-3">
                                Masukkan nama fasilitas baru yang ingin ditambahkan ke paket ini
                            </div>
                            <input type="text" 
                                   class="admin-form-control @error('nama_fasilitas_baru') is-invalid @enderror" 
                                   name="nama_fasilitas_baru" 
                                   id="nama_fasilitas_baru"
                                   value="{{ old('nama_fasilitas_baru') }}"
                                   placeholder="Contoh: Transportasi AC, Makan 3x, Guide Lokal">
                            <div class="admin-form-help-text mt-2">
                                <i class="fas fa-lightbulb text-warning me-1"></i>
                                Pisahkan dengan koma jika ingin menambahkan lebih dari satu fasilitas
                            </div>
                            @error('nama_fasilitas_baru')
                                <div class="admin-error-message">
                                    <i class="fas fa-exclamation-circle"></i>{{ $message }}
                                </div>
                            @enderror
                        </div>
                        
                        <!-- Submit Buttons -->
                        <div class="form-actions mt-4">
                            <div class="d-flex gap-3 justify-content-between flex-wrap">
                                <a href="{{ route('paket.show', $selected_paket->id) }}" class="btn btn-outline-secondary">
                                    <i class="fas fa-arrow-left me-2"></i>Kembali ke Detail Paket
                                </a>
                                <button type="submit" class="btn btn-register text-white">
                                    <i class="fas fa-save me-2"></i>Simpan Fasilitas ke Paket
                                </button>
                            </div>
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
    
    // Form validation
    const form = document.querySelector('form');
    form.addEventListener('submit', function(e) {
        const hasSelectedFasilitas = document.querySelectorAll('input[name="daftar_fasilitas[]"]:checked').length > 0;
        const hasNewFasilitas = document.getElementById('nama_fasilitas_baru').value.trim() !== '';
        
        if (!hasSelectedFasilitas && !hasNewFasilitas) {
            e.preventDefault();
            alert('Pilih fasilitas yang sudah ada atau tambahkan fasilitas baru!');
            return false;
        }
    });
});
</script>
@endpush
@endsection

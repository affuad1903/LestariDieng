@extends('admin.layouts.master')

@push('styles')
<link rel="stylesheet" href="{{ asset('css/admin/admin-forms.css') }}">
<link rel="stylesheet" href="{{ asset('css/admin/dashboard-home.css') }}">
@endpush

@section('icon-title')
<i class="fas fa-eye"></i>
@endsection

@section('title', 'Detail Paket')

@section('content')

<!-- Flash Messages -->
@include('admin.components.flash-messages')

<div class="container-fluid px-4">
    <div class="row">
        <!-- Main Content -->
        <div class="col-lg-8 mb-4">
            <!-- Package Header Card -->
            <div class="card admin-form-container mb-4">
                <div class="admin-form-header">
                    <h4>
                        <i class="fas fa-box me-2"></i>{{ $paket->paket_title }}
                    </h4>
                </div>
                <div class="admin-form-body">
                    <div class="row">
                        <!-- Package Image -->
                        <div class="col-md-6 mb-4">
                            <div class="text-center">
                                <img src="{{ asset('image/paket/'.$paket->paket_image) }}" 
                                     class="img-fluid rounded shadow-sm"
                                     alt="{{ $paket->paket_title }}" 
                                     style="max-width: 100%; height: auto; max-height: 300px;">
                            </div>
                        </div>
                        
                        <!-- Package Info -->
                        <div class="col-md-6">
                            <div class="info-item mb-3">
                                <label class="admin-form-label">
                                    <i class="fas fa-clock me-2"></i>Durasi
                                </label>
                                <p class="info-value">{{ $paket->paket_sub_title_date }}</p>
                            </div>
                            
                            <div class="info-item mb-3">
                                <label class="admin-form-label">
                                    <i class="fas fa-dollar-sign me-2"></i>Harga
                                </label>
                                <p class="info-value text-success fw-bold">
                                    Rp {{ number_format($paket->paket_price, 0, ',', '.') }}
                                </p>
                            </div>
                            
                            @if($paket->paket_detail)
                            <div class="info-item mb-3">
                                <label class="admin-form-label">
                                    <i class="fas fa-users me-2"></i>Detail Peserta
                                </label>
                                <p class="info-value">{{ $paket->paket_detail }}</p>
                            </div>
                            @endif
                            
                            <div class="info-item mb-3">
                                <label class="admin-form-label">
                                    <i class="fas fa-home me-2"></i>Tampil di Halaman Utama
                                </label>
                                <p class="info-value">
                                    @if($paket->is_main_page)
                                        <span class="badge bg-success">Ya</span>
                                    @else
                                        <span class="badge bg-secondary">Tidak</span>
                                    @endif
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Package Details Card -->
            <div class="card admin-form-container">
                <div class="admin-form-header">
                    <h4>
                        <i class="fas fa-info-circle me-2"></i>Detail Paket
                    </h4>
                </div>
                <div class="admin-form-body">
                    <!-- Destinasi Section -->
                    <div class="detail-section mb-4">
                        <div class="toggle-btn d-flex justify-content-between align-items-center p-3 bg-light rounded cursor-pointer">
                            <h5 class="mb-0">
                                <i class="fas fa-map-marker-alt me-2 text-primary"></i>Daftar Destinasi
                                <span class="badge bg-primary ms-2">{{ count($paket->daftar_destinasi) }}</span>
                            </h5>
                            <i class="fas fa-chevron-down toggle-icon"></i>
                        </div>
                        <div class="toggle-content">
                            @forelse ($paket->daftar_destinasi as $item)
                                <div class="list-item d-flex align-items-center p-2">
                                    <i class="fas fa-map-pin me-2 text-primary"></i>
                                    <span>{{ $item->nama_destinasi }}</span>
                                </div>
                            @empty
                                <div class="empty-state text-center p-4">
                                    <i class="fas fa-map-marker-alt text-muted mb-2" style="font-size: 2rem;"></i>
                                    <p class="text-muted mb-3">Belum ada destinasi yang ditambahkan</p>
                                    <a href="{{ route('daftar-d.create', ['paket_id' => $paket->id]) }}" class="btn btn-outline-primary btn-sm">
                                        <i class="fas fa-plus me-1"></i>Tambah Destinasi
                                    </a>
                                </div>
                            @endforelse
                        </div>
                    </div>

                    <!-- Fasilitas Section -->
                    <div class="detail-section mb-4">
                        <div class="toggle-btn d-flex justify-content-between align-items-center p-3 bg-light rounded cursor-pointer">
                            <h5 class="mb-0">
                                <i class="fas fa-concierge-bell me-2 text-success"></i>Daftar Fasilitas
                                <span class="badge bg-success ms-2">{{ count($paket->daftar_fasilitas) }}</span>
                            </h5>
                            <i class="fas fa-chevron-down toggle-icon"></i>
                        </div>
                        <div class="toggle-content">
                            @forelse ($paket->daftar_fasilitas as $item)
                                <div class="list-item d-flex align-items-center p-2">
                                    <i class="fas fa-check me-2 text-success"></i>
                                    <span>{{ $item->nama_fasilitas }}</span>
                                </div>
                            @empty
                                <div class="empty-state text-center p-4">
                                    <i class="fas fa-concierge-bell text-muted mb-2" style="font-size: 2rem;"></i>
                                    <p class="text-muted mb-3">Belum ada fasilitas yang ditambahkan</p>
                                    <a href="{{ route('daftar-fasilitas.create', ['paket_id' => $paket->id]) }}" class="btn btn-outline-success btn-sm">
                                        <i class="fas fa-plus me-1"></i>Tambah Fasilitas
                                    </a>
                                </div>
                            @endforelse
                        </div>
                    </div>

                    <!-- Itinerary Section -->
                    <div class="detail-section mb-4">
                        <div class="toggle-btn d-flex justify-content-between align-items-center p-3 bg-light rounded cursor-pointer">
                            <h5 class="mb-0">
                                <i class="fas fa-calendar-alt me-2 text-warning"></i>Daftar Itinerary
                                <span class="badge bg-warning ms-2">{{ count($paket->detailItinerary) }}</span>
                            </h5>
                            <i class="fas fa-chevron-down toggle-icon"></i>
                        </div>
                        <div class="toggle-content">
                            @forelse ($paket->detailItinerary as $item)
                                <div class="list-item d-flex align-items-start p-3 border-bottom">
                                    <i class="fas fa-clock me-2 text-warning mt-1"></i>
                                    <div>
                                        <strong class="text-dark">{{ $item->dayItinerary->nama_hari ?? 'Hari tidak diset' }}</strong>
                                        <span class="text-muted">- {{ \Carbon\Carbon::parse($item->timeItinerary->waktu ?? '00:00')->format('H:i') }}</span>
                                        <p class="mb-0 mt-1">{{ $item->detail }}</p>
                                    </div>
                                </div>
                            @empty
                                <div class="empty-state text-center p-4">
                                    <i class="fas fa-calendar-alt text-muted mb-2" style="font-size: 2rem;"></i>
                                    <p class="text-muted mb-3">Belum ada itinerary yang ditambahkan</p>
                                    <a href="{{ route('detail-itinerary.create', ['paket_id' => $paket->id]) }}" class="btn btn-outline-warning btn-sm">
                                        <i class="fas fa-plus me-1"></i>Tambah Itinerary
                                    </a>
                                </div>
                            @endforelse
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Sidebar -->
        <div class="col-lg-4">
            <!-- Quick Actions Card -->
            <div class="card admin-form-container mb-4">
                <div class="admin-form-header">
                    <h4>
                        <i class="fas fa-tools me-2"></i>Aksi Cepat
                    </h4>
                </div>
                <div class="admin-form-body">
                    <div class="d-grid gap-2">
                        <a href="{{ route('paket.edit', $paket->id) }}" class="btn btn-register text-white">
                            <i class="fas fa-edit me-2"></i>Edit Paket
                        </a>
                        <a href="/dashboard/paket" class="btn btn-outline-secondary">
                            <i class="fas fa-arrow-left me-2"></i>Kembali ke Daftar
                        </a>
                    </div>
                </div>
            </div>

            <!-- Package Statistics Card -->
            <div class="card admin-form-container mb-4">
                <div class="admin-form-header">
                    <h4>
                        <i class="fas fa-chart-bar me-2"></i>Statistik Paket
                    </h4>
                </div>
                <div class="admin-form-body">
                    <div class="stats-item d-flex justify-content-between align-items-center mb-3">
                        <span><i class="fas fa-map-marker-alt me-2 text-primary"></i>Destinasi</span>
                        <span class="badge bg-primary">{{ count($paket->daftar_destinasi) }}</span>
                    </div>
                    <div class="stats-item d-flex justify-content-between align-items-center mb-3">
                        <span><i class="fas fa-concierge-bell me-2 text-success"></i>Fasilitas</span>
                        <span class="badge bg-success">{{ count($paket->daftar_fasilitas) }}</span>
                    </div>
                    <div class="stats-item d-flex justify-content-between align-items-center mb-3">
                        <span><i class="fas fa-calendar-alt me-2 text-warning"></i>Itinerary</span>
                        <span class="badge bg-warning">{{ count($paket->detailItinerary) }}</span>
                    </div>
                    <hr>
                    <div class="stats-item d-flex justify-content-between align-items-center">
                        <span><i class="fas fa-clock me-2 text-info"></i>Dibuat</span>
                        <small class="text-muted">{{ $paket->created_at->format('d M Y') }}</small>
                    </div>
                </div>
            </div>

            <!-- Quick Links Card -->
            <div class="card admin-form-container">
                <div class="admin-form-header">
                    <h4>
                        <i class="fas fa-link me-2"></i>Tautan Cepat
                    </h4>
                </div>
                <div class="admin-form-body">
                    <div class="d-grid gap-2">
                        <a href="{{ route('daftar-d.create', ['paket_id' => $paket->id]) }}" class="btn btn-outline-primary btn-sm">
                            <i class="fas fa-plus me-1"></i>Tambah Destinasi
                        </a>
                        <a href="{{ route('daftar-fasilitas.create', ['paket_id' => $paket->id]) }}" class="btn btn-outline-success btn-sm">
                            <i class="fas fa-plus me-1"></i>Tambah Fasilitas
                        </a>
                        <a href="{{ route('detail-itinerary.create', ['paket_id' => $paket->id]) }}" class="btn btn-outline-warning btn-sm">
                            <i class="fas fa-plus me-1"></i>Tambah Itinerary
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script src="{{ asset('js/admin/paket-show.js') }}"></script>
@endpush
@endsection

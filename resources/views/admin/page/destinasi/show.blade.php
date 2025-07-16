@extends('admin.layouts.master')

@push('styles')
<link rel="stylesheet" href="{{ asset('css/admin/dashboard-home.css') }}">
<link rel="stylesheet" href="{{ asset('css/admin/flash-messages.css') }}">
@endpush

@section('icon-title')
<i class="mdi mdi-eye"></i>
@endsection

@section('title', 'Detail Destinasi')

@section('content')

<!-- Flash Messages -->
@include('admin.components.flash-messages')

<!-- Destination Header -->
<div class="card mb-4">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h5 class="mb-0">
            <i class="mdi mdi-map-marker me-2"></i>{{ $destination->content_title }}
        </h5>
        <div class="action-buttons">
            <a href="/dashboard/destinasi/{{ $destination->id }}/edit" class="btn btn-primary btn-sm">
                <i class="mdi mdi-pencil me-1"></i>Edit
            </a>
            <a href="/dashboard/destinasi" class="btn btn-secondary btn-sm">
                <i class="mdi mdi-arrow-left me-1"></i>Kembali
            </a>
        </div>
    </div>
</div>

<!-- Main Content Grid -->
<div class="row">
    <!-- Left Column - Main Info -->
    <div class="col-lg-8 mb-4">
        <!-- Basic Information Card -->
        <div class="card mb-4">
            <div class="card-header">
                <h5 class="mb-0">
                    <i class="mdi mdi-information me-2"></i>Informasi Dasar
                </h5>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-4 mb-3">
                        <div class="destination-image-container">
                            <img src="{{ asset('image/destination/'.$destination->thumbnail_image) }}" 
                                 alt="{{ $destination->content_title }}" 
                                 class="img-fluid rounded shadow-sm destination-main-image"
                                 data-bs-toggle="modal" 
                                 data-bs-target="#imageModal">
                            @if($destination->is_main_page)
                            <div class="featured-badge">
                                <i class="mdi mdi-star"></i> Unggulan
                            </div>
                            @endif
                        </div>
                    </div>
                    <div class="col-md-8">
                        <div class="destination-details">
                            <div class="detail-item mb-3">
                                <h6 class="detail-label">
                                    <i class="mdi mdi-format-title text-primary me-2"></i>Nama Destinasi
                                </h6>
                                <p class="detail-content">{{ $destination->content_title }}</p>
                            </div>
                            
                            <div class="detail-item mb-3">
                                <h6 class="detail-label">
                                    <i class="mdi mdi-text text-success me-2"></i>Deskripsi
                                </h6>
                                <p class="detail-content">{{ $destination->content_summary }}</p>
                            </div>
                            
                            <div class="detail-item mb-3">
                                <h6 class="detail-label">
                                    <i class="mdi mdi-map-marker text-warning me-2"></i>Lokasi
                                </h6>
                                <p class="detail-content">{{ $destination->content_location_title }}</p>
                                @if($destination->content_location_detail)
                                <p class="detail-subcontent">{{ $destination->content_location_detail }}</p>
                                @endif
                            </div>
                            
                            <div class="detail-item">
                                <h6 class="detail-label">
                                    <i class="mdi mdi-calendar text-info me-2"></i>Dibuat
                                </h6>
                                <p class="detail-content">{{ $destination->created_at->format('d M Y, H:i') }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Unique Features Card -->
        <div class="card mb-4">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5 class="mb-0">
                    <i class="mdi mdi-star-circle me-2"></i>Keunikan Destinasi
                </h5>
                <a href="/dashboard/destinasi/uniq/create?destination_id={{ $destination->id }}" class="btn btn-primary btn-sm">
                    <i class="mdi mdi-plus-circle me-1"></i>Tambah Keunikan
                </a>
            </div>
            <div class="card-body">
                @forelse ($destination->destination_uniq as $uniq)
                <div class="unique-item mb-3">
                    <div class="row align-items-center">
                        <div class="col-md-3">
                            <img src="{{ asset('image/destination/uniq/'.$uniq->uniq_image) }}" 
                                 alt="{{ $uniq->uniq_title }}" 
                                 class="img-fluid rounded unique-image">
                        </div>
                        <div class="col-md-7">
                            <h6 class="unique-title">{{ $uniq->uniq_title }}</h6>
                            <p class="unique-detail">{{ $uniq->uniq_detail }}</p>
                        </div>
                        <div class="col-md-2 text-end">
                            <form action="/dashboard/destinasi/uniq/{{ $uniq->id }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-outline-danger btn-sm" onclick="return confirm('Hapus keunikan ini?')">
                                    <i class="mdi mdi-delete"></i>
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
                @empty
                <div class="empty-state-small">
                    <i class="mdi mdi-star-off"></i>
                    <p>Belum ada keunikan yang ditambahkan</p>
                    <a href="/dashboard/destinasi/uniq/create?destination_id={{ $destination->id }}" class="btn btn-outline-primary btn-sm">
                        Tambah Keunikan Pertama
                    </a>
                </div>
                @endforelse
            </div>
        </div>
    </div>

    <!-- Right Column - Additional Content -->
    <div class="col-lg-4">
        <!-- Quick Stats Card -->
        <div class="card mb-4">
            <div class="card-header">
                <h5 class="mb-0">
                    <i class="mdi mdi-chart-box me-2"></i>Statistik
                </h5>
            </div>
            <div class="card-body">
                <div class="stat-item">
                    <div class="stat-icon bg-primary">
                        <i class="mdi mdi-star"></i>
                    </div>
                    <div class="stat-info">
                        <span class="stat-number">{{ count($destination->destination_uniq) }}</span>
                        <span class="stat-label">Keunikan</span>
                    </div>
                </div>
                <div class="stat-item">
                    <div class="stat-icon bg-success">
                        <i class="mdi mdi-file-document"></i>
                    </div>
                    <div class="stat-info">
                        <span class="stat-number">{{ count($destination->destination_section) }}</span>
                        <span class="stat-label">Konten Tambahan</span>
                    </div>
                </div>
                <div class="stat-item">
                    <div class="stat-icon bg-info">
                        <i class="mdi mdi-eye"></i>
                    </div>
                    <div class="stat-info">
                        <span class="stat-number">{{ $destination->is_main_page ? 'Ya' : 'Tidak' }}</span>
                        <span class="stat-label">Tampil di Beranda</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Additional Content Card -->
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5 class="mb-0">
                    <i class="mdi mdi-file-document-multiple me-2"></i>Konten Tambahan
                </h5>
                <a href="/dashboard/destinasi/section/create?destination_id={{ $destination->id }}" class="btn btn-primary btn-sm">
                    <i class="mdi mdi-plus-circle me-1"></i>Tambah
                </a>
            </div>
            <div class="card-body">
                @forelse ($destination->destination_section as $section)
                <div class="content-section-item mb-3">
                    <div class="d-flex justify-content-between align-items-start">
                        <div class="flex-grow-1">
                            <h6 class="section-title">{{ $section->title }}</h6>
                            <p class="section-detail">{{ Str::limit($section->detail, 100) }}</p>
                        </div>
                        <form action="/dashboard/destinasi/section/{{ $section->id }}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-outline-danger btn-sm" onclick="return confirm('Hapus konten ini?')">
                                <i class="mdi mdi-delete"></i>
                            </button>
                        </form>
                    </div>
                </div>
                @empty
                <div class="empty-state-small">
                    <i class="mdi mdi-file-document-off"></i>
                    <p>Belum ada konten tambahan</p>
                    <a href="/dashboard/destinasi/section/create?destination_id={{ $destination->id }}" class="btn btn-outline-primary btn-sm">
                        Tambah Konten Pertama
                    </a>
                </div>
                @endforelse
            </div>
        </div>
    </div>
</div>

@endsection

@push('scripts')
<script>
// Image modal functionality
document.addEventListener('DOMContentLoaded', function() {
    const imageModal = document.getElementById('imageModal');
    const modalImage = document.getElementById('modalImage');
    const modalTitle = document.getElementById('imageModalTitle');
    
    document.querySelectorAll('.destination-main-image').forEach(img => {
        img.addEventListener('click', function() {
            modalImage.src = this.src;
            modalTitle.textContent = this.alt;
        });
    });
});
</script>
@endpush
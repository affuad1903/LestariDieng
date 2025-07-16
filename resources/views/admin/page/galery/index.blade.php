@extends('admin.layouts.master')

@push('styles')
<link rel="stylesheet" href="{{ asset('css/admin/dashboard-home.css') }}">
<link rel="stylesheet" href="{{ asset('css/admin/delete-confirmation.css') }}">
<link rel="stylesheet" href="{{ asset('css/admin/flash-messages.css') }}">
@endpush

@section('icon-title')
<i class="mdi mdi-image-multiple"></i>
@endsection

@section('title', 'Galeri Foto')

@section('content')

<!-- Flash Messages -->
@include('admin.components.flash-messages')

<!-- Dashboard Stats -->
<div class="row mb-4">
    <div class="col-xl-3 col-lg-6 col-md-6 mb-4">
        <div class="stats-card">
            <div class="stats-icon bg-primary">
                <i class="mdi mdi-image-multiple"></i>
            </div>
            <div class="stats-content">
                <h3>{{ $galery->count() }}</h3>
                <p>Total Galeri</p>
            </div>
        </div>
    </div>
    <div class="col-xl-3 col-lg-6 col-md-6 mb-4">
        <div class="stats-card">
            <div class="stats-icon bg-info">
                <i class="mdi mdi-image"></i>
            </div>
            <div class="stats-content">
                <h3>{{ $galery->sum(function($item) { return $item->galery_img->count(); }) }}</h3>
                <p>Total Foto</p>
            </div>
        </div>
    </div>
    <div class="col-xl-3 col-lg-6 col-md-6 mb-4">
        <div class="stats-card">
            <div class="stats-icon bg-success">
                <i class="mdi mdi-check-circle"></i>
            </div>
            <div class="stats-content">
                <h3>{{ $galery->filter(function($item) { return $item->galery_img->count() > 0; })->count() }}</h3>
                <p>Dengan Foto</p>
            </div>
        </div>
    </div>
    <div class="col-xl-3 col-lg-6 col-md-6 mb-4">
        <div class="stats-card">
            <div class="stats-icon bg-warning">
                <i class="mdi mdi-clock"></i>
            </div>
            <div class="stats-content">
                <h3>{{ $galery->where('created_at', '>=', now()->subDays(7))->count() }}</h3>
                <p>Baru (7 Hari)</p>
            </div>
        </div>
    </div>
</div>

<!-- Main Content -->
<div class="card">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h5 class="mb-0">
            <i class="mdi mdi-image-multiple me-2"></i>Galeri Foto
        </h5>
        <a href="{{ route('galery.create') }}" class="btn btn-primary">
            <i class="mdi mdi-plus-circle me-2"></i>Tambah Galeri
        </a>
    </div>
    <div class="card-body">
        <div class="row">
            @forelse ($galery as $item)
            <div class="col-lg-4 col-md-6 mb-4">
                <div class="card h-100 gallery-card">
                    <div class="gallery-image-container">
                        @php
                            $firstImage = $item->galery_img->first();
                            $imageCount = $item->galery_img->count();
                        @endphp
                        @if ($firstImage)
                            <img src="{{ asset('image/galery/' . $item->id . '/' . $firstImage->image) }}" 
                                 class="card-img-top gallery-image" 
                                 alt="{{ $item->title }}"
                                 data-bs-toggle="modal" 
                                 data-bs-target="#imageModal"
                                 onclick="showImage(this.src, '{{ $item->title }}')">
                        @else
                            <div class="gallery-placeholder">
                                <i class="mdi mdi-image-off text-muted"></i>
                                <p class="text-muted mb-0">Tidak ada gambar</p>
                            </div>
                        @endif
                        
                        @if($imageCount > 1)
                            <div class="gallery-badge">
                                <i class="mdi mdi-image-multiple me-1"></i>{{ $imageCount }}
                            </div>
                        @endif
                    </div>
                    
                    <div class="card-body d-flex flex-column">
                        <h6 class="card-title gallery-title" title="{{ $item->title }}">
                            {{ $item->title }}
                        </h6>
                        
                        <p class="card-text text-muted gallery-description">
                            {{ Str::limit($item->description, 100) }}
                        </p>
                        
                        <div class="gallery-meta mb-3">
                            <div class="row text-center">
                                <div class="col-6">
                                    <i class="mdi mdi-image text-primary"></i>
                                    <div class="small text-muted">{{ $imageCount }} Foto</div>
                                </div>
                                <div class="col-6">
                                    <i class="mdi mdi-calendar text-success"></i>
                                    <div class="small text-muted">{{ $item->created_at->format('M Y') }}</div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="mt-auto">
                            <div class="gallery-actions">
                                <a href="{{ route('galery.show', $item->id) }}" class="btn btn-outline-info btn-sm">
                                    <i class="mdi mdi-eye"></i> Lihat
                                </a>
                                <a href="{{ route('galery.edit', $item->id) }}" class="btn btn-outline-primary btn-sm">
                                    <i class="mdi mdi-pencil"></i> Edit
                                </a>
                                <form action="{{ route('galery.destroy', $item->id) }}" 
                                      method="POST" 
                                      class="d-inline delete-form">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-outline-danger btn-sm delete-btn">
                                        <i class="mdi mdi-delete"></i> Hapus
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @empty
            <div class="col-12">
                <div class="empty-state">
                    <div class="empty-icon">
                        <i class="mdi mdi-image-off"></i>
                    </div>
                    <h5>Belum Ada Galeri</h5>
                    <p>Mulai tambahkan galeri foto pertama Anda.</p>
                    <a href="{{ route('galery.create') }}" class="btn btn-primary">
                        <i class="mdi mdi-plus-circle me-2"></i>Tambah Galeri Pertama
                    </a>
                </div>
            </div>
            @endforelse
        </div>
    </div>
</div> 
                                    onclick="confirmDelete({{ $item->id }}, '{{ $item->title }}')">
                                <i class="fas fa-trash"></i>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @empty
        <div class="col-12">
            <div class="card">
                <div class="card-body text-center py-5">
                    <i class="fas fa-images text-muted mb-3" style="font-size: 4rem; opacity: 0.3;"></i>
                    <h5 class="text-muted mb-3">Belum ada galeri foto</h5>
                    <p class="text-muted mb-4">Mulai tambahkan galeri foto pertama Anda</p>
                    <a href="{{ route('galery.create') }}" class="btn btn-primary">
                        <i class="fas fa-plus me-2"></i>
                        Tambah Galeri Pertama
                    </a>
                </div>
            </div>
        </div>
    @endforelse
</div>

{{-- Delete Confirmation Modal --}}
<div class="modal fade" id="deleteModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">
                    <i class="fas fa-exclamation-triangle text-warning me-2"></i>
                    Konfirmasi Hapus
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <p>Apakah Anda yakin ingin menghapus galeri <strong id="galleryName"></strong>?</p>
                <p class="text-muted small">Semua foto dalam galeri ini juga akan dihapus dan tidak dapat dikembalikan.</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                <form id="deleteForm" method="POST" class="d-inline">
                    @csrf
                    @method("DELETE")
                    <button type="submit" class="btn btn-danger">
                        <i class="fas fa-trash me-1"></i>
                        Hapus
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>

@if (session('success'))
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            SashDashboard.showNotification('{{ session('success') }}', 'success');
        });
    </script>
@endif

<script>
function confirmDelete(id, name) {
    document.getElementById('galleryName').textContent = name;
    document.getElementById('deleteForm').action = `/dashboard/galery/${id}`;
    new bootstrap.Modal(document.getElementById('deleteModal')).show();
}
</script>

@endsection

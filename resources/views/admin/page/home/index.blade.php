@extends('admin.layouts.master')

@push('styles')
<link rel="stylesheet" href="{{ asset('css/admin/dashboard-home.css') }}">
<link rel="stylesheet" href="{{ asset('css/admin/delete-confirmation.css') }}">
<link rel="stylesheet" href="{{ asset('css/admin/flash-messages.css') }}">
@endpush

@section('icon-title')
<i class="mdi mdi-home"></i>
@endsection

@section('title', 'Pengaturan Beranda')

@section('content')

<!-- Flash Messages -->
@include('admin.components.flash-messages')

<!-- Dashboard Stats -->
<div class="row mb-4">
    <div class="col-xl-3 col-lg-6 col-md-6 mb-4">
        <div class="stats-card">
            <div class="stats-icon bg-primary">
                <i class="mdi mdi-home-variant"></i>
            </div>
            <div class="stats-content">
                <h3>{{ count($home) }}</h3>
                <p>Konten Beranda</p>
            </div>
        </div>
    </div>
    <div class="col-xl-3 col-lg-6 col-md-6 mb-4">
        <div class="stats-card">
            <div class="stats-icon bg-info">
                <i class="mdi mdi-certificate"></i>
            </div>
            <div class="stats-content">
                <h3>{{ count($legality) }}</h3>
                <p>Legalitas</p>
            </div>
        </div>
    </div>
    <div class="col-xl-3 col-lg-6 col-md-6 mb-4">
        <div class="stats-card">
            <div class="stats-icon bg-success">
                <i class="mdi mdi-share-variant"></i>
            </div>
            <div class="stats-content">
                <h3>{{ count($socmed) }}</h3>
                <p>Media Sosial</p>
            </div>
        </div>
    </div>
    <div class="col-xl-3 col-lg-6 col-md-6 mb-4">
        <div class="stats-card">
            <div class="stats-icon bg-warning">
                <i class="mdi mdi-phone"></i>
            </div>
            <div class="stats-content">
                <h3>{{ count($contact) }}</h3>
                <p>Kontak</p>
            </div>
        </div>
    </div>
</div>

<!-- Main Content Grid -->
<div class="row">
    <!-- Main Content Column -->
    <div class="col-lg-8 mb-4">
        <!-- Website Content Card -->
        <div class="card mb-4">
            <div class="card-header">
                <h5 class="mb-0">
                    <i class="mdi mdi-web me-2"></i>Konten Website
                </h5>
            </div>
            <div class="card-body">
                @forelse ($home as $item)
                <div class="content-grid">
                    <!-- Website Info -->
                    <div class="content-item">
                        <div class="content-header">
                            <i class="mdi mdi-format-title text-primary"></i>
                            <h6>Judul Website</h6>
                        </div>
                        <p class="content-text">{{ $item->title }}</p>
                    </div>

                    <div class="content-item">
                        <div class="content-header">
                            <i class="mdi mdi-tag-text text-info"></i>
                            <h6>Tag Line</h6>
                        </div>
                        <p class="content-text">{{ $item->tag_line }}</p>
                    </div>

                    <!-- Images Section -->
                    <div class="content-item">
                        <div class="content-header">
                            <i class="mdi mdi-image text-success"></i>
                            <h6>Logo Website</h6>
                        </div>
                        <div class="image-container">
                            <img src="{{ asset('image/home/'.$item->logo) }}" 
                                 class="content-image logo" 
                                 alt="Logo Website"
                                 data-bs-toggle="modal" 
                                 data-bs-target="#imageModal"
                                 onclick="showImage(this.src, 'Logo Website')">
                        </div>
                    </div>

                    <div class="content-item">
                        <div class="content-header">
                            <i class="mdi mdi-image-multiple text-warning"></i>
                            <h6>Hero Image</h6>
                        </div>
                        <div class="image-container">
                            <img src="{{ asset('image/home/'.$item->hero_image) }}" 
                                 class="content-image hero" 
                                 alt="Hero Image"
                                 data-bs-toggle="modal" 
                                 data-bs-target="#imageModal"
                                 onclick="showImage(this.src, 'Hero Image')">
                        </div>
                    </div>
                </div>

                <!-- Action Buttons -->
                <div class="action-buttons">
                    <a href="/dashboard/home/{{ $item->id }}/edit" class="btn btn-primary">
                        <i class="mdi mdi-pencil me-2"></i>Edit Konten
                    </a>
                    <button class="btn btn-outline-secondary" onclick="previewWebsite()">
                        <i class="mdi mdi-eye me-2"></i>Preview
                    </button>
                </div>

                @empty
                <div class="empty-state">
                    <div class="empty-icon">
                        <i class="mdi mdi-home-outline"></i>
                    </div>
                    <h5>Belum Ada Konten Beranda</h5>
                    <p>Tambahkan konten beranda untuk menampilkan informasi website Anda</p>
                    <a href="/dashboard/home/create" class="btn btn-primary">
                        <i class="mdi mdi-plus me-2"></i>Tambah Konten
                    </a>
                </div>
                @endforelse
            </div>
        </div>
    </div>

    <!-- Sidebar Column -->
    <div class="col-lg-4">
        <!-- Quick Actions -->
        <div class="card mb-4">
            <div class="card-header" data-bs-toggle="collapse" data-bs-target="#quickActionsCollapse" aria-expanded="true" aria-controls="quickActionsCollapse" style="cursor: pointer;">
                <h6 class="mb-0 d-flex align-items-center justify-content-between">
                    <span>
                        <i class="mdi mdi-lightning-bolt me-2"></i>Aksi Cepat
                    </span>
                    <i class="mdi mdi-chevron-down collapse-icon"></i>
                </h6>
            </div>
            <div class="collapse show" id="quickActionsCollapse">
                <div class="card-body">
                <div class="quick-actions">
                    @if(count($home) > 0)
                    <a href="/dashboard/home/{{ $home->first()->id }}/edit" class="quick-action-btn">
                        <i class="mdi mdi-pencil"></i>
                        <span>Edit Beranda</span>
                    </a>
                    @else
                    <a href="/dashboard/home/create" class="quick-action-btn">
                        <i class="mdi mdi-plus"></i>
                        <span>Tambah Beranda</span>
                    </a>
                    @endif
                    
                    <a href="/dashboard/home/legality/create" class="quick-action-btn">
                        <i class="mdi mdi-certificate"></i>
                        <span>Tambah Legalitas</span>
                    </a>
                    
                    <a href="/dashboard/home/socmed/create" class="quick-action-btn">
                        <i class="mdi mdi-share-variant"></i>
                        <span>Tambah Sosmed</span>
                    </a>
                    
                    <a href="/dashboard/home/contact/create" class="quick-action-btn">
                        <i class="mdi mdi-phone"></i>
                        <span>Tambah Kontak</span>
                    </a>
                </div>
                </div>
            </div>
        </div>

        <!-- Settings Cards -->
        <div class="settings-grid">
            <!-- Legality Card -->
            <div class="card mb-3">
                <div class="card-header bg-info text-white" data-bs-toggle="collapse" data-bs-target="#legalityCollapse" aria-expanded="true" aria-controls="legalityCollapse" style="cursor: pointer;">
                    <h6 class="mb-0 d-flex align-items-center justify-content-between">
                        <span>
                            <i class="mdi mdi-certificate me-2"></i>Legalitas
                            <span class="badge bg-light text-info ms-2">{{ count($legality) }}</span>
                        </span>
                        <i class="mdi mdi-chevron-down collapse-icon"></i>
                    </h6>
                </div>
                <div class="collapse show" id="legalityCollapse">
                    <div class="card-body p-3">
                    @forelse ($legality->take(3) as $item)
                    <div class="setting-item">
                        <div class="setting-icon">
                            <i class="mdi mdi-certificate"></i>
                        </div>
                        <div class="setting-content">
                            <h6>{{ $item->type }}</h6>
                            <p>{{ Str::limit($item->number, 20) }}</p>
                        </div>
                        <div class="setting-actions">
                            <button class="btn btn-sm btn-outline-secondary" data-bs-toggle="collapse" data-bs-target="#legalityActions{{ $item->id }}" aria-expanded="false" aria-controls="legalityActions{{ $item->id }}">
                                <i class="mdi mdi-dots-vertical"></i>
                            </button>
                            <div class="collapse mt-2" id="legalityActions{{ $item->id }}">
                                <div class="action-buttons-small">
                                    <a href="/dashboard/home/legality/{{ $item->id }}/edit" class="btn btn-sm btn-outline-primary">
                                        <i class="mdi mdi-pencil"></i> Edit
                                    </a>
                                    <form action="/dashboard/home/legality/{{ $item->id }}" method="POST" class="d-inline">
                                        @csrf @method("DELETE")
                                        <button type="button" class="btn btn-sm btn-outline-danger" onclick="showDeleteConfirm('legalitas', this.closest('form'))">
                                            <i class="mdi mdi-delete"></i> Hapus
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    @empty
                    <div class="empty-mini">
                        <i class="mdi mdi-certificate-outline"></i>
                        <span>Belum ada data</span>
                    </div>
                    @endforelse
                    
                    @if(count($legality) > 3)
                    <div class="text-center mt-2">
                        <small class="text-muted">+{{ count($legality) - 3 }} lainnya</small>
                    </div>
                    @endif
                    </div>
                </div>
            </div>

            <!-- Social Media Card -->
            <div class="card mb-3">
                <div class="card-header bg-success text-white" data-bs-toggle="collapse" data-bs-target="#socmedCollapse" aria-expanded="true" aria-controls="socmedCollapse" style="cursor: pointer;">
                    <h6 class="mb-0 d-flex align-items-center justify-content-between">
                        <span>
                            <i class="mdi mdi-share-variant me-2"></i>Media Sosial
                            <span class="badge bg-light text-success ms-2">{{ count($socmed) }}</span>
                        </span>
                        <i class="mdi mdi-chevron-down collapse-icon"></i>
                    </h6>
                </div>
                <div class="collapse show" id="socmedCollapse">
                    <div class="card-body p-3">
                    @forelse ($socmed->take(3) as $item)
                    <div class="setting-item">
                        <div class="setting-icon">
                            <i class="{{ $item->icon }}"></i>
                        </div>
                        <div class="setting-content">
                            <h6>{{ $item->platform }}</h6>
                            <p>{{ Str::limit($item->url, 25) }}</p>
                        </div>
                        <div class="setting-actions">
                            <button class="btn btn-sm btn-outline-secondary" data-bs-toggle="collapse" data-bs-target="#socmedActions{{ $item->id }}" aria-expanded="false" aria-controls="socmedActions{{ $item->id }}">
                                <i class="mdi mdi-dots-vertical"></i>
                            </button>
                            <div class="collapse mt-2" id="socmedActions{{ $item->id }}">
                                <div class="action-buttons-small">
                                    <a href="/dashboard/home/socmed/{{ $item->id }}/edit" class="btn btn-sm btn-outline-primary">
                                        <i class="mdi mdi-pencil"></i> Edit
                                    </a>
                                    <form action="/dashboard/home/socmed/{{ $item->id }}" method="POST" class="d-inline">
                                        @csrf @method("DELETE")
                                        <button type="button" class="btn btn-sm btn-outline-danger" onclick="showDeleteConfirm('media sosial', this.closest('form'))">
                                            <i class="mdi mdi-delete"></i> Hapus
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    @empty
                    <div class="empty-mini">
                        <i class="mdi mdi-share-variant-outline"></i>
                        <span>Belum ada data</span>
                    </div>
                    @endforelse
                    
                    @if(count($socmed) > 3)
                    <div class="text-center mt-2">
                        <small class="text-muted">+{{ count($socmed) - 3 }} lainnya</small>
                    </div>
                    @endif
                    </div>
                </div>
            </div>

            <!-- Contact Card -->
            <div class="card mb-3">
                <div class="card-header bg-warning text-white" data-bs-toggle="collapse" data-bs-target="#contactCollapse" aria-expanded="true" aria-controls="contactCollapse" style="cursor: pointer;">
                    <h6 class="mb-0 d-flex align-items-center justify-content-between">
                        <span>
                            <i class="mdi mdi-phone me-2"></i>Kontak
                            <span class="badge bg-light text-warning ms-2">{{ count($contact) }}</span>
                        </span>
                        <i class="mdi mdi-chevron-down collapse-icon"></i>
                    </h6>
                </div>
                <div class="collapse show" id="contactCollapse">
                    <div class="card-body p-3">
                    @forelse ($contact->take(3) as $item)
                    <div class="setting-item">
                        <div class="setting-icon">
                            <i class="{{ $item->icon }}"></i>
                        </div>
                        <div class="setting-content">
                            <h6>{{ $item->platform }}</h6>
                            <p>{{ Str::limit($item->detail, 25) }}</p>
                        </div>
                        <div class="setting-actions">
                            <button class="btn btn-sm btn-outline-secondary" data-bs-toggle="collapse" data-bs-target="#contactActions{{ $item->id }}" aria-expanded="false" aria-controls="contactActions{{ $item->id }}">
                                <i class="mdi mdi-dots-vertical"></i>
                            </button>
                            <div class="collapse mt-2" id="contactActions{{ $item->id }}">
                                <div class="action-buttons-small">
                                    <a href="/dashboard/home/contact/{{ $item->id }}/edit" class="btn btn-sm btn-outline-primary">
                                        <i class="mdi mdi-pencil"></i> Edit
                                    </a>
                                    <form action="/dashboard/home/contact/{{ $item->id }}" method="POST" class="d-inline">
                                        @csrf @method("DELETE")
                                        <button type="button" class="btn btn-sm btn-outline-danger" onclick="showDeleteConfirm('kontak', this.closest('form'))">
                                            <i class="mdi mdi-delete"></i> Hapus
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    @empty
                    <div class="empty-mini">
                        <i class="mdi mdi-phone-outline"></i>
                        <span>Belum ada data</span>
                    </div>
                    @endforelse
                    
                    @if(count($contact) > 3)
                    <div class="text-center mt-2">
                        <small class="text-muted">+{{ count($contact) - 3 }} lainnya</small>
                    </div>
                    @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Delete Confirmation Modal -->
<div class="modal fade" id="deleteConfirmModal" tabindex="-1" aria-labelledby="deleteConfirmModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content delete-modal">
            <div class="modal-header border-0">
                <div class="delete-icon-container mx-auto">
                    <div class="delete-icon">
                        <i class="mdi mdi-alert-circle-outline"></i>
                    </div>
                </div>
                <button type="button" class="btn-close position-absolute top-0 end-0 mt-3 me-3" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body text-center px-4 pb-4">
                <h4 class="delete-title mb-3">Konfirmasi Hapus</h4>
                <p class="delete-message mb-4"></p>
                <div class="delete-actions">
                    <button type="button" class="btn btn-secondary me-2" data-bs-dismiss="modal">
                        <i class="mdi mdi-close me-2"></i>Batal
                    </button>
                    <button type="button" class="btn btn-danger" id="confirmDeleteBtn">
                        <i class="mdi mdi-delete me-2"></i>Ya, Hapus
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script src="{{ asset('js/admin/dashboard-home.js') }}"></script>
<script src="{{ asset('js/admin/delete-confirmation.js') }}"></script>
<script src="{{ asset('js/admin/flash-messages.js') }}"></script>
@endpush

@endsection
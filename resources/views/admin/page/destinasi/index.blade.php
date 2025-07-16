@extends('admin.layouts.master')

@push('styles')
<link rel="stylesheet" href="{{ asset('css/admin/dashboard-home.css') }}">
<link rel="stylesheet" href="{{ asset('css/admin/delete-confirmation.css') }}">
<link rel="stylesheet" href="{{ asset('css/admin/flash-messages.css') }}">
@endpush

@section('icon-title')
<i class="mdi mdi-map-marker-radius"></i>
@endsection

@section('title', 'Pengaturan Destinasi')

@section('content')

<!-- Flash Messages -->
@include('admin.components.flash-messages')

<!-- Dashboard Stats -->
<div class="row mb-4">
    <div class="col-xl-3 col-lg-6 col-md-6 mb-4">
        <div class="stats-card">
            <div class="stats-icon bg-primary">
                <i class="mdi mdi-map-marker-radius"></i>
            </div>
            <div class="stats-content">
                <h3>{{ count($destination) }}</h3>
                <p>Total Destinasi</p>
            </div>
        </div>
    </div>
    <div class="col-xl-3 col-lg-6 col-md-6 mb-4">
        <div class="stats-card">
            <div class="stats-icon bg-success">
                <i class="mdi mdi-eye"></i>
            </div>
            <div class="stats-content">
                <h3>{{ $destination->where('is_main_page', 1)->count() }}</h3>
                <p>Tampil di Beranda</p>
            </div>
        </div>
    </div>
    <div class="col-xl-3 col-lg-6 col-md-6 mb-4">
        <div class="stats-card">
            <div class="stats-icon bg-info">
                <i class="mdi mdi-image-multiple"></i>
            </div>
            <div class="stats-content">
                <h3>{{ $destination->where('thumbnail_image', '!=', null)->count() }}</h3>
                <p>Dengan Gambar</p>
            </div>
        </div>
    </div>
    <div class="col-xl-3 col-lg-6 col-md-6 mb-4">
        <div class="stats-card">
            <div class="stats-icon bg-warning">
                <i class="mdi mdi-clock"></i>
            </div>
            <div class="stats-content">
                <h3>{{ $destination->where('created_at', '>=', now()->subDays(7))->count() }}</h3>
                <p>Baru (7 Hari)</p>
            </div>
        </div>
    </div>
</div>

<!-- Main Content -->
<div class="card">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h5 class="mb-0">
            <i class="mdi mdi-map-marker-radius me-2"></i>Daftar Destinasi
        </h5>
        <a href="/dashboard/destinasi/create" class="btn btn-primary">
            <i class="mdi mdi-plus-circle me-2"></i>Tambah Destinasi
        </a>
    </div>
    <div class="card-body">
        @forelse ($destination as $item)
        <div class="row mb-4">
            <div class="col-12">
                <div class="destination-item">
                    <div class="row align-items-center">
                        <div class="col-lg-3 col-md-4">
                            <div class="destination-image">
                                <img src="{{ asset('/image/destination/'.$item->thumbnail_image) }}" 
                                     alt="{{ $item->content_title }}" 
                                     class="img-fluid rounded">
                                @if($item->is_main_page)
                                <div class="featured-badge">
                                    <i class="mdi mdi-star"></i> Unggulan
                                </div>
                                @endif
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-5">
                            <div class="destination-content">
                                <h5 class="destination-title">{{ $item->content_title }}</h5>
                                <p class="destination-description">
                                    {{ Str::limit(strip_tags($item->content_summary), 120) }}
                                </p>
                                <div class="destination-meta">
                                    <span class="meta-item">
                                        <i class="mdi mdi-calendar-clock"></i>
                                        {{ $item->created_at->format('d M Y') }}
                                    </span>
                                    @if($item->is_main_page)
                                    <span class="meta-item text-success">
                                        <i class="mdi mdi-eye"></i>
                                        Tampil di Beranda
                                    </span>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-3">
                            <div class="destination-actions">
                                <a href="/dashboard/destinasi/{{ $item->id }}" 
                                   class="btn btn-outline-primary btn-sm">
                                    <i class="mdi mdi-eye"></i> Lihat
                                </a>
                                <a href="/dashboard/destinasi/{{ $item->id }}/edit" 
                                   class="btn btn-outline-success btn-sm">
                                    <i class="mdi mdi-pencil"></i> Edit
                                </a>
                                <form action="/dashboard/destinasi/{{ $item->id }}" 
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
        </div>
        @empty
        <div class="empty-state">
            <div class="empty-icon">
                <i class="mdi mdi-map-marker-off"></i>
            </div>
            <h5>Belum Ada Destinasi</h5>
            <p>Mulai tambahkan destinasi wisata pertama Anda.</p>
            <a href="/dashboard/destinasi/create" class="btn btn-primary">
                <i class="mdi mdi-plus-circle me-2"></i>Tambah Destinasi Pertama
            </a>
        </div>
        @endforelse
    </div>
</div>

@endsection

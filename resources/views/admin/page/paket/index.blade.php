@extends('admin.layouts.master')

@push('styles')
<link rel="stylesheet" href="{{ asset('css/admin/dashboard-home.css') }}">
<link rel="stylesheet" href="{{ asset('css/admin/delete-confirmation.css') }}">
<link rel="stylesheet" href="{{ asset('css/admin/flash-messages.css') }}">
@endpush

@section('icon-title')
<i class="fas fa-box"></i>
@endsection

@section('title', 'Pengaturan Paket')

@section('content')

<!-- Flash Messages -->
@include('admin.components.flash-messages')

<!-- Dashboard Stats -->
<div class="row mb-4">
    <div class="col-xl-3 col-lg-6 col-md-6 mb-4">
        <div class="stats-card">
            <div class="stats-icon bg-primary">
                <i class="fas fa-box"></i>
            </div>
            <div class="stats-content">
                <h3>{{ count($paket) }}</h3>
                <p>Total Paket</p>
            </div>
        </div>
    </div>
    <div class="col-xl-3 col-lg-6 col-md-6 mb-4">
        <div class="stats-card">
            <div class="stats-icon bg-success">
                <i class="fas fa-image"></i>
            </div>
            <div class="stats-content">
                <h3>{{ $paket->where('paket_image', '!=', null)->count() }}</h3>
                <p>Dengan Gambar</p>
            </div>
        </div>
    </div>
    <div class="col-xl-3 col-lg-6 col-md-6 mb-4">
        <div class="stats-card">
            <div class="stats-icon bg-info">
                <i class="fas fa-dollar-sign"></i>
            </div>
            <div class="stats-content">
                <h3>{{ $paket->where('paket_price', '>', 0)->count() }}</h3>
                <p>Berbayar</p>
            </div>
        </div>
    </div>
    <div class="col-xl-3 col-lg-6 col-md-6 mb-4">
        <div class="stats-card">
            <div class="stats-icon bg-warning">
                <i class="fas fa-clock"></i>
            </div>
            <div class="stats-content">
                <h3>{{ $paket->where('created_at', '>=', now()->subDays(7))->count() }}</h3>
                <p>Baru (7 Hari)</p>
            </div>
        </div>
    </div>
</div>

<!-- Main Content -->
<div class="card">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h5 class="mb-0">
            <i class="fas fa-box me-2"></i>Daftar Paket
        </h5>
        <a href="/dashboard/paket/create" class="btn btn-primary">
            <i class="fas fa-plus-circle me-2"></i>Tambah Paket
        </a>
    </div>
    <div class="card-body">
        <div class="row">
            @forelse ($paket as $item)
            <div class="col-xl-4 col-lg-6 col-md-6 mb-4">
                <div class="card h-100 paket-card">
                    <div class="paket-image-container">
                        <img src="{{ asset('/image/paket/'.$item->paket_image) }}" 
                             class="card-img-top paket-image" 
                             alt="{{ $item->paket_title }}"
                             data-bs-toggle="modal" 
                             data-bs-target="#imageModal"
                             onclick="showImage(this.src, '{{ $item->paket_title }}')">
                        <div class="paket-overlay">
                            <div class="paket-actions">
                                <a href="/dashboard/paket/{{ $item->id }}" class="btn btn-sm btn-light">
                                    <i class="mdi mdi-eye"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="card-body d-flex flex-column">
                        <h5 class="card-title paket-title">{{ $item->paket_title }}</h5>
                        @if($item->paket_price)
                        <div class="paket-price mb-3">
                            <span class="price-label">Harga:</span>
                            <span class="price-value">Rp {{ number_format($item->paket_price, 0, ',', '.') }}</span>
                        </div>
                        @endif
                        <div class="paket-meta mb-3">
                            <span class="meta-item">
                                <i class="mdi mdi-calendar-clock"></i>
                                {{ $item->created_at->format('d M Y') }}
                            </span>
                        </div>
                        <div class="mt-auto">
                            <div class="paket-buttons">
                                <a href="/dashboard/paket/{{ $item->id }}" class="btn btn-outline-primary btn-sm">
                                    <i class="mdi mdi-eye"></i> Detail
                                </a>
                                <a href="/dashboard/paket/{{ $item->id }}/edit" class="btn btn-outline-success btn-sm">
                                    <i class="mdi mdi-pencil"></i> Edit
                                </a>
                                <form action="/dashboard/paket/{{ $item->id }}" 
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
                        <i class="mdi mdi-package-variant-off"></i>
                    </div>
                    <h5>Belum Ada Paket</h5>
                    <p>Mulai tambahkan paket wisata pertama Anda.</p>
                    <a href="/dashboard/paket/create" class="btn btn-primary">
                        <i class="mdi mdi-plus-circle me-2"></i>Tambah Paket Pertama
                    </a>
                </div>
            </div>
            @endforelse
        </div>
    </div>
</div>

@endsection

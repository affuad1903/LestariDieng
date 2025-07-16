@extends('admin.layouts.master')

@push('styles')
<link rel="stylesheet" href="{{ asset('css/admin/dashboard-home.css') }}">
<link rel="stylesheet" href="{{ asset('css/admin/delete-confirmation.css') }}">
<link rel="stylesheet" href="{{ asset('css/admin/flash-messages.css') }}">
@endpush

@section('icon-title')
<i class="mdi mdi-format-list-bulleted"></i>
@endsection

@section('title', 'Pengaturan Daftar Destinasi')

@section('content')

<!-- Flash Messages -->
@include('admin.components.flash-messages')

<!-- Dashboard Stats -->
<div class="row mb-4">
    <div class="col-xl-3 col-lg-6 col-md-6 mb-4">
        <div class="stats-card">
            <div class="stats-icon bg-primary">
                <i class="mdi mdi-format-list-bulleted"></i>
            </div>
            <div class="stats-content">
                <h3>{{ count($daftar_destinasi) }}</h3>
                <p>Total Daftar Destinasi</p>
            </div>
        </div>
    </div>
    <div class="col-xl-3 col-lg-6 col-md-6 mb-4">
        <div class="stats-card">
            <div class="stats-icon bg-info">
                <i class="mdi mdi-package-variant"></i>
            </div>
            <div class="stats-content">
                <h3>{{ $daftar_destinasi->sum(function($item) { return $item->paket->count(); }) }}</h3>
                <p>Total Paket Terkait</p>
            </div>
        </div>
    </div>
    <div class="col-xl-3 col-lg-6 col-md-6 mb-4">
        <div class="stats-card">
            <div class="stats-icon bg-success">
                <i class="mdi mdi-check-circle"></i>
            </div>
            <div class="stats-content">
                <h3>{{ $daftar_destinasi->filter(function($item) { return $item->paket->count() > 0; })->count() }}</h3>
                <p>Dengan Paket</p>
            </div>
        </div>
    </div>
    <div class="col-xl-3 col-lg-6 col-md-6 mb-4">
        <div class="stats-card">
            <div class="stats-icon bg-warning">
                <i class="mdi mdi-clock"></i>
            </div>
            <div class="stats-content">
                <h3>{{ $daftar_destinasi->where('created_at', '>=', now()->subDays(7))->count() }}</h3>
                <p>Baru (7 Hari)</p>
            </div>
        </div>
    </div>
</div>

<!-- Main Content -->
<div class="card">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h5 class="mb-0">
            <i class="mdi mdi-format-list-bulleted me-2"></i>Daftar Destinasi
        </h5>
        <a href="/dashboard/daftar-d/create" class="btn btn-primary">
            <i class="mdi mdi-plus-circle me-2"></i>Tambah Daftar Destinasi
        </a>
    </div>
    <div class="card-body">
        @forelse ($daftar_destinasi as $item)
        <div class="row mb-4">
            <div class="col-12">
                <div class="destination-item">
                    <div class="row align-items-center">
                        <div class="col-lg-1 col-md-2">
                            <div class="destination-icon">
                                <i class="mdi mdi-map-marker text-primary" style="font-size: 2rem;"></i>
                            </div>
                        </div>
                        <div class="col-lg-7 col-md-6">
                            <div class="destination-content">
                                <h5 class="destination-title">{{ $item->nama_destinasi }}</h5>
                                <div class="destination-meta">
                                    <span class="meta-item">
                                        <i class="mdi mdi-calendar-clock"></i>
                                        {{ $item->created_at->format('d M Y') }}
                                    </span>
                                    <span class="meta-item">
                                        <i class="mdi mdi-package-variant"></i>
                                        {{ $item->paket->count() }} Paket
                                    </span>
                                </div>
                                @if($item->paket->count() > 0)
                                <div class="paket-list mt-2">
                                    <small class="text-muted">Paket Terkait:</small>
                                    <ul class="list-inline mb-0">
                                        @foreach($item->paket as $paket)
                                        <li class="list-inline-item">
                                            <span class="badge bg-light text-dark">{{ $paket->paket_title }}</span>
                                        </li>
                                        @endforeach
                                    </ul>
                                </div>
                                @endif
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-4">
                            <div class="destination-actions">
                                <a href="/dashboard/daftar-d/{{ $item->id }}/edit" 
                                   class="btn btn-outline-success btn-sm">
                                    <i class="mdi mdi-pencil"></i> Edit
                                </a>
                                <form action="/dashboard/daftar-d/{{ $item->id }}" 
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
                <i class="mdi mdi-format-list-bulleted-off"></i>
            </div>
            <h5>Belum Ada Daftar Destinasi</h5>
            <p>Mulai tambahkan daftar destinasi pertama Anda.</p>
            <a href="/dashboard/daftar-d/create" class="btn btn-primary">
                <i class="mdi mdi-plus-circle me-2"></i>Tambah Daftar Destinasi Pertama
            </a>
        </div>
        @endforelse
    </div>
</div>

@endsection

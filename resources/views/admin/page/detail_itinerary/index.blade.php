@extends('admin.layouts.master')

@push('styles')
<link rel="stylesheet" href="{{ asset('css/admin/dashboard-home.css') }}">
<link rel="stylesheet" href="{{ asset('css/admin/delete-confirmation.css') }}">
<link rel="stylesheet" href="{{ asset('css/admin/flash-messages.css') }}">
@endpush

@section('icon-title')
<i class="mdi mdi-calendar-clock"></i>
@endsection

@section('title', 'Detail Itinerary')

@section('content')

<!-- Flash Messages -->
@include('admin.components.flash-messages')

<!-- Dashboard Stats -->
<div class="row mb-4">
    <div class="col-xl-3 col-lg-6 col-md-6 mb-4">
        <div class="stats-card">
            <div class="stats-icon bg-primary">
                <i class="mdi mdi-calendar-clock"></i>
            </div>
            <div class="stats-content">
                <h3>{{ $detail_itinerary->count() }}</h3>
                <p>Total Itinerary</p>
            </div>
        </div>
    </div>
    <div class="col-xl-3 col-lg-6 col-md-6 mb-4">
        <div class="stats-card">
            <div class="stats-icon bg-info">
                <i class="mdi mdi-package-variant"></i>
            </div>
            <div class="stats-content">
                <h3>{{ $pakets->count() }}</h3>
                <p>Total Paket</p>
            </div>
        </div>
    </div>
    <div class="col-xl-3 col-lg-6 col-md-6 mb-4">
        <div class="stats-card">
            <div class="stats-icon bg-success">
                <i class="mdi mdi-calendar-check"></i>
            </div>
            <div class="stats-content">
                <h3>{{ $detail_itinerary->groupBy('hari_ke')->count() }}</h3>
                <p>Hari Berbeda</p>
            </div>
        </div>
    </div>
    <div class="col-xl-3 col-lg-6 col-md-6 mb-4">
        <div class="stats-card">
            <div class="stats-icon bg-warning">
                <i class="mdi mdi-clock"></i>
            </div>
            <div class="stats-content">
                <h3>{{ $detail_itinerary->where('created_at', '>=', now()->subDays(7))->count() }}</h3>
                <p>Baru (7 Hari)</p>
            </div>
        </div>
    </div>
</div>

<!-- Filters -->
<div class="card mb-4">
    <div class="card-header">
        <h6 class="mb-0">
            <i class="mdi mdi-filter me-2"></i>Filter & Pencarian
        </h6>
    </div>
    <div class="card-body">
        <form method="GET" action="{{ route('detail-itinerary.index') }}">
            <div class="row g-3 align-items-end">
                <div class="col-lg-4 col-md-6">
                    <label for="paket_id" class="form-label">Filter Paket</label>
                    <select name="paket_id" id="paket_id" class="form-select">
                        <option value="">-- Semua Paket --</option>
                        @foreach ($pakets as $paket)
                            <option value="{{ $paket->id }}" {{ request('paket_id') == $paket->id ? 'selected' : '' }}>
                                {{ $paket->paket_title }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="col-lg-5 col-md-6">
                    <label for="search" class="form-label">Pencarian</label>
                    <input type="text" name="search" id="search" class="form-control" 
                           placeholder="Cari detail, hari, jam..." value="{{ request('search') }}">
                </div>
                <div class="col-lg-3 col-12">
                    <div class="d-flex gap-2">
                        <button type="submit" class="btn btn-primary flex-fill">
                            <i class="mdi mdi-magnify"></i> Cari
                        </button>
                        <a href="{{ route('detail-itinerary.index') }}" class="btn btn-outline-secondary flex-fill">
                            <i class="mdi mdi-refresh"></i> Reset
                        </a>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
                            </a>
                        </div>
                    </div>
                </form>

                {{-- TAMBAH --}}
                <div class="mb-4">
                    <a href="{{ route('detail-itinerary.create') }}" class="btn btn-success">
                        <i class="mdi mdi-plus"></i> Tambah Detail Itinerary
                    </a>
                </div>

                {{-- LIST ITINERARY --}}
                @forelse ($detail_itinerary as $item)
                    <div class="card mb-3 border rounded shadow-sm bg-dark text-white">
                        <div class="card-body">
                            <h5 class="card-title">{{ $item->paket->paket_title ?? '-' }}</h5>
                            <p><strong>Hari:</strong> {{ $item->dayItinerary->nama_hari ?? '-' }}</p>
                            <p><strong>Jam:</strong> {{ \Carbon\Carbon::parse($item->timeItinerary->waktu)->format('H:i') }}</p>
                            <p><strong>Detail:</strong> {{ $item->detail }}</p>
                            <div class="mt-3 d-flex gap-2 flex-wrap">
                                <a href="{{ route('detail-itinerary.edit', $item->id) }}" class="btn btn-sm btn-warning">
                                    <i class="mdi mdi-pencil"></i> Edit
                                </a>
                                <form action="{{ route('detail-itinerary.destroy', $item->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger">
                                        <i class="mdi mdi-delete"></i> Hapus
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="alert alert-info text-center">Belum ada data detail itinerary</div>
                @endforelse

                {{-- PAGINATION --}}
                <div class="mt-4 d-flex justify-content-center">
                    {{ $detail_itinerary->appends(request()->query())->links() }}
                </div>
            </div>
        </div>
    </div>
</section>
@endsection

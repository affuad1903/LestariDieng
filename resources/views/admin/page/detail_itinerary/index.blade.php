@extends('admin.layouts.master')

@section('icon-title')
<span class="page-title-icon bg-gradient-primary text-white me-2">
    <i class="mdi mdi-calendar-clock"></i>
</span>
@endsection

@section('title')List Itinerary @endsection

@section('content')
<section class="row">
    <div class="col-12">
        <div class="card shadow">
            <div class="card-body">
                <h2 class="card-title text-md-start text-center">Pengaturan List Itinerary</h2>

                {{-- ALERT --}}
                @if (session('success'))
                    <div class="alert alert-success">{{ session('success') }}</div>
                @elseif (session('error'))
                    <div class="alert alert-danger">{{ session('error') }}</div>
                @endif

                {{-- FILTER --}}
                <form method="GET" action="{{ route('detail-itinerary.index') }}" class="mb-4">
                    <div class="row g-2 align-items-end">
                        <div class="col-md-4 col-12">
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

                        <div class="col-md-5 col-12">
                            <label for="search" class="form-label">Pencarian</label>
                            <input type="text" name="search" id="search" class="form-control" placeholder="Cari detail, hari, jam..." value="{{ request('search') }}">
                        </div>

                        <div class="col-md-3 col-12 d-flex gap-2">
                            <button type="submit" class="btn btn-primary w-100">
                                <i class="mdi mdi-magnify"></i> Cari
                            </button>
                            <a href="{{ route('detail-itinerary.index') }}" class="btn btn-light w-100">
                                <i class="mdi mdi-refresh"></i> Reset
                            </a>
                        </div>
                    </div>
                </form>

                {{-- LIST ITINERARY --}}
                @forelse ($detail_itinerary as $item)
                    <div class="card mb-3 border rounded shadow-sm bg-dark text-white">
                        <div class="card-body">
                            <h5 class="card-title">{{ $item->paket->paket_title ?? '-' }}</h5>
                            <p><strong>Hari ke-</strong> {{ $item->day }}</p>
                            <p><strong>Jam:</strong> {{ \Carbon\Carbon::parse($item->time)->format('H:i') }}</p>
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
                    <div class="alert alert-info text-center">Belum ada data list itinerary</div>
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

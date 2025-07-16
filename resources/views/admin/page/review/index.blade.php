@extends('admin.layouts.master')

@push('styles')
<link rel="stylesheet" href="{{ asset('css/admin/dashboard-home.css') }}">
<link rel="stylesheet" href="{{ asset('css/admin/delete-confirmation.css') }}">
<link rel="stylesheet" href="{{ asset('css/admin/flash-messages.css') }}">
@endpush

@section('icon-title')
<i class="mdi mdi-star"></i>
@endsection

@section('title', 'Data Review')

@section('content')

<!-- Flash Messages -->
@include('admin.components.flash-messages')

<!-- Dashboard Stats -->
<div class="row mb-4">
    <div class="col-xl-3 col-lg-6 col-md-6 mb-4">
        <div class="stats-card">
            <div class="stats-icon bg-primary">
                <i class="mdi mdi-star"></i>
            </div>
            <div class="stats-content">
                <h3>{{ $reviews->count() }}</h3>
                <p>Total Review</p>
            </div>
        </div>
    </div>
    <div class="col-xl-3 col-lg-6 col-md-6 mb-4">
        <div class="stats-card">
            <div class="stats-icon bg-success">
                <i class="mdi mdi-star-circle"></i>
            </div>
            <div class="stats-content">
                <h3>{{ $reviews->where('bintang', '>=', 4)->count() }}</h3>
                <p>Review Positif</p>
            </div>
        </div>
    </div>
    <div class="col-xl-3 col-lg-6 col-md-6 mb-4">
        <div class="stats-card">
            <div class="stats-icon bg-info">
                <i class="mdi mdi-calculator"></i>
            </div>
            <div class="stats-content">
                <h3>{{ $reviews->count() > 0 ? number_format($reviews->avg('bintang'), 1) : '0' }}</h3>
                <p>Rata-rata Rating</p>
            </div>
        </div>
    </div>
    <div class="col-xl-3 col-lg-6 col-md-6 mb-4">
        <div class="stats-card">
            <div class="stats-icon bg-warning">
                <i class="mdi mdi-clock"></i>
            </div>
            <div class="stats-content">
                <h3>{{ $reviews->where('created_at', '>=', now()->subDays(7))->count() }}</h3>
                <p>Baru (7 Hari)</p>
            </div>
        </div>
    </div>
</div>

<!-- Main Content Grid -->
<div class="row">
    <!-- Reviews Column -->
    <div class="col-lg-8 mb-4">
        <div class="card">
            <div class="card-header">
                <h5 class="mb-0">
                    <i class="mdi mdi-star me-2"></i>Daftar Review Pelanggan
                </h5>
            </div>
            <div class="card-body">
                @forelse ($reviews as $review)
                <div class="review-item mb-4">
                    <div class="row align-items-center">
                        <div class="col-lg-8 col-md-7">
                            <div class="review-content">
                                <div class="review-header">
                                    <h6 class="review-name">{{ $review->nama }}</h6>
                                    <div class="review-rating">
                                        @for($i = 1; $i <= 5; $i++)
                                            <i class="mdi mdi-star {{ $i <= $review->bintang ? 'text-warning' : 'text-muted' }}"></i>
                                        @endfor
                                        <span class="rating-text">({{ $review->bintang }}/5)</span>
                                    </div>
                                </div>
                                <p class="review-text">{{ $review->review }}</p>
                                <div class="review-meta">
                                    <span class="meta-item">
                                        <i class="mdi mdi-calendar-clock"></i>
                                        {{ $review->created_at->format('d M Y, H:i') }}
                                    </span>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-5">
                            <div class="review-actions">
                                <form action="{{ route('review.destroy', $review->id) }}" 
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
                @empty
                <div class="empty-state">
                    <div class="empty-icon">
                        <i class="mdi mdi-star-off"></i>
                    </div>
                    <h5>Belum Ada Review</h5>
                    <p>Bagikan link review untuk mulai mengumpulkan feedback dari pelanggan.</p>
                    <a href="{{ route('review.generate-link') }}" class="btn btn-primary">
                        <i class="mdi mdi-link me-2"></i>Generate Link Review
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
            <div class="card-header">
                <h6 class="mb-0">
                    <i class="mdi mdi-lightning-bolt me-2"></i>Aksi Cepat
                </h6>
            </div>
            <div class="card-body">
                <div class="quick-actions">
                    <a href="{{ route('review.generate-link') }}" class="quick-action-btn">
                        <i class="mdi mdi-link"></i>
                        <span>Generate Link Review</span>
                    </a>
                </div>
            </div>
        </div>

        <!-- Review Statistics -->
        @if($reviews->count() > 0)
        <div class="card">
            <div class="card-header">
                <h6 class="mb-0">
                    <i class="mdi mdi-chart-bar me-2"></i>Statistik Rating
                </h6>
            </div>
            <div class="card-body">
                <div class="rating-stats">
                    @for($i = 5; $i >= 1; $i--)
                    @php
                        $count = $reviews->where('bintang', $i)->count();
                        $percentage = $reviews->count() > 0 ? ($count / $reviews->count()) * 100 : 0;
                    @endphp
                    <div class="rating-stat-item">
                        <div class="rating-stat-label">
                            {{ $i }} <i class="mdi mdi-star text-warning"></i>
                        </div>
                        <div class="rating-stat-bar">
                            <div class="rating-stat-progress" style="width: {{ $percentage }}%"></div>
                        </div>
                        <div class="rating-stat-count">{{ $count }}</div>
                    </div>
                    @endfor
                </div>
            </div>
        </div>
        @endif
    </div>
</div>
                        Generate Link Review
                    </a>
                </div>
            </div>
        </div>
    @endforelse
</div>

{{-- Delete Confirmation Modal --}}
<div class="modal fade" id="deleteReviewModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">
                    <i class="fas fa-exclamation-triangle text-warning me-2"></i>
                    Konfirmasi Hapus Review
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <p>Apakah Anda yakin ingin menghapus review dari <strong id="reviewerName"></strong>?</p>
                <p class="text-muted small">Review yang dihapus tidak dapat dikembalikan.</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                <form id="deleteReviewForm" method="POST" class="d-inline">
                    @csrf
                    @method("DELETE")
                    <button type="submit" class="btn btn-danger">
                        <i class="fas fa-trash me-1"></i>
                        Hapus Review
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
function confirmDeleteReview(id, name) {
    document.getElementById('reviewerName').textContent = name;
    document.getElementById('deleteReviewForm').action = `/dashboard/review/${id}`;
    new bootstrap.Modal(document.getElementById('deleteReviewModal')).show();
}
</script>

@endsection

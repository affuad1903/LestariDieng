{{-- Flash Messages Component --}}
{{-- Usage: @include('admin.components.flash-messages') --}}

<!-- Success Alert -->
@if (session('success'))
<div class="alert alert-success alert-dismissible fade show" role="alert">
    <div class="d-flex align-items-start">
        <div class="success-icon me-3">
            <i class="mdi mdi-check-circle"></i>
        </div>
        <div class="success-content flex-grow-1">
            <h6 class="mb-1 fw-bold">Berhasil!</h6>
            <p class="mb-0">{{ session('success') }}</p>
        </div>
    </div>
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
@endif

<!-- Error Alert -->
@if (session('error'))
<div class="alert alert-danger alert-dismissible fade show" role="alert">
    <div class="d-flex align-items-start">
        <div class="error-icon me-3">
            <i class="mdi mdi-alert-circle"></i>
        </div>
        <div class="error-content flex-grow-1">
            <h6 class="mb-1 fw-bold">Terjadi Kesalahan!</h6>
            <p class="mb-0">{{ session('error') }}</p>
        </div>
    </div>
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
@endif

<!-- Info Alert -->
@if (session('info'))
<div class="alert alert-info alert-dismissible fade show" role="alert">
    <div class="d-flex align-items-start">
        <div class="info-icon me-3">
            <i class="mdi mdi-information"></i>
        </div>
        <div class="info-content flex-grow-1">
            <h6 class="mb-1 fw-bold">Informasi</h6>
            <p class="mb-0">{{ session('info') }}</p>
        </div>
    </div>
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
@endif

<!-- Warning Alert -->
@if (session('warning'))
<div class="alert alert-warning alert-dismissible fade show" role="alert">
    <div class="d-flex align-items-start">
        <div class="warning-icon me-3">
            <i class="mdi mdi-alert"></i>
        </div>
        <div class="warning-content flex-grow-1">
            <h6 class="mb-1 fw-bold">Peringatan!</h6>
            <p class="mb-0">{{ session('warning') }}</p>
        </div>
    </div>
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
@endif

<!-- Validation Errors -->
@if ($errors->any())
<div class="alert alert-danger alert-dismissible fade show" role="alert">
    <div class="d-flex align-items-start">
        <div class="error-icon me-3">
            <i class="mdi mdi-alert-circle"></i>
        </div>
        <div class="error-content flex-grow-1">
            <h6 class="mb-1 fw-bold">Terjadi Kesalahan Validasi!</h6>
            <ul class="mb-0 ps-3">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    </div>
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
@endif

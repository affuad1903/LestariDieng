@extends('layouts.master')

@section('title', 'Kontak Kami Lestari Wisata Dieng | Dapatkan Penawaran Paket Wisata Terbaik')
@section('meta_description', 'Hubungi Lestari Wisata Dieng untuk mendapatkan penawaran terbaik paket wisata eksklusif. Nikmati perjalanan seru dan tak terlupakan di Dieng!')
@section('content')
<section class="container-fluid">
    {{-- Header --}}
    <header class="row custom-container-header text-white mb-2">
        <h2 class="text-center fw-bold  responsive-text">Kontak Kami</h2>
        <p class="mt-3 text-center responsive-text-content">Punya pertanyaan atau butuh informasi lebih lanjut tentang layanan kami? Jangan ragu untuk menghubungi kami! Kami siap membantu dan memberikan solusi terbaik untuk perjalanan Anda.</p>
    </header>
    {{-- /Header --}}
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class="ri-check-circle-line me-2"></i>
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    @if(session('warning'))
        <div class="alert alert-warning alert-dismissible fade show" role="alert">
            <i class="ri-alert-line me-2"></i>
            {{ session('warning') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <i class="ri-error-warning-line me-2"></i>
            {{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    @if($errors->any())
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <i class="ri-error-warning-line me-2"></i>
            <strong>Mohon periksa kembali:</strong>
            <ul class="mb-0 mt-2">
                @foreach($errors->all() as $error)
                    <li class="small">{{ $error }}</li>
                @endforeach
            </ul>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
    {{-- Section Contact --}}
    <section class=" pt-4 col-12 d-flex justify-content-center">
        <div class="py-4 px-2 my-3 mx-2 custom-border-kontak row">
            <div class="col-sm-12 col-md-6">
                <section class="col-sm-12  text-white">
                    <a href="" class="d-flex align-items-center mb-4">
                        <i class="mx-1 custom-footer-logo-socmed ri-instagram-line"></i>
                        <section class="responsive-text-content">
                            <p>Instagram</p>
                            <p>lestariwisatadieng</p>
                        </section>
                    </a>
                    <a href="" class="d-flex align-items-center mb-4">
                        <i class="mx-1 custom-footer-logo-socmed ri-tiktok-line "></i>
                        <section class="responsive-text-content">
                            <p>Tiktok</p>
                            <p>lestariwisatadieng</p>
                        </section>
                    </a>
                    <a href="" class="d-flex align-items-center mb-4">
                        <i class="mx-1 custom-footer-logo-socmed ri-whatsapp-line"></i>
                        <section class="responsive-text-content">
                            <p>Whatsapp</p>
                            <p>(+62) 851 5946 6573</p>
                        </section>
                    </a>
                </section>
            </div>
            <div class="col-sm-12 col-md-6">
                <form action="{{ route('kontak.kirim') }}" method="POST" class="col-sm-12" id="contactForm">
                    @csrf
                    <!-- Honeypot field untuk mencegah spam bot -->
                    <input type="text" name="website" style="display:none;" tabindex="-1" autocomplete="off">
                    
                    <div class="input-group mb-2">
                        <span class="input-group-text me-2"><i class="ri-user-smile-line"></i></span>
                        <input class="form-control @error('contactus_name') is-invalid @enderror" 
                               type="text" 
                               name="contactus_name" 
                               placeholder="Tulis nama lengkap Anda" 
                               value="{{ old('contactus_name') }}"
                               required>
                        @error('contactus_name')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    
                    <div class="input-group mb-2">
                        <span class="input-group-text me-2"><i class="ri-phone-line"></i></span>
                        <input class="form-control @error('contactus_phone') is-invalid @enderror" 
                               type="tel" 
                               name="contactus_phone" 
                               placeholder="Contoh: 081234567890 atau +6281234567890" 
                               value="{{ old('contactus_phone') }}"
                               pattern="^(\+62|62|0)[0-9]{8,13}$"
                               required>
                        @error('contactus_phone')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    
                    <div class="input-group mb-2">
                        <span class="input-group-text me-2"><i class="ri-mail-line"></i></span>
                        <input class="form-control @error('contactus_email') is-invalid @enderror" 
                               type="email" 
                               name="contactus_email" 
                               placeholder="Contoh: nama@email.com" 
                               value="{{ old('contactus_email') }}"
                               required>
                        @error('contactus_email')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    
                    <div class="mb-2">
                        <input class="form-control @error('contactus_subject') is-invalid @enderror" 
                               type="text" 
                               name="contactus_subject" 
                               placeholder="Subjek pesan (contoh: Tanya Paket Wisata Dieng)" 
                               value="{{ old('contactus_subject') }}"
                               required>
                        @error('contactus_subject')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    
                    <div class="mb-3">
                        <textarea class="form-control @error('contactus_message') is-invalid @enderror" 
                                  name="contactus_message" 
                                  rows="6" 
                                  placeholder="Tulis pesan Anda di sini..." 
                                  required>{{ old('contactus_message') }}</textarea>
                        @error('contactus_message')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                        <div class="form-text text-white">Maksimal 1000 karakter</div>
                    </div>
                    
                    <button class="btn btn-light" type="submit" id="submitBtn">
                        <i class="ri-send-plane-line me-2"></i>Kirim Pesan
                    </button>
                </form>
            </div>
        </div> 
    </section>
    {{-- /Section Contact --}}
</section>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const form = document.getElementById('contactForm');
    const submitBtn = document.getElementById('submitBtn');
    const originalBtnText = submitBtn.innerHTML;
    
    // Form submission handler
    form.addEventListener('submit', function() {
        submitBtn.disabled = true;
        submitBtn.innerHTML = '<span class="spinner-border spinner-border-sm me-2" role="status" aria-hidden="true"></span>Mengirim...';
        
        // Re-enable button after timeout as fallback
        setTimeout(function() {
            submitBtn.disabled = false;
            submitBtn.innerHTML = originalBtnText;
        }, 10000);
    });
    
    // Phone number validation
    const phoneInput = document.querySelector('input[name="contactus_phone"]');
    phoneInput.addEventListener('input', function(e) {
        let value = e.target.value.replace(/[^\d+]/g, '');
        
        // Auto format Indonesian phone numbers
        if (value.startsWith('08')) {
            value = '+62' + value.substring(1);
        } else if (value.startsWith('8')) {
            value = '+62' + value;
        }
        
        e.target.value = value;
    });
    
    // Character counter for message
    const messageTextarea = document.querySelector('textarea[name="contactus_message"]');
    const messageCounter = document.createElement('div');
    messageCounter.className = 'form-text text-end';
    messageTextarea.parentNode.appendChild(messageCounter);
    
    function updateCounter() {
        const remaining = 1000 - messageTextarea.value.length;
        messageCounter.textContent = `${remaining} karakter tersisa`;
        messageCounter.className = remaining < 100 ? 'form-text text-end text-warning' : 'form-text text-end text-white';
    }
    
    messageTextarea.addEventListener('input', updateCounter);
    updateCounter();
    
    // Auto-hide alerts after 5 seconds
    const alerts = document.querySelectorAll('.alert');
    alerts.forEach(alert => {
        setTimeout(() => {
            const bsAlert = new bootstrap.Alert(alert);
            bsAlert.close();
        }, 5000);
    });
});
</script>

@endsection
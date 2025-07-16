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
                <form action="col-sm-12">
                    <div class="input-group mb-2">
                        <div class="input-group-prepend d-flex align-items-center responsive-text-content">
                            <span class="input-group-text me-2"><i class="ri-user-smile-line"></i></span>
                        </div>
                        <input 
                        class="form-control responsive-text-content"
                        type="text" 
                        name="contactus_name" 
                        id="contactus_name" 
                        placeholder="Tulis namamu disini"
                        >
                    </div>
                    <div class="input-group mb-2">
                        <div class="input-group-prepend d-flex align-items-center responsive-text-content">
                            <span class="input-group-text me-2"><i class="ri-phone-line"></i></span>
                        </div>
                        <input 
                        class="form-control responsive-text-content"
                        type="number" 
                        name="contactus_name" 
                        id="contactus_name" 
                        placeholder="Tulis nomermu disini"  
                        oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');"
                        >
                    </div>
                    <div class="input-group mb-2">
                        <div class="input-group-prepend d-flex align-items-center responsive-text-content">
                            <span class="input-group-text me-2"><i class="ri-mail-line"></i></span>
                        </div>
                        <input 
                        class="form-control responsive-text-content" 
                        type="email" 
                        name="contactus_email" 
                        id="contactus_email"
                        placeholder="Tulis email mu disini"
                        >
                    </div>
                    <div>
                        <input
                        class="form-control mb-2 responsive-text-content" 
                        type="text" 
                        name="contactus_subject" 
                        id="contactus_subject"
                        placeholder="Subject"
                        >
                    </div>
                    <div>
                        <textarea 
                        class="form-control mb-2 responsive-text-content"
                        name="contactus_message" 
                        id="contactus_message" 
                        rows="10"
                        placeholder="Pesan"
                        ></textarea>
                    </div>
                </form>
            </div>
        </div> 
    </section>
    {{-- /Section Contact --}}
</section>
@endsection
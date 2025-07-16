@extends('layouts.master')

@section('title', 'Paket Jeep Lestari Wisata Dieng | Paket Wisata Terbaik ke Negeri di Atas Awan')
@section('meta_description', 'Jelajahi Keindahan Dieng dengan Hemat! Pilih Paket Wisata Dieng Terbaik untuk Liburan Anda')
@section('content')
<section class="container-fluid mb-5">
    <button class="custom-back fw-bold" id="back"><i class="ri-arrow-left-s-line"></i><a href="{{url('/paket-index')}}">Kembali</a></button>
    {{-- Header --}}
    <header class="row custom-container-header text-white mb-2">
        <h2 class="text-center fw-bold  responsive-text">Jeep Dieng Park & Sikidang</h2>
        <p class="mt-2 text-center responsive-text-content">Paket Jeep Lestari WIsata Dieng</p>
    </header>
    {{-- /Header --}}
    {{-- Section: Content --}}
    <section>
        <section class="row py-3 my-3">  
            <img class="col-sm-12 col-md-12 col-lg-8" style="border-radius: 5%" src="{{ asset('/image/head.jpg') }}" alt="Keindahan Candi Arjuna" title="Candi Arjuna - Salah Satu Candi Hindu Tertua di Indonesia"  loading="lazy">
            <div class="col-sm-12 col-md-12 col-lg-4 responsive-text-content">
                <article class="card custom-cardShadow">
                    <span class="badge rounded-pill bg-info text-white position-absolute top-0 start-0 m-2 p-2">Ringkasan</span>
                    <div class="card-body">
                        <section class="d-flex justify-content-start mt-4">
                            <i class="ri-timer-2-line me-1"></i>
                            <p>1 Day 1 Malam</p>
                        </section>
                        <section class="toggleBtn px-3 d-flex justify-content-between my-2">
                            <button>Destinasi </button>
                            <i class="ri-arrow-right-circle-line icon"></i>
                        </section>
                        <ul id="contentBtn">
                            <li><i class="ri-map-pin-line me-2"></i>Kebun Teh Tambi</li>
                            <li><i class="ri-map-pin-line me-2"></i>Candi Arjuna</li>
                            <li><i class="ri-map-pin-line me-2"></i>Batu Pandang Ratapan Angin</li>
                            <li><i class="ri-map-pin-line me-2"></i>Dieng Plateau Theater</li>
                        </ul>
                        <section class="toggleBtn px-3 d-flex justify-content-between my-2">
                            <button>Fasilitas </button>
                            <i class="ri-arrow-right-circle-line icon"></i>
                        </section>
                        <ul id="contentBtn">
                            <li><i class="ri-check-line"></i>Kebun Teh Tambi</li>
                            <li><i class="ri-check-line"></i>Candi Arjuna</li>
                            <li><i class="ri-check-line"></i>Batu Pandang Ratapan Angin</li>
                            <li><i class="ri-check-line"></i>Dieng Plateau Theater</li>
                        </ul>
                    </div>
                </article>
                <section class="text-center">
                    <button class=" mt-4 px-4 py-2 rounded-pill text-center custom-borderContent fw-bold" data-bs-toggle="modal" data-bs-target="#orderModal" >Informasi Harga</button>
                </section>
            </div>
        </section>

        {{-- Section Itinerary --}}
        <section class=" mt-4">
            <section class="col">
                <section class="custom-contentHeader toggleBtn px-3 d-flex justify-content-between custom-nav fw-bold">
                    <button>Itinerary </button>
                    <i class="ri-arrow-right-wide-line icon"></i>
                </section>
                <ul id="contentBtn" class="responsive-text-content">
                    <li class="row">
                        <div class="col-2 col-sm-2 col-md-2 col-lg-1 col-xl-1">
                            07:00:
                        </div>
                        <div class="col p-0 text-start">
                            Kebun Teh Tambi
                        </div>
                    </li>
                    <li class="row">
                        <div class="col-2 col-sm-2 col-md-2 col-lg-1 col-xl-1">
                            07:00:
                        </div>
                        <div class="col p-0 text-start">
                            Kebun Teh Tambi
                        </div>
                    </li>
                </ul>
            </section>
        </section>
        {{-- Section Itinerary --}}
    </section>
    {{-- /Section: Content --}}

    {{-- Section Modal --}}
    <section class="modal fade" id="orderModal" tabindex="-1" aria-labelledby="orderModalLabel" aria-hidden="true">
        <section class="modal-dialog">
            <section class="modal-content row">
                <section class="col">
                    <hgroup class="modal-header justify-content-between" style="color:rgb(24, 111, 120); ">
                        <h2 class="modal-title custom-contentHeader fw-bold" id="orderModalLabel">Informasi Harga</h2>
                        <button type="button" class="close custom-modal" data-bs-dismiss="modal" aria-label="Close">
                            <i class="ri-close-large-line"></i>
                        </button>
                    </hgroup>
                    <section class="modal-body row responsive-text-content">
                        <p class="mb-4">Silahkan isi form dibawah ini, kami akan informasikan harga sesuai kebutuhan anda.</p>
                        <form id="orderForm" class="row d-flex flex-column">
                            @csrf
                            <label class="form-label fw-bold" for="namaPaket">Paket Wisata</label>
                            <input type="text"  class="border rounded col-12 px-2 py-1" name="namaPaket" id="namaPaket" value="namaPaket" disabled>
                            <label class="form-label fw-bold" for="jumlahPeserta">Jumlah Peserta</label>
                            <input type="number"  class="border rounded col-12 px-2 py-1" name="jumlahPeserta" id="jumlahPeserta" required min="1" placeholder="1">
                            <label class="form-label fw-bold" for="tanggalKeberangkatan">Tanggal Keberangkatan</label>
                            <input type="date" class="border rounded col-12 px-2 py-1" name="tanggalKeberangkatan" id="tanggalKeberangkatan">
                            <button type="submit" class="px-4 py-2 mt-3 rounded-pill text-center custom-borderContent col-12">CEK HARGA</button>
                        </form>
                    </section>
                </section>
            </section>
        </section>
    </section>
    {{-- /Section Modal --}}
</section>

@endsection

@section('script')
    <script>
        const toggle = document.getElementsByClassName('toggleBtn');
        const icon = document.getElementsByClassName('icon');
        for(let i=0;i<toggle.length;i++){
            toggle[i].addEventListener("click", function(){
                this.classList.toggle("active");
                let content = this.nextElementSibling;
                if( content.style.maxHeight){
                        content.style.maxHeight= null;
                        content.style.opacity=0;
                        icon[i].style.transition="0.3s";
                        icon[i].style.transform="rotate(0deg)";
                    }else{
                        content.style.maxHeight = content.scrollHeight + "px";
                        content.style.opacity=1;
                        icon[i].style.transition="0.3s";
                        icon[i].style.transform="rotate(90deg)";
                    }
            })
        }

        document.getElementById("orderForm").addEventListener("submit", function (e) {
            e.preventDefault(); 
            let namaPaket = document.getElementById("namaPaket").value;
            let jumlahPeserta = document.getElementById("jumlahPeserta").value;
            let tanggalKeberangkatan = document.getElementById("tanggalKeberangkatan").value;
            let message = 
            `Halo, saya ingin memesan paket wisata. Berikut detailnya:
            - Nama Paket: ${namaPaket}
            - Jumlah Peserta: ${jumlahPeserta}
            - Tanggal Keberangkatan: ${tanggalKeberangkatan}`;
            let encodedMessage = encodeURIComponent(message);
            let phoneNumber = "6285159466573"; // Nomor dengan format internasional (tanpa +)
            window.open(`https://wa.me/${phoneNumber}?text=${encodedMessage}`, "_blank");
        });

        const back = document.getElementById('back').addEventListener("click", function(){
            if(this.classList.contains("backClicked")==false){
                this.classList.add("backClicked");
            }
        })
    </script>
@endsection

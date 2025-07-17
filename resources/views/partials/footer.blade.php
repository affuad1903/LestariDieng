<section class="container-fluid custom-background">
    <div class="d-flex justify-content-start">
        <a href="" class="my-3 mx-3 custom-footer-logo-socmed"><i class="ri-instagram-line"></i></a>
        <a href="" class="my-3 mx-3 custom-footer-logo-socmed"><i class="ri-tiktok-line "></i></a>
    </div>
</section>
<section class="container-fluid " style="background-color: #239ba8">
    <div class="row container-footer">
        <section class="col-sm-6 mb-4">
            <div class="row" >
                <img src="{{ asset('image/home/'.$home->logo) }}" class="img-fluid object-contain" alt="Logo {{$home->title}}" style="max-width: 200px; height: auto;">
            </div>
            <p class="row mt-4 text-white text-center text-md-start">{{$home->tag_line}}</p>
        </section>
        <section class="col-sm-6">
            <div class="row">
                <section class="col-sm-12 col-md-12 col-lg-6 col-xl-4 text-white mb-4">
                    <h2 class="row fs-4 fw-bold mb-3">Kontak</h2>
                    <ul class="custom-ul">
                        @forelse ($home->contacts as $item)
                        <li class="custom-footerLink">
                            <a href="{{ $item->url }}" class="text-decoration-none text-white">
                                <i class="{{$item->icon}}"></i> {{$item->detail}}
                            </a>
                        </li>
                        @empty
                        <li class="custom-footerLink">
                            <i class="ri-close-line"></i>Belum ada data yang ditambahkan
                        </li>
                        @endforelse
                    </ul>
                </section>
                <section class="col-sm-12 col-md-12 col-lg-6 col-xl-4 text-white mb-4">
                    <h2 class="row fs-4 fw-bold mb-3">Link Pintas</h2>
                    <nav>
                        <ul class="custom-ul">
                            <li class="custom-footerLink">
                                <a href="{{url('/')}}">Beranda</a>
                            </li>
                            <li class="custom-footerLink">
                                <a href="{{url('/destinasi-index')}}">Destinasi</a>
                            </li>
                            <li class="custom-footerLink">
                                <a href="{{url('/paket-index')}}">Paket Wisata</a>
                            </li>
                            <li class="custom-footerLink">
                                <a href="{{url('/paket-jeep-index')}}">Paket Jeep</a>
                            </li>
                            <li class="custom-footerLink">
                                <a href="{{url('/galeri-index')}}">Galeri</a>
                            </li>
                        </ul>
                    </nav>
                </section>
                <section class="col-sm-12 col-md-12 col-lg-6 col-xl-4 text-white mb-4">
                    <h2 class="row fs-4 fw-bold mb-3">Legalitas</h2>
                    <ul class="custom-ul">
                        <li class="custom-footerLink">
                            <p>NPWP XX.XXX.XXX.X-XXX.XXX</p>
                        </li>
                    </ul>
                </section>
            </div>
        </section>
        <section class="col-sm-12 text-center text-white">
            <p class="responsive-text-content">&copy;Copyright {{ date('Y') }} {{$home->title}} &VerticalSeparator; Powered By </p>
        </section>
    </div>
</section>

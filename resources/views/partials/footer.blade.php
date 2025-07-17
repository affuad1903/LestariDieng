{{-- Sosial Media --}}
<section class="container-fluid custom-background">
    <div class="d-flex justify-content-start flex-wrap px-3 py-2">
        @foreach ($home->socialMedias as $socmed)
            <a href="{{ $socmed->url }}" target="_blank" class="my-2 mx-2 custom-footer-logo-socmed">
                <i class="{{ $socmed->icon }}"></i>
            </a>
        @endforeach
    </div>
</section>

{{-- Footer Utama --}}
<section class="container-fluid" style="background-color: #239ba8">
    <div class="row container-footer py-4">
        {{-- Logo dan Tagline --}}
        <section class="col-sm-6 mb-4">
            <div class="mb-3">
                <img src="{{ asset('image/home/'.$home->logo) }}" class="img-fluid" alt="Logo {{ $home->title }}"
                    style="max-width: 200px; height: auto;">
            </div>
            <p class="text-white text-center text-md-start responsive-text-content">{{ $home->tag_line }}</p>
        </section>

        {{-- Navigasi dan Informasi --}}
        <section class="col-sm-6">
            <div class="row">
                {{-- Kontak --}}
                <section class="col-sm-12 col-md-6 text-white mb-4">
                    <h2 class="custom-contentHeader text-white">Kontak</h2>
                    <ul class="list-unstyled">
                        @forelse ($home->contacts as $item)
                            <li class="custom-footerLink">
                                <a href="{{ $item->url }}" class="text-decoration-none text-white d-flex">
                                    <i class="{{ $item->icon }} me-2"></i>
                                    <span class="text-break">{{ $item->detail }}</span>
                                </a>
                            </li>
                        @empty
                            <li><i class="ri-close-line"></i> Belum ada data yang ditambahkan</li>
                        @endforelse
                    </ul>
                </section>

                {{-- Link Pintas --}}
                <section class="col-sm-12 col-md-6 text-white mb-4">
                    <h2 class="custom-contentHeader text-white">Link Pintas</h2>
                    <ul class="list-unstyled custom-ul">
                        <li class="custom-footerLink"><a href="{{ url('/') }}" class="text-white text-decoration-none">Beranda</a></li>
                        <li class="custom-footerLink"><a href="{{ url('/destinasi-index') }}" class="text-white text-decoration-none">Destinasi</a></li>
                        <li class="custom-footerLink"><a href="{{ url('/paket-index') }}" class="text-white text-decoration-none">Paket Wisata</a></li>
                        <li class="custom-footerLink"><a href="{{ url('/paket-jeep-index') }}" class="text-white text-decoration-none">Paket Jeep</a></li>
                        <li class="custom-footerLink"><a href="{{ url('/galeri-index') }}" class="text-white text-decoration-none">Galeri</a></li>
                    </ul>
                </section>

                {{-- Legalitas --}}
                <section class="col-sm-12 col-md-12 text-white mb-4">
                    <h2 class="custom-contentHeader text-white">Legalitas</h2>
                    <ul class="list-unstyled">
                        @forelse ($home->legalities as $legal)
                            <li class="custom-footerLink">{{ $legal->type }} - {{ $legal->number }}</li>
                        @empty
                            <li><i class="ri-close-line"></i> Belum ada data legalitas</li>
                        @endforelse
                    </ul>
                </section>
            </div>
        </section>

        {{-- Copyright --}}
        <section class="col-12 text-center text-white pt-3 border-top">
            <p class="responsive-text-content mb-0">
                &copy; {{ date('Y') }} {{ $home->title }} &VerticalSeparator; Powered by Lestari Tech
            </p>
        </section>
    </div>
</section>

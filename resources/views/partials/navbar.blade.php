<div class="offcanvas custom-offcanvas offcanvas-end text-bg-white" tabindex="-1" id="offcanvasNavbar" aria-labelledby="offcanvasNavbarLabel">
    <header class="offcanvas-header">
      <h2 id="offcanvasNavbarLabel" class="visually-hidden">Menu Navigasi</h2>
      <button type="button" class="btn-close btn-close-dark" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </header>
    <div class="offcanvas-body">
      <ul class="navbar-nav justify-content-end flex-grow-1 text-end" role="navigation">
        <li class="nav-item custom-nav mb-4 mt-3">
            <a class="nav-link custom-navlink {{ Request::is('/') ? 'actived' : '' }}"  href="{{url('/')}}">Beranda</a>
        </li>
        <li class="nav-item custom-nav mb-4">
            <a class="nav-link custom-navlink {{ Request::is('destinasi-index') ? 'actived' : '' }}" href="{{url('/destinasi-index')}}">Destinasi</a>
        </li>
        <li class="nav-item custom-nav mb-4">
            <a class="nav-link custom-navlink {{ Request::is('paket-index') ? 'actived' : '' }}" href="{{url('/paket-index')}}">Paket Wisata</a>
        </li>
        <li class="nav-item custom-nav mb-4">
          <a class="nav-link custom-navlink {{ Request::is('paket-jeep-index') ? 'actived' : '' }}" href="{{url('/paket-jeep-index')}}">Paket Jeep</a>
        </li>
        <li class="nav-item custom-nav mb-4">
          <a class="nav-link custom-navlink {{ Request::is('galeri-index') ? 'actived' : '' }}" href="{{url('/galeri-index')}}">Galeri</a>
        </li>
        <li class="nav-item custom-nav mb-4">
          <a class="nav-link custom-navlink {{ Request::is('kontak-index') ? 'actived' : '' }}" href="{{url('/kontak-index')}}">Kontak Kami</a>
        </li>
      </ul>
    </div>
</div>
<noscript>
  <nav>
    <ul role="navigation">
      <li><a href="{{url('/')}}">Beranda</a></li>
      <li><a href="{{url('/destinasiIndex')}}">Destinasi</a></li>
      <li><a href="{{url('/paketIndex')}}">Paket Wisata</a></li>
    </ul>
  </nav>
</noscript>
<div class="container">
  <section id="headerBg" class="container-header-nav fixed top-0 left-0 w-full transition-all duration-300 z-50 bg-transparent text-white">
    <div class="d-flex align-items-center justify-content-between ">
      <section class="d-flex items-center">
        <!-- LOGO -->
        <img src="{{ asset('image/logo.png') }}" 
        class="img-fluid me-3"
        alt="Logo Lestari Wisata Dieng - Agen Tour Dieng" 
        title="Lestari Wisata Dieng"
        itemprop="logo"
        loading="lazy"
        style="max-width: 60px; height: auto;"> 

        <!-- HEADER TITLE -->
        <a href="{{ url('/') }}" class="text-decoration-none flex-grow-1 text-center">
          <h1 id="header-title" class="fw-bold text-uppercase m-0 responsive-text" itemprop="name">
            Lestari Wisata Dieng
          </h1>
        </a>
      </section>

      <!-- MENU BUTTON -->
      <nav>
        <button class="focus:outline-none text-2xl ri-menu-2-line" data-bs-toggle="offcanvas" data-bs-target="#offcanvasNavbar" aria-label="Menu Navigasi"></button>
        @include('partials.navbar')
      </nav>
    </div>
  </section>
</div>


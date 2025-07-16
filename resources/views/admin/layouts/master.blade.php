<!DOCTYPE html>
<html lang="id">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="author" content="Lestari Wisata Dieng">
    <meta name="robots" content="noindex, nofollow">
    <link rel="icon" type="image/png" href="{{ asset('image/logo.png') }}">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title', 'Dashboard') - Lestari Wisata Dieng Admin</title>
    
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <!-- Material Design Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@mdi/font@7.2.96/css/materialdesignicons.min.css">
    
    <!-- Remix Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/remixicon/fonts/remixicon.css">
    
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    
    <!-- Admin Dashboard Styles -->
    <link rel="stylesheet" href="{{ asset('css/admin/admin.css') }}">
    
    <!-- Page Specific Styles -->
    @stack('styles')
</head>
<body>
    <!-- Sidebar -->
    <nav class="sidebar" id="sidebar">
        <div class="sidebar-header">
            <a href="{{ route('home.index') }}" class="sidebar-logo">
                <img src="{{ asset('image/logo.png') }}" alt="Logo">
                <span>LWD Admin</span>
            </a>
        </div>
        <ul class="sidebar-nav">
            <li class="nav-item">
                <a href="{{ route('home.index') }}" class="nav-link {{ request()->is('dashboard/home*') ? 'active' : '' }}" data-tooltip="Dashboard">
                    <i class="fas fa-home"></i>
                    <span>Dashboard</span>
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('destinasi.index') }}" class="nav-link {{ request()->is('dashboard/destinasi*') ? 'active' : '' }}" data-tooltip="Halaman Destinasi">
                    <i class="fas fa-map-marker-alt"></i>
                    <span>Halaman Destinasi</span>
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('paket.index') }}" class="nav-link {{ request()->is('dashboard/paket*') ? 'active' : '' }}" data-tooltip="Paket Wisata">
                    <i class="fas fa-box"></i>
                    <span>Paket Wisata</span>
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('daftar-d.index') }}" class="nav-link {{ request()->is('dashboard/daftar-d*') ? 'active' : '' }}" data-tooltip="Daftar Destinasi">
                    <i class="fas fa-list"></i>
                    <span>Daftar Destinasi</span>
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('daftar-fasilitas.index') }}" class="nav-link {{ request()->is('dashboard/daftar-fasilitas*') ? 'active' : '' }}" data-tooltip="Daftar Fasilitas">
                    <i class="fas fa-concierge-bell"></i>
                    <span>Daftar Fasilitas</span>
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('detail-itinerary.index') }}" class="nav-link {{ request()->is('dashboard/detail-itinerary*') ? 'active' : '' }}" data-tooltip="Daftar Itinerary">
                    <i class="fas fa-route"></i>
                    <span>Daftar Itinerary</span>
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('galery.index') }}" class="nav-link {{ request()->is('dashboard/galery*') ? 'active' : '' }}" data-tooltip="Galeri">
                    <i class="fas fa-images"></i>
                    <span>Galeri</span>
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('review.index') }}" class="nav-link {{ request()->is('dashboard/review*') ? 'active' : '' }}" data-tooltip="Review">
                    <i class="fas fa-star"></i>
                    <span>Review</span>
                </a>
            </li>
            <li class="nav-item">
                <a href="#" class="nav-link" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" data-tooltip="Logout">
                    <i class="fas fa-sign-out-alt"></i>
                    <span>Logout</span>
                </a>
            </li>
        </ul>
    </nav>

    <!-- Mobile Sidebar Overlay -->
    <div class="sidebar-overlay" id="sidebarOverlay"></div>

    <!-- Main Content Wrapper -->
    <div class="main-wrapper" id="mainWrapper">
        <!-- Top Navbar -->
        <nav class="top-navbar">
            <div class="d-flex align-items-center">
                <button class="navbar-toggle" id="sidebarToggle">
                    <i class="mdi mdi-menu"></i>
                </button>
                <h1 class="page-title">
                    @yield('icon-title')
                    @yield('title', 'Dashboard')
                </h1>
            </div>
            
            <div class="navbar-user">
                <div class="dropdown">
                    <div class="user-avatar" data-bs-toggle="dropdown" aria-expanded="false">
                        {{ strtoupper(substr(Auth::user()->name ?? 'A', 0, 1)) }}
                    </div>
                    <ul class="dropdown-menu dropdown-menu-end">
                        <li><h6 class="dropdown-header">{{ Auth::user()->name ?? 'Admin' }}</h6></li>
                        <li><hr class="dropdown-divider"></li>
                        <li>
                            <a class="dropdown-item" href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                <i class="mdi mdi-logout me-2"></i>Logout
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>

        <!-- Content Area -->
        <main class="content-area">
            @yield('content')
        </main>

        <!-- Footer -->
        <footer class="admin-footer">
            <div class="footer-content">
                <div class="footer-left">
                    <p>&copy; {{ date('Y') }} Lestari Wisata Dieng. All rights reserved.</p>
                </div>
                <div class="footer-right">
                    <p>Powered by LWD Admin Panel</p>
                </div>
            </div>
        </footer>
    </div>

    <!-- Image Modal (Global) -->
    <div class="modal fade" id="imageModal" tabindex="-1">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="imageModalTitle">Preview Image</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body text-center">
                    <img id="modalImage" src="" alt="" class="img-fluid rounded">
                </div>
            </div>
        </div>
    </div>

    <!-- Logout Form -->
    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
        @csrf
    </form>

    <!-- Bootstrap 5 JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    
    <!-- Dashboard Main JS -->
    <script src="{{ asset('js/admin/dashboard.js') }}"></script>
    
    <!-- Page Specific Scripts -->
    @stack('scripts')
    
    <!-- Custom Page Scripts -->
    @yield('script')
</body>
</html>
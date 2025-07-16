<!DOCTYPE html>
<html lang="id">
    <head>
        <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta name="author" content="Affandi Putra Pradana">
        <meta name="robots" content="index, follow">
        <link rel="icon" type="image/png" href="{{ asset('image/logo.png') }}">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>Login - Lestari Wisata Dieng Admin</title>
        
        <!-- Bootstrap CSS -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
        <!-- Font Awesome for icons -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
        <!-- Google Fonts -->
        <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
        
        <!-- plugins:css -->
        <link rel="stylesheet" href="{{asset('template/assets/vendors/mdi/css/materialdesignicons.min.css')}}">
        <link rel="stylesheet" href="{{asset('template/assets/vendors/css/vendor.bundle.base.css')}}">
        <link rel="stylesheet" href="{{asset('template/assets/vendors/remix-icon/fonts/remixicon.css')}}">
        <link rel="stylesheet" href="{{asset('template/assets/vendors/bootstrap-datepicker/bootstrap-datepicker.min.css')}}">
        <!-- endinject -->

        <!-- inject:css -->
        <link href="https://fonts.googleapis.com/css2?family=Ubuntu:wght@300;400;500;700&display=swap" rel="stylesheet">

        <!-- endinject -->
        <!-- Lightbox2 CSS -->
        <link href="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.11.4/css/lightbox.min.css" rel="stylesheet">

        <!-- Layout styles -->
        <link rel="stylesheet" href="{{asset('template/assets/css/style.css')}}">
        <!-- End layout styles -->
        
        <!-- Custom CSS for Login Page -->
        <link rel="stylesheet" href="{{ asset('css/admin/admin.css') }}">
    </head>
    <body class="auth-page">
        <!-- Floating background bubbles for auth pages -->
        <div class="floating-bubble"></div>
        <div class="floating-bubble"></div>
        <div class="floating-bubble"></div>
        <div class="floating-bubble"></div>
        <div class="floating-bubble"></div>
        
        <div class="register-container">
            <div class="register-card">
                <!-- Header -->
                <div class="register-header">
                    <div class="icon-container">
                        <i class="fas fa-sign-in-alt fa-2x"></i>
                    </div>
                    <h1>Login</h1>
                    <p class="subtitle">Sistem Administrasi Lestari Wisata Dieng</p>
                </div>

                <!-- Body -->
                <div class="register-body">
                    {{-- Alert Success --}}
                    @if (session('success'))
                        <div class="alert alert-success mb-4">
                            <i class="fas fa-check-circle me-2"></i>{{ session('success') }}
                        </div>
                    @endif

                    {{-- Alert Error --}}
                    @if ($errors->any())
                        <div class="alert alert-danger mb-4">
                            <i class="fas fa-exclamation-circle me-2"></i>
                            <ul class="mb-0">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    {{-- Form --}}
                    <form action="/login" method="POST" id="loginForm">
                        @csrf

                        {{-- Email --}}
                        <div class="form-group">
                            <label for="email" class="form-label">
                                <i class="fas fa-envelope me-2"></i>Alamat Email
                            </label>
                            <input type="email" name="email" id="email" class="form-control @error('email') is-invalid @enderror" 
                                   placeholder="contoh@email.com" value="{{ old('email') }}" required autofocus>
                            @error('email')
                                <div class="alert alert-danger mt-2">
                                    <i class="fas fa-exclamation-circle me-2"></i>{{ $message }}
                                </div>
                            @enderror
                        </div>

                        {{-- Password --}}
                        <div class="form-group">
                            <label for="password" class="form-label">
                                <i class="fas fa-lock me-2"></i>Kata Sandi
                            </label>
                            <div class="password-input-wrapper">
                                <input type="password" name="password" id="password" 
                                       class="form-control @error('password') is-invalid @enderror" 
                                       placeholder="Masukkan kata sandi" 
                                       autocomplete="current-password"
                                       required>
                                <button type="button" class="password-toggle" id="togglePassword">
                                    <i class="fas fa-eye"></i>
                                </button>
                            </div>
                            @error('password')
                                <div class="alert alert-danger mt-2">
                                    <i class="fas fa-exclamation-circle me-2"></i>{{ $message }}
                                </div>
                            @enderror
                        </div>

                        {{-- Remember Me --}}
                        <div class="form-group">
                            <div class="form-check">
                                <input type="checkbox" name="remember" id="remember" class="form-check-input" 
                                       {{ old('remember') ? 'checked' : '' }}>
                                <label for="remember" class="form-check-label">
                                    <i class="fas fa-heart me-2"></i>Ingat Saya
                                </label>
                            </div>
                        </div>

                        {{-- Submit Button --}}
                        <div class="d-grid">
                            <button type="submit" class="btn btn-register text-white" id="submitBtn">
                                <i class="fas fa-sign-in-alt me-2"></i>Masuk Sekarang
                            </button>
                        </div>

                        {{-- Register Link --}}
                        <div class="login-link">
                            <p class="mb-0">Belum punya akun? 
                                <a href="/register"><i class="fas fa-user-plus me-1"></i>Daftar di sini</a>
                            </p>
                        </div>
                    </form>
                </div>
            </div>
        </div>

    <!-- plugins:js -->
    <script src="{{asset('template/assets/vendors/js/vendor.bundle.base.js')}}"></script>
    <!-- endinject -->

    <!-- inject:js -->
    <script src="{{asset('template/assets/js/off-canvas.js')}}"></script>
    <script src="{{asset('template/assets/js/misc.js')}}"></script>
    <script src="{{asset('template/assets/js/jquery.cookie.js')}}"></script>
    <!-- endinject -->
    <!-- Custom js for this page -->
    <script src="{{asset('template/assets/js/dashboard.js')}}"></script>
    <script src="{{asset('template/assets/js/file-upload.js')}}"></script>
    <!-- End custom js for this page -->
    <!-- Lightbox2 JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.11.4/js/lightbox.min.js"></script>

    <!-- Custom JavaScript for enhanced functionality -->
    <script src="{{ asset('js/admin/login.js') }}"></script>

    @yield('script')
    </body>
</html>

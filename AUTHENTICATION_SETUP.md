# Sistem Autentikasi Laravel - Lestari Wisata Dieng

## Fitur Lengkap
- ✅ **Register** - Pendaftaran user baru dengan validasi
- ✅ **Login** - Masuk dengan email dan password
- ✅ **Logout** - Keluar dengan aman
- ✅ **Dashboard Protection** - Middleware melindungi seluruh route dashboard
- ✅ **Remember Me** - Opsi tetap login
- ✅ **Flash Messages** - Notifikasi sukses/error
- ✅ **Modern UI** - Tampilan elegan dengan tema biru gelap
- ✅ **Auto Redirect** - User login tidak bisa akses halaman login/register
- ✅ **Role System** - Admin/User roles

## Setup dan Instalasi

### 1. Migrasi Database
```bash
php artisan migrate
```

### 2. Seed Admin Default (Opsional)
```bash
php artisan db:seed
```
**User Admin Default:**
- Email: `admin@lestariwisatadieng.com`
- Password: `AdminLestariDieng12345`
- Role: `admin`

### 3. Clear Cache
```bash
php artisan config:clear
php artisan route:clear
php artisan view:clear
```

### 4. Jalankan Server
```bash
php artisan serve
```

## Route Authentication

### Public Routes
- `GET /login` - Halaman login
- `POST /login` - Proses login
- `GET /register` - Halaman register  
- `POST /register` - Proses register
- `POST /logout` - Proses logout

### Protected Routes (Middleware: admin.auth)
- `GET /dashboard/home` - Dashboard utama
- Seluruh route dengan prefix `/dashboard/*`

## File-file Penting

### Controllers
- `app/Http/Controllers/AuthController.php` - Menangani register, login, logout

### Middleware
- `app/Http/Middleware/AdminAuth.php` - Proteksi dashboard
- `app/Http/Middleware/RedirectIfAuthenticated.php` - Redirect user login

### Views
- `resources/views/auth/login.blade.php` - Halaman login
- `resources/views/auth/register.blade.php` - Halaman register

### Assets
- `public/css/admin/admin.css` - Styling auth modern
- `public/js/admin/auth.js` - JavaScript register
- `public/js/admin/login.js` - JavaScript login

### Config
- `config/auth.php` - Konfigurasi autentikasi
- `bootstrap/app.php` - Registrasi middleware

## Cara Kerja

### 1. Register
- User mengisi form register
- Password di-hash menggunakan bcrypt
- User pertama otomatis jadi admin
- Redirect ke login dengan pesan sukses

### 2. Login
- Validasi email dan password
- Remember me untuk session lebih lama
- Redirect ke dashboard jika berhasil
- Flash message selamat datang

### 3. Dashboard Protection
- Semua route dashboard dilindungi middleware `admin.auth`
- User tidak login diarahkan ke halaman login
- Session otomatis diperbarui saat berhasil

### 4. Logout
- Hapus session dan regenerate token
- Redirect ke login dengan pesan sukses

## Keamanan

### Middleware Protection
```php
// Guest middleware - cegah user login akses login/register
Route::middleware(['guest'])->group(function () {
    Route::get('/login', [AuthController::class,'showlogin']);
    Route::get('/register', [AuthController::class,'showregister']);
});

// Admin middleware - proteksi dashboard
Route::middleware(['admin.auth'])->group(function () {
    Route::resource('dashboard/home', HomeController::class);
    // ... seluruh route dashboard
});
```

### Password Security
- Password minimal 8 karakter
- Hash menggunakan bcrypt Laravel
- Validasi konfirmasi password saat register

### Session Security
- Session invalidation saat logout
- Token regeneration untuk keamanan
- Remember token untuk persistent login

## Troubleshooting

### Error "Class not found"
```bash
composer dump-autoload
```

### Error "Route not found"
```bash
php artisan route:clear
php artisan route:cache
```

### Error "View not found"
```bash
php artisan view:clear
```

### Error Database
- Pastikan `.env` database sudah benar
- Jalankan `php artisan migrate`

### ✅ Error Remember Token (FIXED)
Jika mendapat error `Unknown column 'remember_token'`, tambahkan kolom ini ke tabel users:
```sql
ALTER TABLE users ADD COLUMN remember_token VARCHAR(100) NULL;
```
**Status: ✅ SUDAH DIPERBAIKI**

## Customization

### Mengubah Redirect Setelah Login
Edit `AuthController.php` method `login()`:
```php
return redirect()->intended(route('your.route.here'));
```

### Menambah Validasi Register
Edit `AuthController.php` method `register()`:
```php
$request->validate([
    'name' => 'required|string|max:255',
    'email' => 'required|string|email|max:255|unique:users',
    'password' => 'required|string|min:8|confirmed',
    'phone' => 'required|string|max:15', // contoh field baru
]);
```

### Mengubah Tema UI
Edit file `public/css/admin/admin.css` untuk kustomisasi warna dan styling.

---

**Sistem autentikasi sudah lengkap dan siap digunakan!** 🚀

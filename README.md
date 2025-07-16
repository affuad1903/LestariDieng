## 🚀 LestariDieng Laravel Project

---

## 📦 Fitur Project

Project ini adalah aplikasi Laravel untuk mengelola data destinasi wisata, paket wisata, fasilitas, dan kontak.

- Manajemen data destinasi & paket wisata
- Seeder database siap pakai
- Frontend menggunakan Vite

---

## ⚙️ Cara Install & Menjalankan Project

### 1. Clone Repository

```bash
git clone <url-repo-anda>
cd LestariDieng
```

### 2. Install Dependency Backend (PHP)

```bash
composer install
```

### 3. Install Dependency Frontend (Node.js)

```bash
npm install
```

### 4. Copy File Environment & Generate Key

```bash
cp .env.example .env
php artisan key:generate
```

### 5. Setting Database

Edit file `.env` sesuai konfigurasi database Anda (MySQL, PostgreSQL, atau SQLite).

### 6. Migrasi & Seed Database

```bash
php artisan migrate
php artisan db:seed
```

> 🔥 **Catatan:** Jika ingin seed spesifik, jalankan:
>
> ```bash
> php artisan db:seed --class=ContactSeeder
> php artisan db:seed --class=DaftarDestinasiSeeder
> php artisan db:seed --class=DaftarDestinasiPaketSeeder
> php artisan db:seed --class=DaftarFasilitasSeeder
> php artisan db:seed --class=DaftarFasilitasPaketSeeder
> ```

### 7. Menjalankan Server Laravel

```bash
php artisan serve
```

Server akan berjalan di `http://127.0.0.1:8000`

---

## 💡 Tips & Troubleshooting

- Pastikan versi Node.js minimal **18.x**.
- Jika error saat migrate (misalnya duplicate column), cek & revisi migration terkait.
- Untuk development lebih nyaman, gunakan dua terminal:
  - `php artisan serve`
  - `npm run dev`

---

## 👨‍💻 Kontributor

- [Bagus Nur Solayman](https://github.com/bagusumby)
- [Affandi Putra Pradana](https://github.com/affuad1903)

---


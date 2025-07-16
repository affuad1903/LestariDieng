<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class LwdDbSeeder extends Seeder
{
    public function run()
    {
        // Table: contact
        DB::table('contact')->insert([
            [
                'id' => 2,
                'home_id' => 1,
                'platform' => 'Email',
                'url' => 'https://mail.google.com/mail/?view=cm&fs=1&to=lestariwisatadieng@gmail.com',
                'detail' => 'lestariwisatadieng@gmail.com',
                'icon' => 'ri-mail-line',
                'created_at' => '2025-04-13 10:10:13',
                'updated_at' => '2025-04-13 10:10:13',
            ],
        ]);

        // Table: daftar_destinasi
        DB::table('daftar_destinasi')->insert([
            [
                'id' => 6,
                'nama_destinasi' => 'testdestinasi1',
                'created_at' => '2025-07-01 05:40:08',
                'updated_at' => '2025-07-16 12:14:26',
            ],
            [
                'id' => 7,
                'nama_destinasi' => 'testdestinasi3',
                'created_at' => '2025-07-16 03:02:20',
                'updated_at' => '2025-07-16 03:02:20',
            ],
            [
                'id' => 8,
                'nama_destinasi' => 'testdestinasi4',
                'created_at' => '2025-07-16 11:31:41',
                'updated_at' => '2025-07-16 11:31:41',
            ],
        ]);

        // Table: daftar_destinasi_paket
        DB::table('daftar_destinasi_paket')->insert([
            [
                'id' => 7,
                'paket_id' => 11,
                'daftar_destinasi_id' => 7,
                'created_at' => '2025-07-16 03:02:20',
                'updated_at' => '2025-07-16 03:02:20',
            ],
            [
                'id' => 15,
                'paket_id' => 13,
                'daftar_destinasi_id' => 7,
                'created_at' => '2025-07-16 11:42:58',
                'updated_at' => '2025-07-16 11:42:58',
            ],
            [
                'id' => 16,
                'paket_id' => 13,
                'daftar_destinasi_id' => 6,
                'created_at' => '2025-07-16 11:44:01',
                'updated_at' => '2025-07-16 11:44:01',
            ],
        ]);

        // Table: daftar_fasilitas
        DB::table('daftar_fasilitas')->insert([
            [ 'id' => 1, 'nama_fasilitas' => 'fasilitas1', 'created_at' => '2025-07-01 04:16:06', 'updated_at' => '2025-07-01 04:16:06' ],
            [ 'id' => 2, 'nama_fasilitas' => 'fasilitas2', 'created_at' => '2025-07-01 04:16:23', 'updated_at' => '2025-07-01 04:16:23' ],
            [ 'id' => 3, 'nama_fasilitas' => 'fasilitas3', 'created_at' => '2025-07-01 05:40:08', 'updated_at' => '2025-07-01 05:40:08' ],
            [ 'id' => 4, 'nama_fasilitas' => 'fasilitas4', 'created_at' => '2025-07-16 03:02:20', 'updated_at' => '2025-07-16 03:02:20' ],
            [ 'id' => 5, 'nama_fasilitas' => 'fasilitas5', 'created_at' => '2025-07-16 11:31:41', 'updated_at' => '2025-07-16 11:31:41' ],
        ]);

        // Table: daftar_fasilitas_paket
        DB::table('daftar_fasilitas_paket')->insert([
            [ 'id' => 1, 'paket_id' => 8, 'daftar_fasilitas_id' => 1, 'created_at' => '2025-07-01 04:16:06', 'updated_at' => '2025-07-01 04:16:06' ],
            [ 'id' => 4, 'paket_id' => 8, 'daftar_fasilitas_id' => 2, 'created_at' => '2025-07-01 04:16:35', 'updated_at' => '2025-07-01 04:16:35' ],
            [ 'id' => 9, 'paket_id' => 11, 'daftar_fasilitas_id' => 2, 'created_at' => '2025-07-16 03:02:20', 'updated_at' => '2025-07-16 03:02:20' ],
            [ 'id' => 10, 'paket_id' => 11, 'daftar_fasilitas_id' => 4, 'created_at' => '2025-07-16 03:02:20', 'updated_at' => '2025-07-16 03:02:20' ],
            [ 'id' => 11, 'paket_id' => 11, 'daftar_fasilitas_id' => 3, 'created_at' => '2025-07-16 03:14:53', 'updated_at' => '2025-07-16 03:14:53' ],
            [ 'id' => 14, 'paket_id' => 13, 'daftar_fasilitas_id' => 2, 'created_at' => '2025-07-16 11:42:58', 'updated_at' => '2025-07-16 11:42:58' ],
        ]);

        // ...lanjutkan untuk semua tabel lain sesuai urutan dan data pada lwd_db.sql...
    }
}

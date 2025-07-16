<?php
namespace Database\Seeders;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
class DaftarFasilitasPaketSeeder extends Seeder {
    public function run() {
        DB::table('daftar_fasilitas_paket')->insert([
            [ 'id' => 1, 'paket_id' => 8, 'daftar_fasilitas_id' => 1, 'created_at' => '2025-07-01 04:16:06', 'updated_at' => '2025-07-01 04:16:06' ],
            [ 'id' => 4, 'paket_id' => 8, 'daftar_fasilitas_id' => 2, 'created_at' => '2025-07-01 04:16:35', 'updated_at' => '2025-07-01 04:16:35' ],
            [ 'id' => 9, 'paket_id' => 11, 'daftar_fasilitas_id' => 2, 'created_at' => '2025-07-16 03:02:20', 'updated_at' => '2025-07-16 03:02:20' ],
            [ 'id' => 10, 'paket_id' => 11, 'daftar_fasilitas_id' => 4, 'created_at' => '2025-07-16 03:02:20', 'updated_at' => '2025-07-16 03:02:20' ],
            [ 'id' => 11, 'paket_id' => 11, 'daftar_fasilitas_id' => 3, 'created_at' => '2025-07-16 03:14:53', 'updated_at' => '2025-07-16 03:14:53' ],
            [ 'id' => 14, 'paket_id' => 13, 'daftar_fasilitas_id' => 2, 'created_at' => '2025-07-16 11:42:58', 'updated_at' => '2025-07-16 11:42:58' ],
        ]);
    }
}

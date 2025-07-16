<?php
namespace Database\Seeders;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
class DaftarDestinasiPaketSeeder extends Seeder {
    public function run() {
        DB::table('daftar_destinasi_paket')->insert([
            [ 'id' => 7, 'paket_id' => 11, 'daftar_destinasi_id' => 7, 'created_at' => '2025-07-16 03:02:20', 'updated_at' => '2025-07-16 03:02:20' ],
            [ 'id' => 15, 'paket_id' => 13, 'daftar_destinasi_id' => 7, 'created_at' => '2025-07-16 11:42:58', 'updated_at' => '2025-07-16 11:42:58' ],
            [ 'id' => 16, 'paket_id' => 13, 'daftar_destinasi_id' => 6, 'created_at' => '2025-07-16 11:44:01', 'updated_at' => '2025-07-16 11:44:01' ],
        ]);
    }
}

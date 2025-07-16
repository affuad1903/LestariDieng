<?php
namespace Database\Seeders;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
class DaftarFasilitasSeeder extends Seeder {
    public function run() {
        DB::table('daftar_fasilitas')->insert([
            [ 'id' => 1, 'nama_fasilitas' => 'fasilitas1', 'created_at' => '2025-07-01 04:16:06', 'updated_at' => '2025-07-01 04:16:06' ],
            [ 'id' => 2, 'nama_fasilitas' => 'fasilitas2', 'created_at' => '2025-07-01 04:16:23', 'updated_at' => '2025-07-01 04:16:23' ],
            [ 'id' => 3, 'nama_fasilitas' => 'fasilitas3', 'created_at' => '2025-07-01 05:40:08', 'updated_at' => '2025-07-01 05:40:08' ],
            [ 'id' => 4, 'nama_fasilitas' => 'fasilitas4', 'created_at' => '2025-07-16 03:02:20', 'updated_at' => '2025-07-16 03:02:20' ],
            [ 'id' => 5, 'nama_fasilitas' => 'fasilitas5', 'created_at' => '2025-07-16 11:31:41', 'updated_at' => '2025-07-16 11:31:41' ],
        ]);
    }
}

<?php
namespace Database\Seeders;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
class DaftarDestinasiSeeder extends Seeder {
    public function run() {
        DB::table('daftar_destinasi')->insert([
            [ 'id' => 6, 'nama_destinasi' => 'testdestinasi1', 'created_at' => '2025-07-01 05:40:08', 'updated_at' => '2025-07-16 12:14:26' ],
            [ 'id' => 7, 'nama_destinasi' => 'testdestinasi3', 'created_at' => '2025-07-16 03:02:20', 'updated_at' => '2025-07-16 03:02:20' ],
            [ 'id' => 8, 'nama_destinasi' => 'testdestinasi4', 'created_at' => '2025-07-16 11:31:41', 'updated_at' => '2025-07-16 11:31:41' ],
        ]);
    }
}

<?php
namespace Database\Seeders;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
class ContactSeeder extends Seeder {
    public function run() {
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
    }
}

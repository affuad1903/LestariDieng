<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('detail_itinerary', function (Blueprint $table) {
            // Hapus foreign key dan kolom
            $table->dropForeign(['day_itinerary_id']);
            $table->dropColumn('day_itinerary_id');

            $table->dropForeign(['time_itinerary_id']);
            $table->dropColumn('time_itinerary_id');

            // Tambah kolom baru
            $table->unsignedTinyInteger('day')->after('paket_id'); // contoh: 1-7
            $table->string('time', 10)->after('day'); // contoh: "08:00"
        });
    }

    public function down(): void
    {
        Schema::table('detail_itinerary', function (Blueprint $table) {
            // Kembalikan ke struktur lama
            $table->dropColumn(['day', 'time']);

            $table->foreignId('day_itinerary_id')
                ->constrained('day_itinerary')
                ->onDelete('cascade');

            $table->foreignId('time_itinerary_id')
                ->constrained('time_itinerary')
                ->onDelete('cascade');
        });
    }
};


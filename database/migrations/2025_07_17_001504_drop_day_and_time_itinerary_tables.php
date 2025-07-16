<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Jalankan migrasi untuk drop tabel.
     */
    public function up(): void
    {
        Schema::dropIfExists('day_itinerary');
        Schema::dropIfExists('time_itinerary');
    }

    /**
     * Rollback (jika dibutuhkan).
     */
    public function down(): void
    {
        Schema::create('day_itinerary', function (Blueprint $table) {
            $table->id();
            $table->string('nama_hari');
            $table->timestamps();
        });

        Schema::create('time_itinerary', function (Blueprint $table) {
            $table->id();
            $table->time('waktu');
            $table->timestamps();
        });
    }
};

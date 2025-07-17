<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('detail_itinerary', function (Blueprint $table) {
            $table->id();
            $table->foreignId('paket_id')->constrained('paket')->onDelete('cascade');
            $table->unsignedTinyInteger('day');
            $table->string('time', 10);         
            $table->text('detail');
            $table->timestamps();
        });
    }
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('detail_itinerary');
    }
};

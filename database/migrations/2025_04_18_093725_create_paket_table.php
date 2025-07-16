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
        Schema::create('paket', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('home_id');
            $table->foreign('home_id')->references('id')->on('home');
            $table->boolean('is_main_page')->default(false);
            $table->string('paket_title');
            $table->string('paket_sub_title_date');
            $table->integer('paket_price');
            $table->string('paket_detail')->nullable();
            $table->string('paket_image');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('paket');
    }
};

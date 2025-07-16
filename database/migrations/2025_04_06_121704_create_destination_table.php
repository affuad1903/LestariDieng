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
        Schema::create('destination', function (Blueprint $table) {
            $table->id();
            
            $table->unsignedBigInteger('home_id');
            $table->foreign('home_id')->references('id')->on('home');

            $table->boolean('is_main_page')->default(false);

            $table->string('content_title');
            $table->text('content_summary');

            $table->string('content_location_title');
            $table->longText('content_location_detail');

            $table->string('thumbnail_image');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('destination');
    }
};

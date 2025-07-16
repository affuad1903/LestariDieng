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
        Schema::create('destination_content_section', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('destination_id');
            $table->foreign('destination_id')->references('id')->on('destination');

            $table->string('title')->nullable();
            $table->longText('detail')->nullable();
            $table->integer('order')->default(1);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('destination_content_section');
    }
};

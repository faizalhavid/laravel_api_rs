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
        Schema::create('dokters', function (Blueprint $table) {
            $table->id("id");
            $table->string('nama');
            $table->string('email');
            $table->string('alamat');
            $table->foreignId('fk_spesialis')->references("id")->on('spesialis');
            $table->foreignId('fk_poli')->references('id')->on('polikliniks');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('dokters');
    }
};

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
        Schema::create('detail_ayats', function (Blueprint $table) {
            $table->id();
            $table->integer('nomorSurat');
            $table->integer('nomorAyat');
            $table->text('teksArab');
            $table->text('teksLatin');
            $table->text('teksIndonesia');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('detail_ayats');
    }
};
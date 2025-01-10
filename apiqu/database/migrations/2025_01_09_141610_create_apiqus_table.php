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
        Schema::create('apiqus', function (Blueprint $table) {
            $table->id();
            $table->integer('nomorSurat');
            $table->string('namaSurat');
            $table->string('namaLatin');
            $table->integer('jumlahAyat');
            $table->string('tempatTurun');
            $table->string('arti');
            $table->text('deskripsi');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('apiqus');
    }
};

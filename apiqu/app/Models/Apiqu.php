<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Apiqu extends Model
{
    use HasFactory;

    protected $table = 'apiqus';

    protected $fillable = ['nomorSurat', 'namaSurat', 'namaLatin', 'jumlahAyat', 'tempatTurun', 'arti', 'deskripsi'];
}

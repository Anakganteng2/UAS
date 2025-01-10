<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailAyat extends Model
{
    use HasFactory;

    protected $table = 'detail_ayats';

    protected $fillable = ['nomorSurat', 'nomorAyat', 'teksArab', 'teksLatin', 'teksIndonesia'];

}

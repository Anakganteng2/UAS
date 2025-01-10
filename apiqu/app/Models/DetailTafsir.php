<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailTafsir extends Model
{
    use HasFactory;

    protected $table = 'detail_tafsirs';

    protected $fillable = ['nomorSurat', 'nomorAyat', 'teksTafsir'];
}

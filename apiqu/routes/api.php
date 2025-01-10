<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ApiquController;

Route::get('/apiqu', [ApiquController::class, 'apiqu']);
Route::get('/import', [ApiquController::class, 'detailIm']);
Route::get('/apiqu/{nomor}', [ApiquController::class, 'ayatDe']);
Route::get('/tafsir', [ApiquController::class, 'tafsirIm']);
Route::get('/tafsir/{nomor}', [ApiquController::class, 'tafsirDe']);

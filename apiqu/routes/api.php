<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ApiquController;

Route::get('/apiqu', [ApiquController::class, 'apiqu']);

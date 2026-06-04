<?php

use App\Http\Controllers\SlateController;
use Illuminate\Support\Facades\Route;


// Create Slates
Route::post('home', [SlateController::class, 'store'])->name('slates.store');
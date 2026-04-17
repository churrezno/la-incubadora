<?php

use App\Http\Controllers\ContactoController;
use App\Http\Controllers\PageController;
use Illuminate\Support\Facades\Route;
use Spatie\Honeypot\ProtectAgainstSpam;

Route::view('/', 'welcome')->name('landing');

Route::controller(PageController::class)->group(function () {

    Route::get('faq', 'faq')->name('faq');
    Route::get('bases', 'bases')->name('bases');
});

Route::get('contacto', [ContactoController::class, 'index'])->name('contacto.index');
Route::post('contacto', [ContactoController::class, 'store'])->middleware(ProtectAgainstSpam::class)->name('contacto.store');

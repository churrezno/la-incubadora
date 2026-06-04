<?php

use App\Http\Controllers\InscripcionController;
use App\Http\Controllers\SlateController;
use App\Models\Inscripcion;
use App\Models\Slate;
use Illuminate\Support\Facades\Route;

Route::get('/home', function () {
    $numInscripcionesUser = Inscripcion::where('user_id', auth()->id())->count();
    $numSlatesUser = Slate::where('user_id', auth()->id())->count();

    return view('home', compact('numInscripcionesUser', 'numSlatesUser'));
    // return view('convo-closed');
})->name('home');

Route::get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');

Route::get('/convo-closed', function () {
    return view('convo-closed');
})->name('convo-closed');
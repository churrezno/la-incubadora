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

// Create inscripciones STEPS
Route::get('inscripciones/create-step-one/{inscripcion?}', [InscripcionController::class, 'createStepOne'])->name('inscripciones.create.step.one');
Route::post('inscripciones/create-step-one/{inscripcion?}', [InscripcionController::class, 'postCreateStepOne'])->name('inscripciones.create.step.one.post');

Route::get('inscripciones/create-step-two/{inscripcion}', [InscripcionController::class, 'createStepTwo'])->name('inscripciones.create.step.two');
Route::post('inscripciones/create-step-two/{inscripcion}', [InscripcionController::class, 'postCreateStepTwo'])->name('inscripciones.create.step.two.post');

Route::get('inscripciones/create-step-three/{inscripcion}', [InscripcionController::class, 'createStepThree'])->name('inscripciones.create.step.three');
Route::post('inscripciones/create-step-three/{inscripcion}', [InscripcionController::class, 'postCreateStepThree'])->name('inscripciones.create.step.three.post');

Route::get('inscripcion/{inscripcion}', [InscripcionController::class, 'showToUser'])->name('inscripcion.show');


// Create Slates
Route::post('home', [SlateController::class, 'store'])->name('slates.store');
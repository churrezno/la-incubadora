<?php

use App\Http\Controllers\InscripcionController;
use Illuminate\Support\Facades\Route;

// Create inscripciones STEPS
Route::get('inscripciones/create-step-one/{inscripcion?}', [InscripcionController::class, 'createStepOne'])->name('inscripciones.create.step.one');
Route::post('inscripciones/create-step-one/{inscripcion?}', [InscripcionController::class, 'postCreateStepOne'])->name('inscripciones.create.step.one.post');

Route::get('inscripciones/create-step-two/{inscripcion}', [InscripcionController::class, 'createStepTwo'])->name('inscripciones.create.step.two');
Route::post('inscripciones/create-step-two/{inscripcion}', [InscripcionController::class, 'postCreateStepTwo'])->name('inscripciones.create.step.two.post');

Route::get('inscripciones/create-step-three/{inscripcion}', [InscripcionController::class, 'createStepThree'])->name('inscripciones.create.step.three');
Route::post('inscripciones/create-step-three/{inscripcion}', [InscripcionController::class, 'postCreateStepThree'])->name('inscripciones.create.step.three.post');

Route::get('inscripcion/{inscripcion}', [InscripcionController::class, 'showToUser'])->name('inscripcion.show');
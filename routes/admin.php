<?php

use App\Http\Controllers\Admin\DatatableController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\HomeController;
use App\Http\Controllers\Admin\SearchController;
use App\Http\Controllers\Admin\SendMailToUsersController;
use App\Http\Controllers\AsignacionController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\InscripcionController;
use App\Http\Controllers\RecycleBinController;
use App\Http\Controllers\ValoracionController;
use Spatie\Honeypot\ProtectAgainstSpam;


/* COMMON FOR ADMIN & COMITE */
// Home
Route::get('', [HomeController::class , 'index'])->name('admin.index');

// Inscripciones
Route::resource('inscripciones', InscripcionController::class)->parameters(['inscripciones' => 'inscripcion']);
Route::get('inscripcion/{inscripcion}', [InscripcionController::class, 'showToUser'])->name('inscripcion.show');

// Datatables
Route::get('datatable/inscripciones', [DatatableController::class, 'inscripciones'])->name('datatable.inscripciones');
Route::get('datatable/valoraciones/{id}', [DatatableController::class, 'valoraciones'])->name('datatable.valoraciones');

//Get all valoraciones
Route::get('valoraciones', [ValoracionController::class, 'index'])->name('valoraciones.index');

// Store valoraciones
Route::post('valoraciones/store/{asignacion}', [ValoracionController::class, 'store'])->name('valoracion.store');



/* ONLY ADMIN */
Route::middleware(\Spatie\Permission\Middleware\RoleMiddleware::using('admin'))
        ->group(function() {

            // Users
            Route::resource('users', UserController::class)->except('show');
            Route::delete('users/{id}/force', [UserController::class, 'forceDelete'])->name('users.forceDelete');

            // Inscripciones
            Route::post('inscripciones/update-category/{inscripcion}', [InscripcionController::class, 'updateCategory']);
            Route::delete('inscripciones/{id}/force', [InscripcionController::class, 'forceDelete'])->name('inscripciones.forceDelete');
            Route::post('asignaciones', [AsignacionController::class, 'manage'])->name('asignaciones.manage');

            // Datatables
            Route::get('datatable/users', [DatatableController::class, 'users'])->name('datatable.users');
            Route::get('datatable/all-valoraciones', [DatatableController::class, 'allValoraciones'])->name('datatable.all-valoraciones');
            Route::get('datatable/users-trash', [DatatableController::class, 'usersTrash'])->name('datatable.users.trash');
            Route::get('datatable/inscripciones-trash', [DatatableController::class, 'inscripcionesTrash'])->name('datatable.inscripciones.trash');

            // Nav search
            Route::post('search', [SearchController::class, 'showNavBarSearchResults']);
            Route::get('search/{term}', [SearchController::class])->name('search.results');

            // Send emails to users
            Route::get('send-mail', [SendMailToUsersController::class, 'index'])->name('send.mail.index');
            Route::post('send-mail', [SendMailToUsersController::class, 'store'])->middleware(ProtectAgainstSpam::class)->name('send.mail.store');

            // Recycle bin
            Route::get('papelera', [RecycleBinController::class, 'index'])->name('papelera.index');
            Route::get('papelera/user/{id}', [RecycleBinController::class, 'restoreUser'])->name('papelera.restore.user');
            Route::get('papelera/inscripcion/{id}', [RecycleBinController::class, 'restoreInscripcion'])->name('papelera.restore.inscripcion');

            // Create / Edit inscripciones STEPS  
            Route::get('inscripciones/create-step-one/{inscripcion?}', [InscripcionController::class, 'createStepOne'])->name('inscripciones.create.step.one');
            Route::post('inscripciones/create-step-one/{inscripcion?}', [InscripcionController::class, 'postCreateStepOne'])->name('inscripciones.create.step.one.post');

            Route::get('inscripciones/create-step-two/{inscripcion}', [InscripcionController::class, 'createStepTwo'])->name('inscripciones.create.step.two');
            Route::post('inscripciones/create-step-two/{inscripcion}', [InscripcionController::class, 'postCreateStepTwo'])->name('inscripciones.create.step.two.post');

            Route::get('inscripciones/create-step-three/{inscripcion}', [InscripcionController::class, 'createStepThree'])->name('inscripciones.create.step.three');
            Route::post('inscripciones/create-step-three/{inscripcion}', [InscripcionController::class, 'postCreateStepThree'])->name('inscripciones.create.step.three.post');
        });


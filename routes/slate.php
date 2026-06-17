<?php

use App\Http\Controllers\SlateController;
use Illuminate\Support\Facades\Route;


// Create Slates
//Route::post('home', [SlateController::class, 'store'])->name('slates.store');


Route::get('slates/create/{slate?}', [SlateController::class, 'create'])->name('slates.create');
Route::post('slates/create/{slate?}', [SlateController::class, 'postCreate'])->name('slates.create.post');

Route::get('slate/{slate}', [SlateController::class, 'showToUser'])->name('slate.show');
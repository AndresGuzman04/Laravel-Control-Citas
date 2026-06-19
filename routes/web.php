<?php

use App\Http\Controllers\citaController;
use App\Http\Controllers\pacienteController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('template');
});

Route::view('/panel', 'panel.index')->name('panel');

Route::resource('pacientes', pacienteController::class);
Route::resource('citas', citaController::class);
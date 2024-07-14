<?php

use Illuminate\Support\Facades\Route;
// use App\Http\Controllers\EventoController;

Route::get('/', function () {
    return view('welcome');
});


// Route::prefix('eventos')->group(function () {
//     Route::post('/', [EventoController::class, 'criar']);
// });

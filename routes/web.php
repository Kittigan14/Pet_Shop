<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PetController;

Route::get('/', function () {
    return view('welcome');
});

Route::get(' /pet',             [PetController::class, 'index'  ]);
Route::post('/pet/search',      [PetController::class, 'search' ]);
Route::get(' /pet/edit/{id?}',   [PetController::class, 'edit'   ]);
Route::post('/pet/update',      [PetController::class, 'update' ]);
Route::post('/pet/insert',      [PetController::class ,'insert' ]);
Route::get(' /pet/remove/{id}', [PetController::class ,'remove' ]);
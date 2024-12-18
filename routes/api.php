<?php

use App\Http\Controllers\ClientController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::post('/user', [ClientController::class, 'createUser']);
Route::get('/user', [ClientController::class, 'index']);
Route::put('/user/{id}', [ClientController::class, 'updateClient']);
Route::delete('/user/{id}', [ClientController::class, 'deleteClient']);

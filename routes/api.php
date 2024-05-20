<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\OwnerControllerApi;
use App\Http\Controllers\Api\CarControllerApi;

Route::get('/owners', [OwnerControllerApi::class, 'index']);
Route::post('/owners', [OwnerControllerApi::class, 'store']);
Route::get('/owners/{id}', [OwnerControllerApi::class, 'show']);
Route::put('/owners/{id}', [OwnerControllerApi::class, 'update']);
Route::delete('/owners/{id}', [OwnerControllerApi::class, 'destroy']);

Route::get('/cars', [CarControllerApi::class, 'index']);
Route::post('/cars', [CarControllerApi::class, 'store']);
Route::get('/cars/{id}', [CarControllerApi::class, 'show']);
Route::put('/cars/{id}', [CarControllerApi::class, 'update']);
Route::delete('/cars/{id}', [CarControllerApi::class, 'destroy']);

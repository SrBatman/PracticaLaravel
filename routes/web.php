<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SessionsController;
use App\Http\Controllers\CookiesController;
use App\Http\Controllers\EncryptionsController;

Route::get('/', function () {
    return view('welcome');
});


Route::get('/sessions/list',[SessionsController::class,'index']);
Route::get('/sessions/create', [SessionsController::class,'create']);
Route::post('/sessions/save',[SessionsController::class,'save']);

Route::get('/sessions/edit/{pos}', [SessionsController::class,'edit']);
Route::put('/sessions/update/{pos}',[SessionsController::class,'update']);

Route::get('/sessions/show', [SessionsController::class,'show']);
Route::delete('/sessions/delete/{pos}',[SessionsController::class,'delete']);
Route::put('/sessions/encrypt/{pos}',[SessionsController::class,'encrypt']);















Route::get('/cookies/list',[CookiesController::class,'index']);
Route::get('/cookies/create', [CookiesController::class,'create']);
Route::post('/cookies/save',[CookiesController::class,'save']);


Route::get('/cookies/edit/{pos}', [CookiesController::class,'edit']);
Route::put('/cookies/update/{pos}',[CookiesController::class,'update']);
Route::put('/cookies/encrypt/{pos}',[CookiesController::class,'encrypt']);

Route::get('/cookies/show', [CookiesController::class,'show']);
Route::delete('/cookies/delete/{pos}',[CookiesController::class,'delete']);
Route::delete('/cookies/destroy',[CookiesController::class,'destroy']);





















Route::get('/encryptions/list',[EncryptionsController::class,'index']);
Route::get('/encryptions/create', [EncryptionsController::class,'create']);
Route::post('/encryptions/save',[EncryptionsController::class,'save']);
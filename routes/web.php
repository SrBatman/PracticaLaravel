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


Route::get('/cookies/list',[CookiesController::class,'index']);
Route::get('/cookies/create', [CookiesController::class,'create']);
Route::post('/cookies/save',[CookiesController::class,'save']);


Route::get('/encryptions/list',[EncryptionsController::class,'index']);
Route::get('/encryptions/create', [EncryptionsController::class,'create']);
Route::post('/encryptions/save',[EncryptionsController::class,'save']);
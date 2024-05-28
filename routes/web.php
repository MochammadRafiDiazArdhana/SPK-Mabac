<?php

use App\Http\Controllers\AlternatifController;
use App\Http\Controllers\SessionController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\KriteriaController;
use App\Http\Controllers\PenilaianController;
use App\Http\Controllers\RankingController;
use App\Http\Middleware\IsLogin;
use App\Http\Middleware\OnLogin;
use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/',[HomeController::class,'index'])->name('home')->middleware(IsLogin::class);
Route::resource('alternatif', AlternatifController::class)->middleware(IsLogin::class);
Route::resource('kriteria', KriteriaController::class)->middleware(IsLogin::class);
Route::resource('penilaian', PenilaianController::class)->middleware(IsLogin::class);
Route::resource('ranking', RankingController::class)->middleware(IsLogin::class);

// login

Route::get('login',[SessionController::class,'index'])->middleware(OnLogin::class);
Route::get('/session/logout',[SessionController::class,'logout']);
Route::post('/session/login',[SessionController::class,'login'])->middleware(OnLogin::class);
Route::get('register',[SessionController::class,'register'])->middleware(OnLogin::class);
Route::post('/session/register',[SessionController::class,'create'])->middleware(OnLogin::class);
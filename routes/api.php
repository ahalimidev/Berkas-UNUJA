<?php

use App\Http\Controllers\api\ApiController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
Route::get('lembaga',[ApiController::class,'lembaga']);
Route::get('fakultas',[ApiController::class,'fakultas']);
Route::get('prodi/{id}',[ApiController::class,'prodi']);

Route::get('kategori_berkas',[ApiController::class,'kategori']);
Route::get('sub_kategori_berkas/{id}',[ApiController::class,'sub_kategori']);

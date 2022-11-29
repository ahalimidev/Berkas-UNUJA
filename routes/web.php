<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\SubKategoriController;
use App\Http\Controllers\UploadController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


Route::resource('kategori', KategoriController::class);
Route::resource('sub_kategori', SubKategoriController::class);
Route::resource('upload', UploadController::class);
Route::get("/file/{data}",[UploadController::class,'file'])->name('berkas_file');
Route::get("/",[UploadController::class,'download'])->name('dashboard.index');
Route::get("/download/{data}",[DashboardController::class,'file'])->name('berkas_download');



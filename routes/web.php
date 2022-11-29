<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\BerkasController;
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
Route::resource('upload_berkas', BerkasController::class);
Route::resource('auth', AuthController::class);
Route::get("/file/{data}",[UploadController::class,'file'])->name('berkas_file');
Route::get("/show/{data}",[UploadController::class,'show_pdf'])->name('show_file');
Route::get("/download/{data}",[DashboardController::class,'file'])->name('berkas_download');
Route::get("/login",[AuthController::class,'login'])->name('auth.login');
Route::get("/logout",[AuthController::class,'logout'])->name('auth.logout');
Route::post("/login",[AuthController::class,'login_login'])->name('auth.login.login');

Route::get("/",[UploadController::class,'download'])->name('dashboard.index');
Route::get("/dashboard",[DashboardController::class,'index'])->name('dashboard.dashboard');
Route::get("/master_lembaga",[DashboardController::class,'master_lembaga'])->name('dashboard.master_lembaga');
Route::get("/master_fakultas",[DashboardController::class,'master_fakultas'])->name('dashboard.master_fakultas');
Route::get("/master_lembaga/{tahun}",[DashboardController::class,'master_lembaga_tahun'])->name('dashboard.master_lembaga_tahun');
Route::get("/master_fakultas/{tahun}",[DashboardController::class,'master_fakultas_tahun'])->name('dashboard.master_fakultas_tahun');







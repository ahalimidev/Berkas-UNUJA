<?php

use App\Http\Controllers\BerkasController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\JenisBerkasController;
use App\Http\Controllers\SubBerkasController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;


Route::get('/',[DashboardController::class,'index'])->name('dashboard.index');
Route::get('/show/{id_berkas}',[DashboardController::class,'show'])->name('dashboard.show');
Route::get('/download/{data}',[DashboardController::class,'download_pdf'])->name('download.pdf');
Route::get('/sub/download/{data}',[DashboardController::class,'sub_download_pdf'])->name('sub.download.pdf');
Route::get('/viewer/berkas/{data}',[DashboardController::class,'show_pdf'])->name('viewers.pdf');

Route::get("/login",[UserController::class,'form_login'])->name('auth.login');
Route::post("/login",[UserController::class,'akses_login'])->name('auth.login.login');


Route::middleware(['auth:web'])->group(function () {
    Route::resource('jenis_berkas', JenisBerkasController::class);
    Route::post('jenis_berkas/edit/all', [JenisBerkasController::class, 'edit_multi'])->name('jenis_berkas.edit.all');

    Route::resource('user', UserController::class);
    Route::post('user/edit/all', [UserController::class, 'edit_multi'])->name('user.edit.all');
    Route::get('pengaturan', [UserController::class, 'tampil_pengaturan'])->name('user.setting');
    Route::post('pengaturan', [UserController::class, 'simpan_pengaturan'])->name('user.setting.simpan');

    Route::resource('berkas', BerkasController::class);
    Route::post('berkas/edit/all', [BerkasController::class, 'edit_multi'])->name('berkas.edit.all');
    Route::get('berkas/show/{data}', [BerkasController::class, 'show_pdf'])->name('berkas.show.pdf');
    Route::get('berkas/status/{status}', [BerkasController::class, 'jenis_berkas'])->name('berkas.jenis_berkas');

    Route::resource('sub_berkas', SubBerkasController::class);
    Route::post('sub_berkas/edit/all', [SubBerkasController::class, 'edit_multi'])->name('sub_berkas.edit.all');
    Route::get('sub_berkas/show/{data}', [SubBerkasController::class, 'show_pdf'])->name('sub_berkas.show.pdf');
    Route::get('sub_berkas/berkas/{id_berkas}', [SubBerkasController::class, 'berkas'])->name('sub_berkas.berkas');


    Route::get("/logout",[UserController::class,'logout'])->name('auth.logout');
});



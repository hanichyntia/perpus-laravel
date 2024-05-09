<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BukuController;
use App\Http\Controllers\KelasController;
use App\Http\Controllers\SiswaController;
use App\Http\Controllers\transaksiController;
use App\Http\Controllers\GuruController;
use App\Http\Controllers\API\AuthController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

//Buku
Route::get('/getBuku', [BukuController::class,'getBuku']);
Route::post('/addBuku',[BukuController::class,'addBuku']);
Route::put('/updateBuku/{id_buku}',[BukuController::class,'updateBuku']);
Route::delete('/deleteBuku/{id_buku}',[BukuController::class,'deleteBuku']);
Route::get('/getBukuId/{id_buku}',[BukuController::class,'getBukuId']);

//Kelas
Route::get('/getKelas', [KelasController::class,'getKelas']);
Route::post('/addKelas',[KelasController::class,'addKelas']);
Route::put('/updateKelas/{id_kelas}',[KelasController::class,'updateKelas']);
Route::delete('/deleteKelas/{id_kelas}',[KelasController::class,'deleteKelas']);
Route::get('/getKelasid/{id_kelas}',[KelasController::class,'getKelasid']);

//Siswa
Route::get('/getSiswa', [SiswaController::class,'getSiswa']);
Route::post('/addSiswa',[SiswaController::class,'addSiswa']);
Route::put('/updateSiswa/{id_siswa}',[SiswaController::class,'updateSiswa']);
Route::delete('/deleteSiswa/{id_siswa}',[SiswaController::class,'deleteSiswa']);
Route::get('/getSiswaId/{id_siswa}',[SiswaController::class,'getSiswaId']);

//Transaksi
Route::post('/pinjamBuku',[transaksiController::class,'pinjamBuku']);
Route::post('/tambahItem/{id}',[transaksiController::class,'tambahItem']);
Route::post('/pengembalian',[transaksiController::class,'pengembalian']);

//Guru
Route::post('/addGuru',[GuruController::class,'addGuru']);

//Auth
Route::controller(AuthController::class)->group(function(){
    Route::post('login', 'login');
    Route::post('register', 'register');
    Route::post('logout', 'logout');
    Route::post('refresh', 'refresh');
});

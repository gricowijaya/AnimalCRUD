<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AnimalController;

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

Route::get('/daftar', [AnimalController::class, 'listAnimal'])->name('daftar-hewan');
Route::get('/tambah', [AnimalController::class, 'newAnimal'])->name('tambah-data-hewan');
Route::post('/{id}/hapus', [AnimalController::class, 'deleteAnimal'])->name('hapus-data-hewan', 'id');
Route::get('/{id}/sunting', [AnimalController::class, 'editAnimal'])->name('edit-data-hewan', 'id');
Route::post('/simpanbaru', [AnimalController::class, 'saveNewAnimal'])->name('simpan-data-hewan');
Route::get('/{id}/detail', [AnimalController::class, 'detailAnimal'])->name('detail-data-hewan', 'id');
Route::post('/{id}/saveedit', [AnimalController::class, 'saveEdit'])->name('simpan-data-edit-hewan', 'id');

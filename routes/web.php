<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Masyarakat\MasyarakatController;
use App\Http\Controllers\Petugas\PetugasController;
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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

require __DIR__.'/auth.php';

Route::group(['middleware' => 'auth'], function() {
    Route::group(['middleware' => 'role:admin', 'prefix' => 'admin', 'as' => 'admin.'], function() {
        Route::get('admin-page', [AdminController::class, 'index'])->name('admin-page');
    });

    Route::group(['middleware' => 'role:petugas', 'prefix' => 'petugas', 'as' => 'petugas.'], function() {
        Route::get('petugas-page', [PetugasController::class, 'index'])->name('petugas-page');
    });

    Route::group(['middleware' => 'role:masyarakat', 'prefix' => 'masyarakat', 'as' => 'masyarakat.'], function() {
        Route::get('masyarakat-page', [MasyarakatController::class, 'index'])->name('masyarakat-page');
    });
});

<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\User\ProfileController;
use App\Http\Controllers\Petugas\PetugasController;
use App\Http\Controllers\Masyarakat\MasyarakatController;
use App\Http\Controllers\Operator\OperatorController;
use App\Http\Controllers\UploadController;

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
    Route::post('upload', [UploadController::class, 'store']);
    Route::post('upload-multiple', [UploadController::class, 'storeMultiple']);

    Route::group(['prefix' => 'profile'], function () {
        Route::get('/', [ProfileController::class, 'edit'])->name('profile');
        Route::patch('/{userid}/{profileid}', [ProfileController::class, 'update'])->name('profile.update');
    });

    Route::group(['prefix' => 'operator', 'as' => 'operator.'], function() {
        Route::get('dashboard', [OperatorController::class, 'index'])->name('dashboard');

        Route::get('operator-list', [OperatorController::class, 'showOperators'])->name('operator-list');
        Route::group(['prefix' => 'operator-list', 'as' => 'operator-list.'], function() {
            Route::get('/create', [OperatorController::class, 'registerOperator'])->name('create');
            Route::post('/', [OperatorController::class, 'storeOperator'])->name('store');
            Route::get('/{user}/edit', [OperatorController::class, 'editOperator'])->name('edit');
            Route::get('/{operator}', [OperatorController::class, 'showOperator'])->name('show');
            Route::patch('/{user}', [OperatorController::class, 'updateOperator'])->name('update');
            Route::delete('/{user}', [OperatorController::class, 'destroy'])->name('destroy');
        });
        
        Route::get('people', [OperatorController::class, 'showPeoples'])->name('people');
        Route::group(['prefix' => 'people', 'as' => 'people.'], function() {
             Route::get('/{people}', [OperatorController::class, 'showPeople'])->name('show');
             Route::delete('/{user}', [OperatorController::class, 'destroy'])->name('destroy');
        });

        Route::get('item', [OperatorController::class, 'showItems'])->name('item');
        Route::group(['prefix' => 'item', 'as' => 'item.'], function() {
            Route::get('/create', [OperatorController::class, 'registerItem'])->name('create');
            Route::post('/', [OperatorController::class, 'storeItem'])->name('store');
            Route::get('/{item}/edit', [OperatorController::class, 'editItem'])->name('edit');
            Route::get('/{item}', [OperatorController::class, 'showItem'])->name('show');
            Route::patch('/{item}', [OperatorController::class, 'updateItem'])->name('update');
            Route::delete('/{item}', [OperatorController::class, 'destroyItem'])->name('destroy');
       });
      });

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

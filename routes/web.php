<?php

use App\Events\FormSubmitted;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UploadController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\User\ProfileController;
use App\Http\Controllers\Operator\{ItemController, UserController, ReportController, AuctionController, OperatorController};
use App\Http\Controllers\Masyarakat\BidController;
use App\Http\Controllers\Petugas\PetugasController;
use App\Http\Controllers\Masyarakat\MasyarakatController;

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


require __DIR__.'/auth.php';

Route::group(['middleware' => 'auth'], function() {
    Route::get('dashboard', [MasyarakatController::class, 'dashboard'])->name('dashboard');

    Route::post('upload', [UploadController::class, 'store']);
    Route::post('upload-multiple', [UploadController::class, 'storeMultiple']);

    Route::group(['prefix' => 'profile'], function () {
        Route::get('/', [ProfileController::class, 'index'])->name('profile');
        Route::get('/edit', [ProfileController::class, 'edit'])->name('profile.edit');
        Route::patch('/{userid}/{profileid}', [ProfileController::class, 'update'])->name('profile.update');
    });

    Route::group(['prefix' => 'operator', 'as' => 'operator.'], function() {
        Route::get('dashboard', [OperatorController::class, 'index'])->name('dashboard');

        Route::resource('operator-list', UserController::class)->except([
            'showPeoples', 'showPeople'
        ]);

        Route::get('people', [UserController::class, 'showPeoples'])->name('people');
        Route::group(['prefix' => 'people', 'as' => 'people.'], function() {
             Route::get('/{people}', [UserController::class, 'showPeople'])->name('show');
             Route::delete('/{user}', [UserController::class, 'destroy'])->name('destroy');
        });

        Route::resource('item', ItemController::class);
        Route::resource('auction', AuctionController::class)->except([
            'history'
        ]);
        Route::get('history', [AuctionController::class, 'history'])->name('history');

        Route::get('report', [ReportController::class, 'index'])->name('report');
        Route::get('report/export_excel/{tgl1}/{tgl2}', [ReportController::class, 'exportExcel'])->name('report.excel');
        Route::get('report/export_pdf/{tgl1}/{tgl2}', [ReportController::class, 'exportPdf'])->name('report.pdf');

      });

    Route::group(['middleware' => 'role:admin', 'prefix' => 'admin', 'as' => 'admin.'], function() {
        Route::get('admin-page', [AdminController::class, 'index'])->name('admin-page');
    });

    Route::group(['middleware' => 'role:petugas', 'prefix' => 'petugas', 'as' => 'petugas.'], function() {
        Route::get('petugas-page', [PetugasController::class, 'index'])->name('petugas-page');
    });

    Route::group(['middleware' => 'role:masyarakat', 'prefix' => 'masyarakat', 'as' => 'masyarakat.'], function() {
        Route::get('history-lelang', [MasyarakatController::class, 'index'])->name('masyarakat-page');
    });

    Route::resource('bid-list', BidController::class)->except([
        'create', 'update'
    ]);

    Route::get('/bid-list/{auction}/{item}/create', [BidController::class, 'create'])->name('bid-list.create');
    Route::get('/bid-list/{auction}/{item}/{bid}/edit', [BidController::class, 'edit'])->name('bid-list.edit');
    Route::patch('/bid-list/{auction}/{item}/{bid}', [BidController::class, 'updateBid'])->name('bid-list.update');
    Route::delete('/bid-list/{auction}/{item}/{bid}', [BidController::class, 'destroy'])->name('bid-list.destroy');
    Route::patch('/bid-list/{bid}', [BidController::class, 'updateAuction'])->name('bid-list.updateAuction');
});
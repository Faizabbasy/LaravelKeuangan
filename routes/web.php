<?php

use App\Http\Controllers\UserController;
use App\Http\Controllers\TargetController;
use App\Http\Controllers\RiwayatController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\NasabahController;
use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', [HomeController::class, 'index'])->name('home');

Route::get('/signup', function () {
    return view('signup');
})->name('signup')->middleware('isGuest');

Route::get('/login', function () {
    return view('login');
})->name('login')->middleware('isGuest');

Route::post('/signup', [UserController::class, 'store'])->name('signup.store')->middleware('isGuest');
Route::post('/login', [UserController::class, 'login'])->name('login.auth')->middleware('isGuest');
Route::get('/logout', [UserController::class, 'logout'])->name('logout');

Route::get('/riwayat', [RiwayatController::class, 'index'])->name('riwayat.index');


Route::middleware('isUser')->prefix('/user')->name('user.')->group(function() {
    Route::get('/dashboard', [TargetController::class, 'index'])->name('dashboard');

    Route::prefix('/targets')->name('targets.')->group(function() {
    Route::get('/create', [TargetController::class, 'create'])->name('create');
    Route::post('/store', [TargetController::class, 'store'])->name('store');
    Route::get('/edit/{id}', [TargetController::class, 'edit'])->name('edit');
    Route::put('/update/{id}', [TargetController::class, 'update'])->name('update');
    Route::delete('/delete/{id}', [TargetController::class, 'destroy'])->name('delete');
    Route::get('/export', [TargetController::class, 'exportExcel'])->name('export');
    Route::get('/trash', [TargetController::class, 'trash'])->name('trash');
    Route::patch('/restore/{id}', [TargetController::class, 'restore'])->name('restore');
    Route::delete('/delete-permanent/{id}', [TargetController::class, 'deletePermanent'])->name('delete_permanent');
    Route::get('/print/pdf', [TargetController::class, 'printPDF'])->name('print_pdf');
});


    Route::prefix('/riwayats')->name('riwayats.')->group(function() {
        Route::get('/', [RiwayatController::class, 'index'])->name('index');
        Route::get('/create/{id}', [RiwayatController::class, 'create'])->name('create');
        Route::post('/store', [RiwayatController::class, 'store'])->name('store');
        Route::delete('/delete/{id}', [RiwayatController::class, 'destroy'])->name('delete');
        Route::get('/trash', [RiwayatController::class, 'trash'])->name('trash');
        Route::patch('/restore/{id}', [RiwayatController::class, 'restore'])->name('restore');
        Route::delete('/delete-permanent/{id}', [RiwayatController::class, 'deletePermanent'])->name('delete_permanent');
    });
});



// buat admin
Route::middleware('isAdmin')->prefix('/admin')->name('admin.')->group(function() {
    Route::get('/dashboard', function() {
        return view('admin.dashboard');
    })->name('dashboard');
    Route::get('/chart', [NasabahController::class, 'chartAdmin'])->name('chart');
    // NASABAH
    Route::prefix('/nasabah')->name('nasabah.')->group(function() {
        Route::get('/', [NasabahController::class, 'index'])->name('index');
        Route::get('/create/{id}', [RiwayatController::class, 'create'])->name('create');
        Route::post('/store', [RiwayatController::class, 'store'])->name('store');
    });
});

<?php

use App\Http\Controllers\UserController;
use App\Http\Controllers\TargetController;
use App\Http\Controllers\RiwayatController;
use App\Http\Controllers\HomeController;
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
});


    Route::prefix('/riwayats')->name('riwayats.')->group(function() {
        Route::get('/', [RiwayatController::class, 'index'])->name('index');
        Route::get('/create/{id}', [RiwayatController::class, 'create'])->name('create');
        Route::post('/store', [RiwayatController::class, 'store'])->name('store');
    });
});



// buat admin
Route::middleware('isAdmin')->prefix('/admin')->name('admin.')->group(function() {
    Route::get('/dashboard', function() {
        return view('admin.dashboard');
    })->name('dashboard');
});

<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\BackStage\BackstageController;
use App\Http\Controllers\BackStage\UserController;

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

// Route::get('/', function () {
//     return view('welcome');
// });

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});

Route::get('/', [HomeController::class, 'index'])->name('index');
Route::get('/replies', \App\Http\Livewire\Replies::class)->name('Replies');

Route::get('/product', \App\Http\Livewire\Product\Index::class)->name('product');

Route::prefix('backstage')->group(function () {
    Route::get('/', [BackstageController::class, 'index'])->name('backstage/index');
    Route::prefix('/user')->group(function () {
        Route::get('/', [UserController::class, 'index'])->name('user');
        Route::get('/create', [UserController::class, 'create'])->name('user_create');
        Route::post('/store', [UserController::class, 'store'])->name('user_store');
        Route::get('/show/{id}', [UserController::class, 'show'])->name('user_show');
        Route::get('/edit/{id}', [UserController::class, 'edit'])->name('user_edit');
        Route::post('/update/{id}', [UserController::class, 'update'])->name('user_update');
        Route::get('/delete/{id}', [UserController::class, 'destroy'])->name('user_destroy');
    });
    Route::prefix('/product')->group(function () {
        Route::get('/', [UserController::class, 'index'])->name('product');
        Route::get('/create', [UserController::class, 'create'])->name('product_create');
        Route::post('/store', [UserController::class, 'store'])->name('product_store');
        Route::get('/show/{id}', [UserController::class, 'show'])->name('product_show');
        Route::get('/edit/{id}', [UserController::class, 'edit'])->name('product_edit');
        Route::post('/update/{id}', [UserController::class, 'update'])->name('product_update');
        Route::get('/delete/{id}', [UserController::class, 'destroy'])->name('product_destroy');
    });
    Route::prefix('/order')->group(function () {
        Route::get('/', [UserController::class, 'index'])->name('order');
        Route::get('/create', [UserController::class, 'create'])->name('order_create');
        Route::post('/store', [UserController::class, 'store'])->name('order_store');
        Route::get('/show/{id}', [UserController::class, 'show'])->name('order_show');
        Route::get('/edit/{id}', [UserController::class, 'edit'])->name('order_edit');
        Route::post('/update/{id}', [UserController::class, 'update'])->name('order_update');
        Route::get('/delete/{id}', [UserController::class, 'destroy'])->name('order_destroy');
    });
    Route::prefix('/menu')->group(function () {
        Route::get('/', [UserController::class, 'index'])->name('menu');
        Route::get('/create', [UserController::class, 'create'])->name('menu_create');
        Route::post('/store', [UserController::class, 'store'])->name('menu_store');
        Route::get('/show/{id}', [UserController::class, 'show'])->name('menu_show');
        Route::get('/edit/{id}', [UserController::class, 'edit'])->name('menu_edit');
        Route::post('/update/{id}', [UserController::class, 'update'])->name('menu_update');
        Route::get('/delete/{id}', [UserController::class, 'destroy'])->name('menu_destroy');
    });
});
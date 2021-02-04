<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AlbumController;

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

Auth::routes(['reset' => false]);

Route::middleware('auth')->group(function(){
    Route::get('/home', [HomeController::class, 'index'])->name('home');
    Route::get('/album/create', [AlbumController::class, 'create'])->name('album.create');
    Route::post('/album/store', [AlbumController::class, 'store'])->name('album.store');
    Route::get('/album/show/{album}', [AlbumController::class, 'show'])->name('album.show');
    Route::get('/album/edit/{album}', [AlbumController::class, 'edit'])->name('album.edit');
    Route::PUT('/album/update/{album}', [AlbumController::class, 'update'])->name('album.update');
    Route::DELETE('/album/delete/{album}', [AlbumController::class, 'delete'])->name('album.delete');
});

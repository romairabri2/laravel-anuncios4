<?php

use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use App\Http\Controllers\PostController;
use App\Http\Controllers\ApartmentController;

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
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::middleware(['auth:sanctum','verified'])->group(function() {
    Route::get('/dashboard',function(){
      return Inertia::render('Dashboard');
    })->name('dashboard');

    Route::prefix('posts')->group(function(){
      Route::get('/',[PostController::class,'index'])->name('posts.index');
      Route::get('/create',[PostController::class,'create'])->name('posts.create');
      Route::get('/edit/{id}',[PostController::class,'edit'])->name('posts.edit');
     });

     Route::prefix('apartments')->group(function(){
      Route::get('/',[ApartmentController::class,'index'])->name('apartments.index');
      Route::get('/create',[ApartmentController::class,'create'])->name('apartments.create');
      Route::get('/edit/{id}',[ApartmentController::class,'edit'])->name('apartments.edit');
     });
});

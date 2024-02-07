<?php

use App\Http\Controllers\ArticlesController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::resource('Articles', ArticlesController::class)
    ->only(['index', 'store', 'edit', 'update'])
    ->middleware(['auth', 'verified']);

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::get('/dashboard', [ArticlesController::class, 'index'])->name('dashboard');
    Route::get('/articles', [ArticlesController::class, 'index'])->name('articles');
    Route::post('/articles', [ArticlesController::class, 'store'])->name('articles.store');
    Route::get('/articles/{article}/edit', [ArticlesController::class, 'edit'])->name('articles.edit');
    Route::put('/articles/{article}', [ArticlesController::class, 'update'])->name('articles.update');
    Route::delete('/articles/{article}', [ArticlesController::class, 'destroy'])->name('articles.destroy');
    Route::get('/dashboard', [DashboardController::class, 'dashboard'])->name('dashboard');

});

require __DIR__.'/auth.php';

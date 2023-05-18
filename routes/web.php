<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ArchivoController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\ProfileController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application.
| These routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/',function(){
    return view('index');

})->name('index');

Route::get('/login', [AuthenticatedSessionController::class, 'create'])->name('login');
Route::get('logout', [AuthenticatedSessionController::class, 'destroy'])->name('logout');
Route::delete('/uploads/{id}', [ArchivoController::class, 'destroy'])->name('archivos.destroy');
Route::post('/login', [AuthenticatedSessionController::class, 'store'])->name('login');
Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::get('/inicio', [ArchivoController::class, 'show'])->name('inicio');
    Route::post('/inicio', [ArchivoController::class, 'store'])->name('archivos.store');
});



// Dashboard Route
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

Route::get('/storage/{folder}/{file}')->middleware('checkUserFolder');

require __DIR__.'/auth.php';

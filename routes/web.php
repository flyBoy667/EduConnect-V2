<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ComptableController;
use App\Http\Controllers\EtudiantController;
use App\Http\Controllers\ProfesseurController;
use App\Http\Controllers\SecretaireController;
use App\Http\Controllers\TestController;
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


Route::get('/login', [AuthController::class, 'login'])->name('auth.login');
Route::post('/login', [AuthController::class, 'doLogin']);
Route::delete('/logout', [AuthController::class, 'logout'])->name('logout')->middleware('auth');

Route::middleware(['auth'])->group(function () {
    Route::get('/etudiant', [EtudiantController::class, 'index'])->name('etudiant.index');
    Route::get('/professeur', [ProfesseurController::class, 'index'])->name('professeur.index');
    Route::get('/administrateur', [AdminController::class, 'index'])->name('administrateur.index');
    Route::get('/secretaire', [SecretaireController::class, 'index'])->name('secretaire.index');
    Route::get('/comptable', [ComptableController::class, 'index'])->name('comptable.index');
});

Route::middleware(['auth', 'admin'])->group(function () {
    Route::prefix('admin')->name('admin.')->group(function () {
        Route::resource('professeur', \App\Http\Controllers\Admin\ProfesseurController::class);
    });
});

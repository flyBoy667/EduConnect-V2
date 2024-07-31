<?php

use App\Http\Controllers\Admin\AdminController;
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
    Route::get('/professeur', [ProfesseurController::class, 'index'])->name('professeur.index')->middleware('check.user.type:professeur');
    Route::get('/secretaire', [SecretaireController::class, 'index'])->name('secretaire.index');
    Route::get('/comptable', [ComptableController::class, 'index'])->name('comptable.index');
});

Route::middleware(['auth', 'check.user.type:etudiant'])->group(function () {

    Route::prefix('etudiant')->name('etudiant.')->controller(EtudiantController::class)->group(function () {
        Route::get('/', 'index')->name('index');
        Route::get('/ressources', [EtudiantController::class, 'ressources'])->name('ressources');

    });

});

Route::middleware(['auth', 'check.user.type:professeur'])->group(function () {

    Route::prefix('professeur')->name('professeur.')->controller(ProfesseurController::class)->group(function () {
        Route::get('/', 'index')->name('index');
        Route::resource('ressources', \App\Http\Controllers\Professeur\RessourcesController::class);
    });
});


Route::middleware(['auth', 'check.user.type:admin'])->group(function () {
    Route::prefix('admin')->name('admin.')->group(function () {
        Route::get('/', [\App\Http\Controllers\Admin\AdminController::class, 'index'])->name('index');
        Route::resource('professeur', \App\Http\Controllers\Admin\ProfesseurController::class);
        Route::resource('etudiant', \App\Http\Controllers\Admin\EtudiantController::class);
        Route::resource('personnelAdministratif', \App\Http\Controllers\Admin\PersonnelAdministratifController::class);
    });
});

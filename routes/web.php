<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ComptableController;
use App\Http\Controllers\EtudiantController;
use App\Http\Controllers\ProfesseurController;
use App\Http\Controllers\ReclamationController;
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
        Route::get('/', [App\Http\Controllers\EtudiantController::class, 'index'])->name('index');
        Route::get('ressources', 'ressources')->name('ressources.index');
        Route::get('notes', 'notes')->name('notes.index');
        Route::resource('annonces', App\Http\Controllers\EtudiantAnnonceController::class);
        Route::resource('emploi_du_temps', App\Http\Controllers\EtudiantEmploiDuTempsController::class);

    });

});

Route::middleware('auth')->group(function () {
    Route::post('reclamation', [ReclamationController::class, 'store'])->name('reclamation.store');
});

Route::middleware(['auth', 'check.user.type:professeur'])->group(function () {

    Route::prefix('professeur')->name('professeur.')->controller(ProfesseurController::class)->group(function () {
        Route::get('/', 'index')->name('index');
        Route::resource('ressources', \App\Http\Controllers\Professeur\RessourcesController::class);
//        Route::resource('notes', \App\Http\Controllers\Professeur\NotesController::class);
        Route::get('etudiant/{module}', [\App\Http\Controllers\Professeur\EtudiantController::class, 'index'])->name('etudiant.index');

        Route::put('etudiant/{module}/edit-notes/{etudiant}', [\App\Http\Controllers\Professeur\EtudiantController::class, 'update'])->name('etudiant.notes.edit');

        Route::resource('etudiant', \App\Http\Controllers\Professeur\EtudiantController::class)->except(['index', 'update']);
        Route::resource('modules', \App\Http\Controllers\Professeur\ModuleController::class);

    });
});


Route::middleware(['auth', 'check.user.type:admin'])->group(function () {
    Route::prefix('admin')->name('admin.')->group(function () {
        Route::get('/', [\App\Http\Controllers\Admin\AdminController::class, 'index'])->name('index');
        Route::resource('professeur', \App\Http\Controllers\Admin\ProfesseurController::class);
        Route::resource('etudiant', \App\Http\Controllers\Admin\EtudiantController::class);
        Route::resource('personnel_administratifs', \App\Http\Controllers\Admin\PersonnelAdministratifController::class);
        Route::resource('annonces', \App\Http\Controllers\Admin\AnnoncesController::class);
        Route::resource('filieres', \App\Http\Controllers\Admin\FiliereController::class);
        Route::resource('modules', \App\Http\Controllers\Admin\ModuleController::class);
    });
});

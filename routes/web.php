<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\{
  AgencyController,
  DashboardController,
  DemandController,
  DocumentController,
  FileController,
  LogsController,
  MenuController,
  PasswordController,
  ProfileController,
  StatusController,
  TownController,
  UserController,
};

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

//404
Route::fallback(function() {
    return view('404');
});
// Route pour les utilisateurs
Route::controller(UserController::class)->group(function () {
  Route::get('/', 'login')->name('login');
  Route::post('auth', 'auth');
});
// Routes pour les mots de passe oubliés
Route::controller(PasswordController::class)->group(function () {
  Route::get('forgotpass', 'index');
  Route::post('forgotpass', 'store');
});
// Route pour les documents
Route::get('getDocs/{id}', [DocumentController::class, 'getDocs']);
// Routes protégées par authentification
Route::middleware(['auth'])->group(function () {
  // Route pour Tableau de bord
  Route::get('dashboard', [DashboardController::class, 'index']);
  // Route pour les utilisateurs
  Route::controller(UserController::class)->group(function () {
    Route::get('account', 'account');
    Route::get('logout', 'logout');
  });
  // Routes pour les mots de passe
  Route::controller(PasswordController::class)->group(function () {
    Route::get('password', 'edit');
    Route::put('password', 'update');
  });
  // Routes pour liste des villes
  Route::post('towns/list', [TownController::class, 'list']);
  // Routes pour liste des agences
  Route::post('agencies/list', [AgencyController::class, 'list']);
  // Route pour les statuts
  Route::patch('{type}/status/{uuid}', [StatusController::class, 'update']);
  // Route pour les pistes d'audit
  Route::get('logs', [LogsController::class, 'index']);
  Route::get('getLogs', [LogsController::class, 'getLogs']);
  // Route des ressources
  Route::resources([
    'agencies' => AgencyController::class,
    'demands' => DemandController::class,
    'documents' => DocumentController::class,
    'files' => FileController::class,
    'menus' => MenuController::class,
    'profiles' => ProfileController::class,
    'towns' => TownController::class,
    'users' => UserController::class,
  ]);
});

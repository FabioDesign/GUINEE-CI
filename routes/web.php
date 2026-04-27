<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\{
  DashboardController,
  DocumentController,
  FileController,
  MenuController,
  PasswordController,
  ProfileController,
  RequestController,
  StatusController,
  TownController,
  LogsController,
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
  Route::get('/logout', 'logout');
  Route::post('/users/auth', 'auth');
});
// Routes pour les mots de passe oubliés
Route::controller(PasswordController::class)->group(function () {
  Route::get('/forgotpass', 'index');
  Route::post('/forgotpass', 'store');
});
// Routes protégées par authentification
Route::middleware(['auth'])->group(function () {
  Route::resources([
    'menus' => MenuController::class,
    'files' => FileController::class,
    'towns' => TownController::class,
    'users' => UserController::class,
    'profiles' => ProfileController::class,
    'documents' => DocumentController::class,
    'requests' => RequestController::class,
  ]);
  // Route pour Tableau de bord
  Route::get('/dashboard', [DashboardController::class, 'index']);
  // Route pour les utilisateurs
  Route::controller(UserController::class)->group(function () {
    Route::post('/avatar', 'avatar');
    Route::post('/profil', 'profil');
    Route::get('/account', 'account');
  });
  // Routes pour les mots de passe
  Route::controller(PasswordController::class)->group(function () {
    Route::get('/password', 'edit');
    Route::post('/password', 'updaute');
  });
  // Routes pour liste des villes
  Route::post('/towns/list', [TownController::class, 'list']);
  // Route pour les statuts
  Route::patch('/{type}/status/{uid}', [StatusController::class, 'update']);
  // Route pour les pistes d'audit
  Route::get('/logs', [LogsController::class, 'index']);
});

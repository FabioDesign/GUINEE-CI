<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\API\{
    DocumentController,
    ListsController,
    PasswordController,
    ProfileController,
    RegisterController,
    RequestdocController,
    UserController,
    TodoController,
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
  $response = [
    'status' => 404,
    'message' => "Page introuvable.",
    'data' => [],
  ];
  return response()->json($response, 404);
});
// Route pour la connexion
Route::post('users/auth', [UserController::class, 'login']);
// Route pour Todo
Route::resources([
  'todos' => TodoController::class,
]);
// Routes pour les mots de passe oubliés
Route::controller(PasswordController::class)->group(function () {
  Route::post('password/verifemail', 'verifemail');
  Route::post('password/verifotp', 'verifotp');
  Route::post('password/addpass', 'addpass');
  Route::post('password/addpass', 'addpass');
  Route::post('password/addpass', 'addpass');
});
// Route pour les listes
Route::controller(ListsController::class)->group(function () {
  Route::get('menus/list/{lg}', 'menus');
  Route::get('actions/list/{lg}', 'actions');
  Route::get('periods/list/{lg}', 'periods');
  Route::get('country/list/{lg}', 'country');
  Route::get('provinces/list/{lg}', 'provinces');
  Route::get('documents/list/{lg}', 'documents');
  Route::get('menuactions/list/{lg}', 'menuactions');
  Route::get('cells/list/{lg}/{sector_id}', 'cells');
  Route::get('nationality/list/{lg}', 'nationality');
  Route::get('documents/detail/{lg}/{uid}', 'docdetail');
  Route::get('regions/list/{lg}/{country_id}', 'regions');
  Route::get('sectors/list/{lg}/{district_id}', 'sectors');
  Route::get('districts/list/{lg}/{province_id}', 'districts');
});

Route::middleware(['auth:api'])->group(function () {
  Route::resources([
    'users' => UserController::class,
    'profiles' => ProfileController::class,
    'documents' => DocumentController::class,
    'requestdoc' => RequestdocController::class,
  ]);
  // Route pour la liste des actions d'un menu
  Route::get('profiles/menu/{id}', [ProfileController::class, 'menu']);
  // Route pour la modification du profil utilisateur
  Route::controller(UserController::class)->group(function () {
    Route::post('users/profil', 'profil');
    // Route pour la photo de profil
    Route::post('users/photo', 'photo');
    // Route pour la deconnexion
    Route::post('users/logout', 'logout');
  });
  // Route pour les mots de passe
  Route::post('password/editpass', [PasswordController::class, 'editpass']);
});

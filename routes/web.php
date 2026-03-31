<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\{
  DocumentController,
  ListsController,
  PasswordController,
  ProfileController,
  RequestController,
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
Route::view('forgotpass', 'forgotpass');
Route::resources([
  'users' => UserController::class,
  'profiles' => ProfileController::class,
  'documents' => DocumentController::class,
  'requests' => RequestController::class,
]);
// Route pour les utilisateurs
Route::controller(UserController::class)->group(function () {
  Route::get('/', 'login');
  Route::post('users/auth', 'auth');
});
// Routes pour les mots de passe oubliés
Route::controller(PasswordController::class)->group(function () {
  Route::post('password/verifemail', 'verifemail');
  Route::post('password/verifotp', 'verifotp');
  Route::post('password/addpass', 'addpass');
  Route::post('password/editpass', 'editpass');
});
// Route pour les listes
Route::controller(ListsController::class)->group(function () {
  Route::get('country/list/{lg}', 'country');
  Route::get('documents/list/{lg}', 'documents');
  Route::get('nationality/list/{lg}', 'nationality');
  Route::get('regions/list/{lg}/{country_id}', 'regions');
  Route::get('sectors/list/{lg}/{district_id}', 'sectors');
  Route::get('districts/list/{lg}/{province_id}', 'districts');
});
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

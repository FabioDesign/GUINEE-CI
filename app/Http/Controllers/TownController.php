<?php

namespace App\Http\Controllers;

use Session;
use Myhelper;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Models\{Country, Town, User};
use Illuminate\Support\Facades\{Auth, DB, Log, Validator};

class TownController extends Controller
{
    //Liste des Villes
	public function index()
	{
        if (!Auth::check()) {
            return redirect('/');
        }
		//Title
		$title = 'Gestion des Villes';
		//Menu
		$currentMenu = 'towns';
		//Modal
		$actionIds = Myhelper::actions(Auth::user()->profile_id, 5);
		$addmodal = in_array(2, $actionIds) ? '<a href="/towns/create" class="btn btn-sm fw-bold btn-primary">Ajouter une ville</a>':'';
		//Requete Read
		$query = Town::select('towns.uid', 'towns.libelle as town', 'towns.status', 'towns.created_at', 'alpha', 'country.libelle AS country')
		->join('country', 'country.id','=','towns.country_id')
        ->orderByDesc('created_at')->get();
		Myhelper::logs(
			Session::get('username'),
			Session::get('profil'),
			"Ville: Liste",
			'Consulter',
			Session::get('avatar')
		);
		return view('pages.towns.index', compact('title', 'currentMenu', 'addmodal', 'actionIds', 'query'));
	}
    //Liste des villes
	public function create()
	{
        if (!Auth::check()) {
            return redirect('/');
        }
		//Title
		$title = "Ajout d'une ville";
		//Menu
		$currentMenu = 'towns';
		//Modal
		$addmodal = '<a href="/towns" class="btn btn-sm fw-bold btn-danger">Retour</a>
		<a href="#" class="btn btn-sm fw-bold btn-success submitForm">Ajouter</a>';
		//Requete Read
		$query = Country::orderBy('libelle')->get();
		return view('pages.towns.create', compact('title', 'currentMenu', 'addmodal', 'query'));
	}
	//Add ville
	public function store(Request $request)
	{
        if (!Auth::check()) {
            return 'x';
        }
		// Validator
		$validator = Validator::make($request->all(), [
			'libelle' => [
				'required',
				Rule::unique('towns')->where(function ($query) {
					return $query->whereNull('deleted_at');
				}),
			],
			'country_id' => 'required',
		], [
			'libelle.required' => "La ville est obligatoire.",
			'libelle.unique' => "La ville existe déjà dans la base de données.",
			'country_id.required' => "Le pays est obligatoire.",
		]);
		// Error field
		if ($validator->fails()) {
			Log::warning("Town::store - Validator : {$validator->errors()->first()} - " . json_encode($request->all()));
			return response()->json([
				'status' => 0,
				'message' => $validator->errors()->first(),
			]);
		}
		$set = [
			'country_id' => $request->country_id,
			'libelle' => Str::upper(Myhelper::valideString($request->libelle)),
		];
		DB::beginTransaction();
		try {
			Town::create($set);
			DB::commit();
			Myhelper::logs(
				Session::get('username'),
				Session::get('profil'),
				"Ville: {$request->libelle}",
				'Ajouter',
				Session::get('avatar')
			);
			return response()->json([
				'status' => 1,
				'message' => "Ville enregistrée avec succès.",
			]);
		} catch (\Exception $e) {
			DB::rollBack();
			Log::warning("Town::store - Erreur : {$e->getMessage()} " . json_encode($request->all()));
			return response()->json([
				'status' => 0,
				'message' => "Erreur lors de l'enregistrement.",
			]);
		}
	}
	// Afficher le formulaire d'édition d'une ville
	public function edit($uid)
	{
        if (!Auth::check()) {
            return redirect('/');
        }
		// Title
		$title = 'Modification de la ville';
		// Menu
		$currentMenu = 'towns';
		// Vérifier si la ville existe
		$query = Town::where('uid', $uid)->first();
		if (!$query) {
			Log::warning("Town::edit - Aucune ville trouvée pour l'UID : {$uid}");
			return redirect('/towns');
		}
		// Modal
		$addmodal = '<a href="/towns" class="btn btn-sm fw-bold btn-danger">Retour</a>
		<a href="#" class="btn btn-sm fw-bold btn-success submitForm">Modifier</a>';
		//Requete Read
		$list = Country::orderBy('libelle')->get();
		return view('pages.towns.edit', compact('title', 'currentMenu', 'addmodal', 'query', 'list'));
	}
	// Mettre à jour une ville
	public function update(Request $request, $uid)
	{
        if (!Auth::check()) {
            return 'x';
        }
        try {
			// Vérifier si le ville existe
			$town = Town::where('uid', $uid)->first();
			if (!$town) {
				Log::warning("Town::update - Aucune ville trouvée pour l'UID : {$uid}");
				return response()->json([
					'status' => 0,
					'message' => "Ville non trouvée.",
				]);
			}
			// Validator
			$validator = Validator::make($request->all(), [
				'libelle' => [
					'required',
					Rule::unique('towns')->where(function ($query) use ($uid) {
						return $query->where('uid', '!=', $uid)->whereNull('deleted_at');
					}),
				],
				'country_id' => 'required',
			], [
				'libelle.required' => "La ville est obligatoire.",
				'libelle.unique' => "La ville existe déjà dans la base de données.",
				'country_id.required' => "Le pays est obligatoire.",
			]);
			// Error field
			if ($validator->fails()) {
				Log::warning("Town::update - Validator : {$validator->errors()->first()} - " . json_encode($request->all()));
				return response()->json([
					'status' => 0,
					'message' => $validator->errors()->first(),
				]);
			}
			$set = [
				'country_id' => $request->country_id,
				'libelle' => Str::upper(Myhelper::valideString($request->libelle)),
			];
			DB::beginTransaction(); // Démarrer une transaction
			// Mettre à jour la ville
			$town->update($set);
			DB::commit(); // Valider la transaction
			Myhelper::logs(
				Session::get('username'),
				Session::get('profil'),
				"Ville: {$request->libelle}",
				'Modifier',
				Session::get('avatar')
			);
			return response()->json([
				'status' => 1,
				'message' => "Ville modifiée avec succès.",
			]);
		} catch (\Exception $e) {
			DB::rollBack(); // Annuler la transaction en cas d'erreur
			Log::warning("Town::update - Erreur : {$e->getMessage()} " . json_encode($request->all()));
			return response()->json([
				'status' => 0,
				'message' => "Erreur lors de la modification.",
			]);
		}
	}
	// Supprimer une ville
	public function destroy($uid)
	{
        if (!Auth::check()) {
            return 'x';
        }
		try {
			// Vérifier si la ville existe
			$town = Town::where('uid', $uid)->first();
			if (!$town) {
				Log::warning("Town::destroy - Aucune ville trouvée pour l'UID : {$uid}");
				return response()->json([
					'status' => 0,
					'message' => "Ville non trouvée.",
				]);
			}
			// Vérifier si des utilisateurs sont associés
			$townCount = User::where('town_id', $town->id)->count();
			if ($townCount > 0) {
				Log::warning("Town::destroy - Cette ville est associée à {$townCount} utilisateur(s).");
				return response()->json([
					'status' => 0,
					'message' => "Cette ville est associée à {$townCount} utilisateur(s).",
				]);
			}
			DB::beginTransaction();
			// Supprimer la ville
			$town->delete();
			DB::commit();
			Myhelper::logs(
				Session::get('username'),
				Session::get('profil'),
				"Ville: " . $town->libelle,
				'Supprimer',
				Session::get('avatar')
			);
			return response()->json([
				'status' => 1,
				'message' => "Ville supprimée avec succès.",
			]);
		} catch (\Exception $e) {
			DB::rollBack();
			Log::warning("Town::destroy - Erreur : {$e->getMessage()}");
			return response()->json([
				'status' => 0,
				'message' => "Erreur lors de la suppression.",
			]);
		}
	}
	//Add ville
	public function list(Request $request)
	{
        if (!Auth::check()) {
            return 'x';
        }
		// Validator
		$validator = Validator::make($request->all(), [
			'country_id' => 'required',
		], [
			'country_id.required' => "Le pays est obligatoire.",
		]);
		// Error field
		if ($validator->fails()) {
			Log::warning("Town::list - Validator : {$validator->errors()->first()} - " . json_encode($request->all()));
			return response()->json([
				'status' => 0,
				'message' => $validator->errors()->first(),
			]);
		}
		try {
			$town = Town::select('id', 'libelle')
			->where('country_id', $request->country_id)
			->orderBy('libelle')
			->get();
			return response()->json([
				'status' => 1,
				'message' => "Villes chargées avec succès.",
				'data' => $town,
			]);
		} catch (\Exception $e) {
			Log::warning("Town::list : {$e->getMessage()}");
			return response()->json([
				'status' => 0,
				'message' => "Erreur lors de l'affichage des villes.",
			]);
		}
	}
}

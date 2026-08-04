<?php

namespace App\Http\Controllers;

use Session;
use Myhelper;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Models\{Consulat, Country, User};
use Illuminate\Support\Facades\{Auth, DB, Log, Validator};

class ConsulatController extends Controller
{
    // Liste des Consulats
	public function index() {
        if (!Auth::check()) {
            return redirect('/');
        }
		// Title
		$title = 'Gestion des Consulats';
		// Menu
		$currentMenu = 'consulats';
		// Modal
		$actionIds = Myhelper::actions(Auth::user()->profile_id, 6);
		$addmodal = in_array(2, $actionIds) ? '<a href="/consulats/create" class="btn btn-sm fw-bold btn-primary">Ajouter un consulat</a>':'';
		// Requete Read
		$query = Consulat::select('uuid', 'label', 'status', 'created_at', 'country_id')
        ->orderByDesc('created_at')
		->get();
		Myhelper::auditTrail(
			Auth::user()->consulat_id,
			Auth::user()->profile_id,
			Session::get('username'),
			Session::get('profil'),
			"Consulat: Liste",
			'Consulter',
			Session::get('avatar')
		);
		return view('pages.consulats.index', compact('title', 'currentMenu', 'addmodal', 'actionIds', 'query'));
	}
    // Liste des consulats
	public function create() {
        if (!Auth::check()) {
            return redirect('/');
        }
		// Title
		$title = "Ajout d'un consulat";
		// Menu
		$currentMenu = 'consulats';
		// Modal
		$addmodal = '<a href="/consulats" class="btn btn-sm fw-bold btn-danger">Retour</a>
		<a href="#" class="btn btn-sm fw-bold btn-success submitForm">Ajouter</a>';
		// Requete Read
		$query = Country::orderBy('country')->get();
		return view('pages.consulats.create', compact('title', 'currentMenu', 'addmodal', 'query'));
	}
	// Add consulat
	public function store(Request $request) {
        if (!Auth::check()) {
            return 'x';
        }
		// Validator
		$validator = Validator::make($request->all(), [
			'label' => [
				'required',
				Rule::unique('consulats')->where(function ($query) {
					return $query->whereNull('deleted_at');
				}),
			],
			'country_id' => 'required|exists:countries,id',
		], [
			'label.required' => "Le consulat est obligatoire.",
			'label.unique' => "Le consulat existe déjà dans la base de données.",
			'country_id.required' => "Le pays est obligatoire.",
			'country_id.exists' => "Le pays n'existe pas dans la base de données.",
		]);
		// Error field
		if ($validator->fails()) {
			Log::warning("Consulat::store - Validator : {$validator->errors()->first()} - " . json_encode($request->all()));
			return response()->json([
				'status' => 0,
				'message' => $validator->errors()->first(),
			]);
		}
		DB::beginTransaction();
		try {
			// Enregistrer le pays si il n'existe pas
			Country::updateOrCreate(
				['id' => $request->country_id],
				['embassy' => 1]
			);
			// Enregistrer le consulat
			Consulat::create([
				'country_id' => $request->country_id,
				'label' => Str::upper(Myhelper::valideString($request->label)),
			]);
			DB::commit();
			Myhelper::auditTrail(
				Auth::user()->consulat_id,
				Auth::user()->profile_id,
				Session::get('username'),
				Session::get('profil'),
				"Consulat: {$request->label}",
				'Ajouter',
				Session::get('avatar')
			);
			return response()->json([
				'status' => 1,
				'message' => "Consulat enregistré avec succès.",
			]);
		} catch (\Exception $e) {
			DB::rollBack();
			Log::warning("Consulat::store - Erreur : {$e->getMessage()} " . json_encode($request->all()));
			return response()->json([
				'status' => 0,
				'message' => "Erreur lors de l'enregistrement.",
			]);
		}
	}
	// Afficher le formulaire d'édition d'un consulat
	public function edit($uuid) {
        if (!Auth::check()) {
            return redirect('/');
        }
		// Title
		$title = "Modification du consulat";
		// Menu
		$currentMenu = 'consulats';
		// Vérifier si le consulat existe
		$query = Consulat::where('uuid', $uuid)->first();
		if (!$query) {
			Log::warning("Consulat::edit - Aucun consulat trouvé pour l'UUID : {$uuid}");
			return redirect('/consulats');
		}
		// Modal
		$addmodal = '<a href="/consulats" class="btn btn-sm fw-bold btn-danger">Retour</a>
		<a href="#" class="btn btn-sm fw-bold btn-success submitForm">Modifier</a>';
		// Requete Read
		$list = Country::orderBy('country')->get();
		return view('pages.consulats.edit', compact('title', 'currentMenu', 'addmodal', 'query', 'list'));
	}
	// Mettre à jour un consulat
	public function update(Request $request, $uuid) {
        if (!Auth::check()) {
            return 'x';
        }
        try {
			// Vérifier si le consulat existe
			$consulat = Consulat::where('uuid', $uuid)->first();
			if (!$consulat) {
				Log::warning("Consulat::update - Aucun consulat trouvé pour l'UUID : {$uuid}");
				return response()->json([
					'status' => 0,
					'message' => "Consulat non trouvé.",
				]);
			}
			// Validator
			$validator = Validator::make($request->all(), [
				'label' => [
					'required',
					Rule::unique('consulats')->where(function ($query) use ($uuid) {
						return $query->where('uuid', '!=', $uuid)->whereNull('deleted_at');
					}),
				],
			], [
				'label.required' => "Le consulat est obligatoire.",
				'label.unique' => "Le consulat existe déjà dans la base de données.",
			]);
			// Error field
			if ($validator->fails()) {
				Log::warning("Consulat::update - Validator : {$validator->errors()->first()} - " . json_encode($request->all()));
				return response()->json([
					'status' => 0,
					'message' => $validator->errors()->first(),
				]);
			}
			$label = Str::upper(Myhelper::valideString($request->label));
			DB::beginTransaction(); // Démarrer une transaction
			// Mettre à jour le consulat
			$consulat->update([
				'label' => $label,
			]);
			DB::commit(); // Valider la transaction
			Myhelper::auditTrail(
				Auth::user()->consulat_id,
				Auth::user()->profile_id,
				Session::get('username'),
				Session::get('profil'),
				"Consulat: {$label}",
				'Modifier',
				Session::get('avatar')
			);
			return response()->json([
				'status' => 1,
				'message' => "Consulat modifié avec succès.",
			]);
		} catch (\Exception $e) {
			DB::rollBack(); // Annuler la transaction en cas d'erreur
			Log::warning("Consulat::update - Erreur : {$e->getMessage()} " . json_encode($request->all()));
			return response()->json([
				'status' => 0,
				'message' => "Erreur lors de la modification.",
			]);
		}
	}
	// Supprimer un consulat
	public function destroy($uuid) {
        if (!Auth::check()) {
            return 'x';
        }
		try {
			// Vérifier si le consulat existe
			$consulat = Consulat::where('uuid', $uuid)->first();
			if (!$consulat) {
				Log::warning("Consulat::destroy - Aucun consulat trouvé pour l'UUID : {$uuid}");
				return response()->json([
					'status' => 0,
					'message' => "Consulat non trouvé.",
				]);
			}
			// Vérifier si des utilisateurs sont associés
			$consulatCount = User::where('consulat_id', $consulat->id)->count();
			if ($consulatCount > 0) {
				Log::warning("Consulat::destroy - Cet consulat est associé à {$consulatCount} utilisateur(s).");
				return response()->json([
					'status' => 0,
					'message' => "Cet consulat est associé à {$consulatCount} utilisateur(s).",
				]);
			}
			DB::beginTransaction();
			// Supprimer le consulat
			$consulat->delete();
			DB::commit();
			Myhelper::auditTrail(
				Auth::user()->consulat_id,
				Auth::user()->profile_id,
				Session::get('username'),
				Session::get('profil'),
				"Consulat: " . $consulat->label,
				'Supprimer',
				Session::get('avatar')
			);
			return response()->json([
				'status' => 1,
				'message' => "Consulat supprimé avec succès.",
			]);
		} catch (\Exception $e) {
			DB::rollBack();
			Log::warning("Consulat::destroy - Erreur : {$e->getMessage()}");
			return response()->json([
				'status' => 0,
				'message' => "Erreur lors de la suppression.",
			]);
		}
	}
	// Add consulat
	public function list(Request $request) {
        if (!Auth::check()) {
            return 'x';
        }
		// Validator
		$validator = Validator::make($request->all(), [
			'country_id' => 'required|exists:countries,id',
		], [
			'country_id.required' => "Le pays est obligatoire.",
			'country_id.exists' => "Le pays n'existe pas dans la base de données.",
		]);
		// Error field
		if ($validator->fails()) {
			Log::warning("Consulat::list - Validator : {$validator->errors()->first()} - " . json_encode($request->all()));
			return response()->json([
				'status' => 0,
				'message' => $validator->errors()->first(),
			]);
		}
		try {
			$consulat = Consulat::select('id', 'label')
			->where('country_id', $request->country_id)
			->orderBy('label')
			->get();
			return response()->json([
				'status' => 1,
				'message' => "Consulats chargés avec succès.",
				'data' => $consulat,
			]);
		} catch (\Exception $e) {
			Log::warning("Consulat::list : {$e->getMessage()}");
			return response()->json([
				'status' => 0,
				'message' => "Erreur lors de l'affichage des consulats.",
			]);
		}
	}
}

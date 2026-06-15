<?php

namespace App\Http\Controllers;

use Session;
use Myhelper;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Models\{Agency, Country, User};
use Illuminate\Support\Facades\{Auth, DB, Log, Validator};

class AgencyController extends Controller
{
    // Liste des Agences
	public function index() {
        if (!Auth::check()) {
            return redirect('/');
        }
		// Title
		$title = 'Gestion des Agences';
		// Menu
		$currentMenu = 'agencies';
		// Modal
		$actionIds = Myhelper::actions(Auth::user()->profile_id, 6);
		$addmodal = in_array(2, $actionIds) ? '<a href="/agencies/create" class="btn btn-sm fw-bold btn-primary">Ajouter une agence</a>':'';
		// Requete Read
		$query = Agency::select('uuid', 'label', 'status', 'created_at', 'country_id')
        ->orderByDesc('created_at')->get();
		Myhelper::logs(
			Session::get('username'),
			Session::get('profil'),
			"Agence: Liste",
			'Consulter',
			Session::get('avatar')
		);
		return view('pages.agencies.index', compact('title', 'currentMenu', 'addmodal', 'actionIds', 'query'));
	}
    // Liste des agences
	public function create() {
        if (!Auth::check()) {
            return redirect('/');
        }
		// Title
		$title = "Ajout d'une agence";
		// Menu
		$currentMenu = 'agencies';
		// Modal
		$addmodal = '<a href="/agencies" class="btn btn-sm fw-bold btn-danger">Retour</a>
		<a href="#" class="btn btn-sm fw-bold btn-success submitForm">Ajouter</a>';
		// Requete Read
		$query = Country::orderBy('country')->get();
		return view('pages.agencies.create', compact('title', 'currentMenu', 'addmodal', 'query'));
	}
	// Add agence
	public function store(Request $request) {
        if (!Auth::check()) {
            return 'x';
        }
		// Validator
		$validator = Validator::make($request->all(), [
			'label' => [
				'required',
				Rule::unique('agencies')->where(function ($query) {
					return $query->whereNull('deleted_at');
				}),
			],
			'country_id' => 'required|exists:countries,id',
		], [
			'label.required' => "L'agence est obligatoire.",
			'label.unique' => "L'agence existe déjà dans la base de données.",
			'country_id.required' => "Le pays est obligatoire.",
			'country_id.exists' => "Le pays n'existe pas dans la base de données.",
		]);
		// Error field
		if ($validator->fails()) {
			Log::warning("Agency::store - Validator : {$validator->errors()->first()} - " . json_encode($request->all()));
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
			// Enregistrer l'agence
			Agency::create([
				'country_id' => $request->country_id,
				'label' => Str::upper(Myhelper::valideString($request->label)),
			]);
			DB::commit();
			Myhelper::logs(
				Session::get('username'),
				Session::get('profil'),
				"Agence: {$request->label}",
				'Ajouter',
				Session::get('avatar')
			);
			return response()->json([
				'status' => 1,
				'message' => "Agence enregistrée avec succès.",
			]);
		} catch (\Exception $e) {
			DB::rollBack();
			Log::warning("Agency::store - Erreur : {$e->getMessage()} " . json_encode($request->all()));
			return response()->json([
				'status' => 0,
				'message' => "Erreur lors de l'enregistrement.",
			]);
		}
	}
	// Afficher le formulaire d'édition d'une agence
	public function edit($uuid) {
        if (!Auth::check()) {
            return redirect('/');
        }
		// Title
		$title = "Modification de l'agence";
		// Menu
		$currentMenu = 'agencies';
		// Vérifier si l'agence existe
		$query = Agency::where('uuid', $uuid)->first();
		if (!$query) {
			Log::warning("Agency::edit - Aucune agence trouvée pour l'UUID : {$uuid}");
			return redirect('/agencies');
		}
		// Modal
		$addmodal = '<a href="/agencies" class="btn btn-sm fw-bold btn-danger">Retour</a>
		<a href="#" class="btn btn-sm fw-bold btn-success submitForm">Modifier</a>';
		// Requete Read
		$list = Country::orderBy('country')->get();
		return view('pages.agencies.edit', compact('title', 'currentMenu', 'addmodal', 'query', 'list'));
	}
	// Mettre à jour une agence
	public function update(Request $request, $uuid) {
        if (!Auth::check()) {
            return 'x';
        }
        try {
			// Vérifier si le agence existe
			$agency = Agency::where('uuid', $uuid)->first();
			if (!$agency) {
				Log::warning("Agency::update - Aucune agence trouvée pour l'UUID : {$uuid}");
				return response()->json([
					'status' => 0,
					'message' => "Agence non trouvée.",
				]);
			}
			// Validator
			$validator = Validator::make($request->all(), [
				'label' => [
					'required',
					Rule::unique('agencies')->where(function ($query) use ($uuid) {
						return $query->where('uuid', '!=', $uuid)->whereNull('deleted_at');
					}),
				],
			], [
				'label.required' => "L'agence est obligatoire.",
				'label.unique' => "L'agence existe déjà dans la base de données.",
			]);
			// Error field
			if ($validator->fails()) {
				Log::warning("Agency::update - Validator : {$validator->errors()->first()} - " . json_encode($request->all()));
				return response()->json([
					'status' => 0,
					'message' => $validator->errors()->first(),
				]);
			}
			$label = Str::upper(Myhelper::valideString($request->label));
			DB::beginTransaction(); // Démarrer une transaction
			// Mettre à jour l'agence
			$agency->update([
				'label' => $label,
			]);
			DB::commit(); // Valider la transaction
			Myhelper::logs(
				Session::get('username'),
				Session::get('profil'),
				"Agence: {$label}",
				'Modifier',
				Session::get('avatar')
			);
			return response()->json([
				'status' => 1,
				'message' => "Agence modifiée avec succès.",
			]);
		} catch (\Exception $e) {
			DB::rollBack(); // Annuler la transaction en cas d'erreur
			Log::warning("Agency::update - Erreur : {$e->getMessage()} " . json_encode($request->all()));
			return response()->json([
				'status' => 0,
				'message' => "Erreur lors de la modification.",
			]);
		}
	}
	// Supprimer une agence
	public function destroy($uuid) {
        if (!Auth::check()) {
            return 'x';
        }
		try {
			// Vérifier si l'agence existe
			$agency = Agency::where('uuid', $uuid)->first();
			if (!$agency) {
				Log::warning("Agency::destroy - Aucune agence trouvée pour l'UUID : {$uuid}");
				return response()->json([
					'status' => 0,
					'message' => "Agence non trouvée.",
				]);
			}
			// Vérifier si des utilisateurs sont associés
			$agencyCount = User::where('agency_id', $agency->id)->count();
			if ($agencyCount > 0) {
				Log::warning("Agency::destroy - Cette agence est associée à {$agencyCount} utilisateur(s).");
				return response()->json([
					'status' => 0,
					'message' => "Cette agence est associée à {$agencyCount} utilisateur(s).",
				]);
			}
			DB::beginTransaction();
			// Supprimer l'agence
			$agency->delete();
			DB::commit();
			Myhelper::logs(
				Session::get('username'),
				Session::get('profil'),
				"Agence: " . $agency->label,
				'Supprimer',
				Session::get('avatar')
			);
			return response()->json([
				'status' => 1,
				'message' => "Agence supprimée avec succès.",
			]);
		} catch (\Exception $e) {
			DB::rollBack();
			Log::warning("Agency::destroy - Erreur : {$e->getMessage()}");
			return response()->json([
				'status' => 0,
				'message' => "Erreur lors de la suppression.",
			]);
		}
	}
	// Add agence
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
			Log::warning("Agency::list - Validator : {$validator->errors()->first()} - " . json_encode($request->all()));
			return response()->json([
				'status' => 0,
				'message' => $validator->errors()->first(),
			]);
		}
		try {
			$agency = Agency::select('id', 'label')
			->where('country_id', $request->country_id)
			->orderBy('label')
			->get();
			return response()->json([
				'status' => 1,
				'message' => "Agences chargées avec succès.",
				'data' => $agency,
			]);
		} catch (\Exception $e) {
			Log::warning("Agency::list : {$e->getMessage()}");
			return response()->json([
				'status' => 0,
				'message' => "Erreur lors de l'affichage des agences.",
			]);
		}
	}
}

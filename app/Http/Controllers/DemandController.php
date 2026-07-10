<?php

namespace App\Http\Controllers;

use Session;
use Myhelper;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\{Auth, DB, Log, Validator};
use App\Models\{Agency, Country, Demand, DocFile, Document, File, Profile, Town, User};

class DemandController extends Controller
{
    // Liste des demandes consulaires
	public function index() {
        if (!Auth::check()) {
            return redirect('/');
        }
		// Title
		$title = 'Gestion des demandes consulaires';
		// Menu
		$currentMenu = 'demands';
		// Modal
		$actionIds = Myhelper::actions(Auth::user()->profile_id, 2);
		$addmodal = in_array(2, $actionIds) ? '<a href="/demands/create" class="btn btn-sm fw-bold btn-primary">Ajouter une demande</a>':'';
		// Requete Read
		$query = Demand::orderByDesc('created_at')->get();
		return view('pages.demands.index', compact('title', 'currentMenu', 'addmodal', 'actionIds', 'query'));
	}
    // Liste des demandes consulaires
	public function getDemands() {
		//Requete Read
		$query = Demand::orderBy('status')
		->orderByDesc('created_at')
		->get();
		// Transformer les données
		$demands = $query->map(fn($data) => [
			'uuid' => $data->uuid,
			'code' => $data->code,
			'label' => $data->document->label,
			'number' => $data->number,
			'email' => $data->email,
			'company' => $data->company,
			'status' => match((int)$data->status) {
				0 => __('message.inactive'),
				1 => __('message.active'),
				2 => __('message.blocked'),
			},
			'created_at' => $data->created_at->format('d/m/Y H:i'),
		]);
		return response()->json([
			'status' => true,
			'data' => $demands,
		]);
	}
	// Afficher le détail d'une demande
	public function show($uuid) {
        if (!Auth::check()) {
            return redirect('/');
        }
		// Title
		$title = 'Détail du document consulaire';
		// Menu
		$currentMenu = 'demands';
		// Vérifier si le document existe
		$query = Demand::where('uuid', $uuid)->first();
		if (!$query) {
			Log::warning("Demand::show - Aucune demande trouvée pour l'uUID : {$uuid}");
			return redirect('/demands');
		}
		// Modal
		$addmodal = '<a href="/demands" class="btn btn-sm fw-bold btn-danger">Retour</a>';
		return view('pages.demands.show', compact('title', 'currentMenu', 'addmodal', 'query'));
	}
    //Liste des demandes
	public function create() {
        if (!Auth::check()) {
            return redirect('/');
        }
		//Title
		$title = "Ajout d'une demande";
		//Menu
		$currentMenu = 'demands';
		//Modal
		$addmodal = '<a href="/demands" class="btn btn-sm fw-bold btn-danger">Retour</a>
		<a href="#" class="btn btn-sm fw-bold btn-success submitForm">Ajouter</a>';
        $civility = ['M.', 'Mme', 'Mlle'];
		$pays = Country::orderBy('country')->get();
		$agency = Agency::where('country_id', 41)->orderBy('label')->get();
		$nationality = Country::orderBy('nationality')->get();
		$town = Town::where('country_id', 61)->orderBy('label')->get();
		$country = Country::where('embassy', 1)->orderBy('country')->get();
		$profile = Profile::where('id', '!=', 1)->orderBy('label')->get();
		$documents = Document::orderBy('label')->get();
		$firstDoc = $documents->first();
		$docFiles = DocFile::where('document_id', $firstDoc->id)->get();
		return view('pages.demands.create', compact('title', 'currentMenu', 'addmodal', 'civility', 'town', 'pays', 'profile', 'country', 'nationality', 'agency', 'documents', 'docFiles', 'firstDoc'));
	}
	//Add document
	public function store(request $request) {
        if (!Auth::check()) {
            return 'x';
        }
		// Validator
		$validator = Validator::make($request->all(), [
			'label' => [
				'required',
				Rule::unique('demands')->where(function ($query) {
					return $query->whereNull('deleted_at');
				}),
			],
			'price' => 'required|integer|min:1',
			'day' => 'required|integer|min:1',
			'description' => 'required',
		], [
			'label.required' => "Le document est obligatoire.",
			'label.unique' => "Le document existe déjà dans la base de données.",
			'price.*' => "Le montant est obligatoire et doit être un entier.",
			'day.*' => "Le nombre de jours est obligatoire et doit être un entier.",
			'description.required' => "La description est obligatoire.",
		]);
		// Error field
		if ($validator->fails()) {
			Log::warning("Demand::store - Validator : {$validator->errors()->first()} - " . json_encode($request->all()));
			return response()->json([
				'status' => 0,
				'message' => $validator->errors()->first(),
			]);
		}
		$set = [
			'day' => $request->day,
			'price' => $request->price,
			'icone' => "far fa-address-card",
			'description' => $request->description,
			'label' => Str::upper(Myhelper::valideString($request->label)),
		];
		DB::beginTransaction();
		try {
			Demand::create($set);
			DB::commit();
			Myhelper::logs(
				Session::get('username'),
				Session::get('profil'),
				"Document consulaire: {$request->label}",
				'Ajouter',
				Session::get('avatar')
			);
			return response()->json([
				'status' => 1,
				'message' => "Document consulaire enregistré avec succès.",
			]);
		} catch (\Exception $e) {
			DB::rollBack();
			Log::warning("Demand::store - Erreur : {$e->getMessage()} " . json_encode($request->all()));
			return response()->json([
				'status' => 0,
				'message' => "Erreur lors de l'enregistrement.",
			]);
		}
	}
	// Afficher le formulaire d'édition d'une demande
	public function edit($uuid) {
        if (!Auth::check()) {
            return redirect('/');
        }
		// Title
		$title = 'Modification du document consulaire';
		// Menu
		$currentMenu = 'demands';
		// Vérifier si le document existe
		$query = Demand::where('uuid', $uuid)->first();
		if (!$query) {
			Log::warning("Demand::edit - Aucune document trouvé pour l'uUID : {$uuid}");
			return redirect('/demands');
		}
		// Modal
		$addmodal = '<a href="/demands" class="btn btn-sm fw-bold btn-danger">Retour</a>
		<a href="#" class="btn btn-sm fw-bold btn-success submitForm">Modifier</a>';
		return view('pages.demands.edit', compact('title', 'currentMenu', 'addmodal', 'query'));
	}
	// Mettre à jour une demande
	public function update(Request $request, $uuid) {
        if (!Auth::check()) {
            return 'x';
        }
		// Validator
		$validator = Validator::make($request->all(), [
			'label' => [
				'required',
				Rule::unique('demands')->where(function ($query) use ($uuid) {
					return $query->where('uuid', '!=', $uuid)->whereNull('deleted_at');
				}),
			],
			'price' => 'required|integer|min:1',
			'day' => 'required|integer|min:1',
			'description' => 'required',
		], [
			'label.required' => "Le document est obligatoire.",
			'label.unique' => "Le document existe déjà dans la base de données.",
			'price.*' => "Le montant est obligatoire et doit être un entier.",
			'day.*' => "Le nombre de jours est obligatoire et doit être un entier.",
			'description.required' => "La description est obligatoire.",
		]);
		// Error field
		if ($validator->fails()) {
			Log::warning("Demand::update - Validator : {$validator->errors()->first()} - " . json_encode($request->all()));
			return response()->json([
				'status' => 0,
				'message' => $validator->errors()->first(),
			]);
		}
		// Vérifier si le document existe
		$query = Demand::where('uuid', $uuid)->first();
		if (!$query) {
			Log::warning("Demand::update - Aucune document trouvé pour l'uUID : {$uuid}");
			return response()->json([
				'status' => 0,
				'message' => "Document consulaire non trouvé.",
			]);
		}
		$set = [
			'day' => $request->day,
			'price' => $request->price,
			'description' => $request->description,
			'label' => Str::upper(Myhelper::valideString($request->label)),
		];
		DB::beginTransaction(); // Démarrer une transaction
		try {
			// Mettre à jour le document
			$query->update($set);
			DB::commit(); // Valider la transaction
			Myhelper::logs(
				Session::get('username'),
				Session::get('profil'),
				"Document consulaire: {$request->label}",
				'Modifier',
				Session::get('avatar')
			);
			return response()->json([
				'status' => 1,
				'message' => "Document consulaire modifié avec succès.",
			]);
		} catch (\Exception $e) {
			DB::rollBack(); // Annuler la transaction en cas d'erreur
			Log::warning("Demand::update - Erreur : {$e->getMessage()} " . json_encode($request->all()));
			return response()->json([
				'status' => 0,
				'message' => "Erreur lors de la modification.",
			]);
		}
	}
	// Supprimer une demande
	public function destroy($uuid) {
        if (!Auth::check()) {
            return 'x';
        }
		try {
			// Vérifier si le document existe
			$document = Demand::where('uuid', $uuid)->first();
			if (!$document) {
				Log::warning("Demand::destroy - Aucune document trouvé pour l'uUID : {$uuid}");
				return response()->json([
					'status' => 0,
					'message' => "Document consulaire non trouvé.",
				]);
			}
			// Vérifier si des utilisateurs sont associés
			$documentCount = User::where('document_id', $document->id)->count();
			if ($documentCount > 0) {
				Log::warning("Demand::destroy - Cet document est associé à {$documentCount} utilisateur(s).");
				return response()->json([
					'status' => 0,
					'message' => "Cet document est associé à {$documentCount} utilisateur(s).",
				]);
			}
			DB::beginTransaction();
			// Supprimer le document
			$document->delete();
			DB::commit();
			Myhelper::logs(
				Session::get('username'),
				Session::get('profil'),
				"Document consulaire: {$document->label}",
				'Supprimer',
				Session::get('avatar')
			);
			return response()->json([
				'status' => 1,
				'message' => "Document consulaire supprimé avec succès.",
			]);
		} catch (\Exception $e) {
			DB::rollBack();
			Log::warning("Demand::destroy - Erreur : {$e->getMessage()} " . json_encode($request->all()));
			return response()->json([
				'status' => 0,
				'message' => "Erreur lors de la suppression.",
			]);
		}
	}
    //Rechercher les utilisateurs
	public function searchUsers(Request $request) {
		//Requete Read-
		$search = '%' . $request->search . '%';
		$query = User::select('id', 'firstname', 'lastname', 'gender', 'avatar', 'nationality_id')
		->with('nationality')
		->where(function ($q) use ($search) {
			$q->where('lastname', 'like', $search)
			->orWhere('firstname', 'like', $search);
		})
		->where('profile_id', '!=', 1)
		->orderBy('lastname')
		->orderBy('firstname')
		->get();

		$users = $query->map(fn($data) => [
			'id'       => $data->id,
			'username' => $data->firstname . ' ' . $data->lastname,
			'nationality' => optional($data->nationality)->nationality ?? '',
			'avatar'   => $data->avatar != ''
							? $data->avatar
							: ($data->gender == 'M' ? 'avatars/homme.jpg' : 'avatars/femme.jpg'),
		]);
		return response()->json([
			'status' => true,
			'data' => $users,
		]);
	}
}

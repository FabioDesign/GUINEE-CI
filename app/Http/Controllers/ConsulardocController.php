<?php

namespace App\Http\Controllers;

use Session;
use Myhelper;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Models\{Consulardoc, Document, User};
use Illuminate\Support\Facades\{Auth, DB, Log, Validator};

class ConsulardocController extends Controller
{
    //Liste des documents consulaires
	public function index()
	{
        if (!Auth::check()) {
            return redirect('/');
        }
		//Title
		$title = 'Gestion des documents consulaires';
		//Menu
		$currentMenu = 'consulardoc';
		//Modal
		$actionIds = Myhelper::actions(Auth::user()->profile_id, 3);
		$addmodal = in_array(2, $actionIds) ? '<a href="/consulardoc/create" class="btn btn-sm fw-bold btn-primary">Ajouter un document</a>':'';
		//Requete Read
		$query = Consulardoc::orderByDesc('created_at')->get();
		return view('pages.consulardoc.index', compact('title', 'currentMenu', 'addmodal', 'actionIds', 'query'));
	}
	// Afficher le détail d'un document
	public function show($uid)
	{
        if (!Auth::check()) {
            return redirect('/');
        }
		// Title
		$title = 'Détail du document consulaire';
		// Menu
		$currentMenu = 'consulardoc';
		// Vérifier si le document existe
		$query = Consulardoc::where('uid', $uid)->first();
		if (!$query) {
			Log::warning("Consulardoc::show - Aucun document trouvé pour l'UID : {$uid}");
			return redirect('/consulardoc');
		}
		// Modal
		$addmodal = '<a href="/consulardoc" class="btn btn-sm fw-bold btn-danger">Retour</a>';
		return view('pages.consulardoc.show', compact('title', 'currentMenu', 'addmodal', 'query'));
	}
    //Liste des documents
	public function create()
	{
        if (!Auth::check()) {
            return redirect('/');
        }
		//Title
		$title = "Ajout d'un document";
		//Menu
		$currentMenu = 'consulardoc';
		//Modal
		$addmodal = '<a href="/consulardoc" class="btn btn-sm fw-bold btn-danger">Retour</a>
		<a href="#" class="btn btn-sm fw-bold btn-success submitForm">Ajouter</a>';
		return view('pages.consulardoc.create', compact('title', 'currentMenu', 'addmodal'));
	}
	//Add document
	public function store(request $request)
	{
        if (!Auth::check()) {
            return 'x';
        }
		// Validator
		$validator = Validator::make($request->all(), [
			'libelle' => [
				'required',
				Rule::unique('consulardoc')->where(function ($query) {
					return $query->whereNull('deleted_at');
				}),
			],
			'amount' => 'required|integer|min:1',
			'day' => 'required|integer|min:1',
			'description' => 'required',
		], [
			'libelle.required' => "Le document est obligatoire.",
			'libelle.unique' => "Le document existe déjà dans la base de données.",
			'amount.*' => "Le montant est obligatoire et doit être un entier.",
			'day.*' => "Le nombre de jours est obligatoire et doit être un entier.",
			'description.required' => "La description est obligatoire.",
		]);
		// Error field
		if ($validator->fails()) {
			Log::warning("Consulardoc::store - Validator : {$validator->errors()->first()} - " . json_encode($request->all()));
			return response()->json([
				'status' => 0,
				'message' => $validator->errors()->first(),
			]);
		}
		$set = [
			'day' => $request->day,
			'amount' => $request->amount,
			'icone' => "far fa-address-card",
			'description' => $request->description,
			'libelle' => Str::upper(Myhelper::valideString($request->libelle)),
		];
		DB::beginTransaction();
		try {
			Consulardoc::create($set);
			DB::commit();
			Myhelper::logs(
				Session::get('username'),
				Session::get('profil'),
				"Document consulaire: {$request->libelle}",
				'Ajouter',
				Session::get('avatar')
			);
			return response()->json([
				'status' => 1,
				'message' => "Document consulaire enregistré avec succès.",
			]);
		} catch (\Exception $e) {
			DB::rollBack();
			Log::warning("Consulardoc::store - Erreur : {$e->getMessage()} " . json_encode($request->all()));
			return response()->json([
				'status' => 0,
				'message' => "Erreur lors de l'enregistrement.",
			]);
		}
	}
	// Afficher le formulaire d'édition d'un document
	public function edit($uid)
	{
        if (!Auth::check()) {
            return redirect('/');
        }
		// Title
		$title = 'Modification du document consulaire';
		// Menu
		$currentMenu = 'consulardoc';
		// Vérifier si le document existe
		$query = Consulardoc::where('uid', $uid)->first();
		if (!$query) {
			Log::warning("Consulardoc::edit - Aucune document trouvé pour l'UID : {$uid}");
			return redirect('/consulardoc');
		}
		// Modal
		$addmodal = '<a href="/consulardoc" class="btn btn-sm fw-bold btn-danger">Retour</a>
		<a href="#" class="btn btn-sm fw-bold btn-success submitForm">Modifier</a>';
		return view('pages.consulardoc.edit', compact('title', 'currentMenu', 'addmodal', 'query'));
	}
	// Mettre à jour un document
	public function update(Request $request, $uid)
	{
        if (!Auth::check()) {
            return 'x';
        }
		// Validator
		$validator = Validator::make($request->all(), [
			'libelle' => [
				'required',
				Rule::unique('consulardoc')->where(function ($query) use ($uid) {
					return $query->where('uid', '!=', $uid)->whereNull('deleted_at');
				}),
			],
			'amount' => 'required|integer|min:1',
			'day' => 'required|integer|min:1',
			'description' => 'required',
		], [
			'libelle.required' => "Le document est obligatoire.",
			'libelle.unique' => "Le document existe déjà dans la base de données.",
			'amount.*' => "Le montant est obligatoire et doit être un entier.",
			'day.*' => "Le nombre de jours est obligatoire et doit être un entier.",
			'description.required' => "La description est obligatoire.",
		]);
		// Error field
		if ($validator->fails()) {
			Log::warning("Consulardoc::update - Validator : {$validator->errors()->first()} - " . json_encode($request->all()));
			return response()->json([
				'status' => 0,
				'message' => $validator->errors()->first(),
			]);
		}
		// Vérifier si le document existe
		$query = Consulardoc::where('uid', $uid)->first();
		if (!$query) {
			Log::warning("Consulardoc::update - Aucune document trouvé pour l'UID : {$uid}");
			return response()->json([
				'status' => 0,
				'message' => "Document consulaire non trouvé.",
			]);
		}
		$set = [
			'day' => $request->day,
			'amount' => $request->amount,
			'description' => $request->description,
			'libelle' => Str::upper(Myhelper::valideString($request->libelle)),
		];
		DB::beginTransaction(); // Démarrer une transaction
		try {
			// Mettre à jour le document
			$query->update($set);
			DB::commit(); // Valider la transaction
			Myhelper::logs(
				Session::get('username'),
				Session::get('profil'),
				"Document consulaire: {$request->libelle}",
				'Modifier',
				Session::get('avatar')
			);
			return response()->json([
				'status' => 1,
				'message' => "Document consulaire modifié avec succès.",
			]);
		} catch (\Exception $e) {
			DB::rollBack(); // Annuler la transaction en cas d'erreur
			Log::warning("Consulardoc::update - Erreur : {$e->getMessage()} " . json_encode($request->all()));
			return response()->json([
				'status' => 0,
				'message' => "Erreur lors de la modification.",
			]);
		}
	}
	// Supprimer un document
	public function destroy($uid)
	{
        if (!Auth::check()) {
            return 'x';
        }
		try {
			// Vérifier si le document existe
			$document = Consulardoc::where('uid', $uid)->first();
			if (!$document) {
				Log::warning("Consulardoc::destroy - Aucune document trouvé pour l'UID : {$uid}");
				return response()->json([
					'status' => 0,
					'message' => "Document consulaire non trouvé.",
				]);
			}
			// Vérifier si des utilisateurs sont associés
			$documentCount = User::where('document_id', $document->id)->count();
			if ($documentCount > 0) {
				Log::warning("Consulardoc::destroy - Cet document est associé à {$documentCount} utilisateur(s).");
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
				"Document consulaire: {$document->libelle}",
				'Supprimer',
				Session::get('avatar')
			);
			return response()->json([
				'status' => 1,
				'message' => "Document consulaire supprimé avec succès.",
			]);
		} catch (\Exception $e) {
			DB::rollBack();
			Log::warning("Consulardoc::destroy - Erreur : {$e->getMessage()} " . json_encode($request->all()));
			return response()->json([
				'status' => 0,
				'message' => "Erreur lors de la suppression.",
			]);
		}
	}
}

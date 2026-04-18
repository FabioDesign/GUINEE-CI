<?php

namespace App\Http\Controllers;

use Session;
use Myhelper;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Models\{Attachment, File};
use Illuminate\Support\Facades\{Auth, DB, Log, Storage, Validator};

class FileController extends Controller
{
    //Liste des Pièces à fournir
	public function index()
	{
        if (!Auth::check()) {
            return redirect('/');
        }
		//Title
		$title = 'Gestion des Pièces à fournir';
		//Menu
		$currentMenu = 'files';
		//Modal
		$actionIds = Myhelper::actions(Auth::user()->profile_id, 4);
		$addmodal = in_array(2, $actionIds) ? '<a href="/files/create" class="btn btn-sm fw-bold btn-primary">Ajouter une pièce</a>':'';
		//Requete Read
		$query = File::orderByDesc('created_at')->get();
		return view('pages.files.index', compact('title', 'currentMenu', 'addmodal', 'actionIds', 'query'));
	}
    //Liste des Pièces à fournir
	public function create()
	{
        if (!Auth::check()) {
            return redirect('/');
        }
		//Title
		$title = "Ajout d'une pièce à fournir";
		//Menu
		$currentMenu = 'files';
		//Modal
		$addmodal = '<a href="/files" class="btn btn-sm fw-bold btn-danger">Retour</a>
		<a href="#" class="btn btn-sm fw-bold btn-success submitForm">Ajouter</a>';
		return view('pages.files.create', compact('title', 'currentMenu', 'addmodal'));
	}
	//Add Pièce à fournir
	public function store(request $request)
	{
        if (!Auth::check()) {
            return 'x';
        }
		// Validator
		$validator = Validator::make($request->all(), [
			'libelle' => [
				'required',
				Rule::unique('files')->where(function ($query) {
					return $query->whereNull('deleted_at');
				}),
			],
			'specimen' => 'required|file|mimes:png,jpg,jpeg|max:2048',
		], [
			'libelle.required' => "Le libellé est obligatoire.",
			'libelle.unique' => "Le libellé existe déjà dans la base de données.",
			'specimen.required' => "Le spécimen est obligatoire.",
			'specimen.file' => "Le spécimen doit être un fichier.",
			'specimen.mimes' => "Le spécimen doit être un fichier de type : png,jpg ou jpeg",
			'specimen.max' => "Le spécimen ne doit pas être supérieur à 2Mo.",
		]);
		// Error field
		if ($validator->fails()) {
			Log::warning("File::store - Validator : {$validator->errors()->first()} - " . json_encode($request->all()));
			return "0|" . $validator->errors()->first();
		}
		// Enregistrer le fichier
		$path = $request->file('specimen')->store('files', 'public');
		$set = [
			'specimen' => $path,
			'libelle' => $request->libelle,
		];
		DB::beginTransaction();
		try {
			File::create($set);
			DB::commit();
            Myhelper::logs(
                Session::get('username'), 
                Session::get('profil'), 
                "Pièce à fournir: {$request->libelle}",
				'Ajouter',
				Session::get('avatar')
			);
			return "1|Pièce à fournir enregistrée avec succès.";
		} catch (\Exception $e) {
			DB::rollBack();
			Log::warning("File::store : {$e->getMessage()} " . json_encode($request->all()));
			return "0|Erreur lors de l'enregistrement de la Pièce à fournir.";
		}
	}
	// Afficher le formulaire d'édition d'une pièce à fournir
	public function edit($uid)
	{
        if (!Auth::check()) {
            return redirect('/');
        }
		// Title
		$title = 'Modification de la Pièce à fournir';
		// Menu
		$currentMenu = 'files';
		// Vérifier si la pièce à fournir existe
		$query = File::where('uid', $uid)->first();
		if (!$query) {
			Log::warning("File::edit - Aucune pièce à fournir trouvée pour l'UID : {$uid}");
			return redirect('/files');
		}
		// Modal
		$addmodal = '<a href="/files" class="btn btn-sm fw-bold btn-danger">Retour</a>
		<a href="#" class="btn btn-sm fw-bold btn-success submitForm">Modifier</a>';
		return view('pages.files.edit', compact('title', 'currentMenu', 'addmodal', 'query'));
	}
	// Mettre à jour une pièce à fournir
	public function update(Request $request, $uid)
	{
        if (!Auth::check()) {
            return 'x';
        }
		// Validator
		$validator = Validator::make($request->all(), [
			'libelle' => [
				'required',
				Rule::unique('files')->where(function ($query) use ($uid) {
					return $query->where('uid', '!=', $uid)->whereNull('deleted_at');
				}),
			],
			'specimen' => 'required|file|mimes:png,jpg,jpeg|max:2048',
		], [
			'libelle.required' => "Le libellé est obligatoire.",
			'libelle.unique' => "Le libellé existe déjà dans la base de données.",
			'specimen.required' => "Le spécimen est obligatoire.",
			'specimen.file' => "Le spécimen doit être un fichier.",
			'specimen.mimes' => "Le spécimen doit être un fichier de type : png,jpg ou jpeg",
			'specimen.max' => "Le spécimen ne doit pas être supérieur à 2Mo.",
		]);
		// Error field
		if ($validator->fails()) {
			Log::warning("File::update - Validator : {$validator->errors()->first()} - " . json_encode($request->all()));
			return "0|" . $validator->errors()->first();
		}
		// Vérifier si le pièce à fournir existe
		$file = File::where('uid', $uid)->first();
		if (!$file) {
			Log::warning("File::update - Aucune pièce à fournir trouvée pour l'UID : {$uid}");
			return "0|Pièce à fournir non trouvée.";
		}
		// Enregistrer le fichier
		$path = $request->file('specimen')->store('files', 'public');
		$set = [
			'specimen' => $path,
			'libelle' => $request->libelle,
		];
		DB::beginTransaction(); // Démarrer une transaction
		try {
			// Mettre à jour la pièce à fournir
			$file->update($set);
			DB::commit(); // Valider la transaction
			Myhelper::logs(
				Session::get('username'),
				Session::get('profil'),
				"Pièce à fournir: {$request->libelle}",
				'Modifier',
				Session::get('avatar')
			);
			return "1|Pièce à fournir modifiée avec succès.";
		} catch (\Exception $e) {
			DB::rollBack(); // Annuler la transaction en cas d'erreur
			Log::warning("File::update : {$e->getMessage()} " . json_encode($request->all()));
			return "0|Erreur lors de la modification de la Pièce à fournir.";
		}
	}
	// Supprimer une pièce à fournir
	public function destroy($uid)
	{
        if (!Auth::check()) {
            return 'x';
        }
		try {
			// Vérifier si la pièce à fournir existe
			$file = File::where('uid', $uid)->first();
			if (!$file) {
				Log::warning("File::destroy - Aucune pièce à fournir trouvée pour l'UID : {$uid}");
				return "0|Pièce à fournir non trouvée.";
			}
			// Vérifier si des utilisateurs sont associés
			$fileCount = Attachment::where('file_id', $file->id)->count();
			if ($fileCount > 0) {
				Log::warning("File::destroy - Cette pièce à fournir est associée à {$fileCount} documents(s).");
				return "0|Cette pièce à fournir est associée à {$fileCount} documents(s).";
			}
			DB::beginTransaction();
			// Supprimer la pièce à fournir
			$file->delete();
			DB::commit();
			Myhelper::logs(
				Session::get('username'), 
				Session::get('profil'),
				"Pièce à fournir: " . $file->libelle,
				'Supprimer',
				Session::get('avatar')
			);
			return "1|Pièce à fournir supprimée avec succès.";
		} catch (\Exception $e) {
			DB::rollBack();
			Log::warning("File::destroy : {$e->getMessage()} " . json_encode($request->all()));
			return "0|Erreur lors de la suppression.";
		}
	}
}

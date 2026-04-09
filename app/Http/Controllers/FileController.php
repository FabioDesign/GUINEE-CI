<?php

namespace App\Http\Controllers;

use Session;
use Myhelper;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Models\{Attachment, File};
use Illuminate\Support\Facades\{DB, Log, Storage, Validator};

class FileController extends Controller
{
    //Liste des Pièces à fournir
	public function index()
	{
    	if (Session::has('idUsr')) {
			//Title
			$title = 'Gestion des Pièces à fournir';
			//Menu
			$currentMenu = 'files';
			//Modal
			$actionIds = Myhelper::actions(Session::get('idPro'), 4);
			$addmodal = in_array(2, $actionIds) ? '<a href="/files/create" class="btn btn-sm fw-bold btn-primary">Ajouter une pièce</a>':'';
			//Requete Read
			$query = File::orderByDesc('created_at')->get();
			return view('pages.files.index', compact('title', 'currentMenu', 'addmodal', 'actionIds', 'query'));
	    } else return redirect('/');
	}
    //Liste des Pièces à fournir
	public function create()
	{
    	if (Session::has('idUsr')) {
			//Title
			$title = "Ajout d'une pièce à fournir";
			//Menu
			$currentMenu = 'files';
			//Modal
			$addmodal = '<!--begin::Secondary button-->
			<a href="/files" class="btn btn-sm fw-bold btn-danger">Retour</a>
			<!--end::Secondary button-->
			<!--begin::Primary button-->
			<a href="#" class="btn btn-sm fw-bold btn-success submitForm">Ajouter</a>
			<!--end::Primary button-->';
			return view('pages.files.create', compact('title', 'currentMenu', 'addmodal'));
	    } else return redirect('/');
	}
	//Add Pièce à fournir
	public function store(request $request)
	{
		if (Session::has('idUsr')) {
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
				'icone' => "far fa-address-card",
				'created_id' => Session::get('idUsr'),
			];
			DB::beginTransaction();
			try {
				File::create($set);
				DB::commit();
				Myhelper::logs(Session::get('username'), Session::get('profil'), "Pièce à fournir: {$request->libelle}", 'Ajouter', 'success', Session::get('avatar'));
				return "1|Pièce à fournir enregistrée avec succès.";
			} catch (\Exception $e) {
				DB::rollBack();
				Log::warning("File::store : {$e->getMessage()} " . json_encode($request->all()));
				return "0|Erreur lors de l'enregistrement de la Pièce à fournir.";
			}
		} else return 'x';
	}
	// Afficher le formulaire d'édition d'une pièce à fournir
	public function edit($uid)
	{
		if (Session::has('idUsr')) {
			// Title
			$title = 'Modification de la Pièce à fournir';
			// Menu
			$currentMenu = 'files';
            // Vérifier si la pièce à fournir existe
            $files = File::where('uid', $uid)->first();
            if (!$files) {
                Log::warning("File::edit - Aucune pièce à fournir trouvée pour l'UID : {$uid}");
                return redirect('/files');
            }
			// Modal
			$addmodal = '<!--begin::Secondary button-->
			<a href="/files" class="btn btn-sm fw-bold btn-danger">Retour</a>
			<!--end::Secondary button-->
			<!--begin::Primary button-->
			<a href="#" class="btn btn-sm fw-bold btn-success submitForm">Modifier</a>
			<!--end::Primary button-->';
			return view('pages.files.edit', compact('title', 'currentMenu', 'addmodal', 'files'));
		} else return redirect('/');
	}
	// Mettre à jour une pièce à fournir
	public function update(Request $request, $uid)
	{
		if (Session::has('idUsr')) {
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
            $files = File::where('uid', $uid)->first();
            if (!$files) {
                Log::warning("File::update - Aucune pièce à fournir trouvée pour l'UID : {$uid}");
				return "0|Pièce à fournir non trouvée.";
			}
			// Enregistrer le fichier
            $path = $request->file('specimen')->store('files', 'public');
			$set = [
				'specimen' => $path,
				'libelle' => $request->libelle,
				'updated_id' => Session::get('idUsr'),
			];
			DB::beginTransaction(); // Démarrer une transaction
			try {
				// Mettre à jour la pièce à fournir
				$files->update($set);
				DB::commit(); // Valider la transaction
				Myhelper::logs(Session::get('username'), Session::get('profil'), "Pièce à fournir: {$request->libelle}", 'Modifier', 'success', Session::get('avatar'));
				return "1|Pièce à fournir modifiée avec succès.";
			} catch (\Exception $e) {
				DB::rollBack(); // Annuler la transaction en cas d'erreur
				Log::warning("File::update : {$e->getMessage()} " . json_encode($request->all()));
				return "0|Erreur lors de la modification de la Pièce à fournir.";
			}
		} else return 'x';
	}
	// Changer le statut d'une pièce à fournir (activer/désactiver)
	public function status($uid)
	{
		if (Session::has('idUsr')) {
			try {
				// Vérifier si la pièce à fournir existe
				$files = File::where('uid', $uid)->first();
				if (!$files) {
					Log::warning("File::status - Aucue pièce à fournir trouvée pour l'UID : {$uid}");
					return "0|Pièce à fournir non trouvée.";
				}
				$newStatus = $files->status == 1 ? 0 : 1;
				$action = $newStatus == 1 ? 'Activée' : 'Désactivée';
				// Mettre à jour le statut du pièce à fournir
				$files->update([
					'status' => $newStatus,
					'updated_id' => Session::get('idUsr')
				]);
				Myhelper::logs(Session::get('username'), Session::get('profil'), "Pièce à fournir: " . $files->libelle, $action, 'success', Session::get('avatar'));
				return "1|Pièce à fournir " . Str::lower($action) . " avec succès.";
			} catch (\Exception $e) {
				Log::error("File::status : {$e->getMessage()}");
				return "0|Erreur lors du changement de statut.";
			}
		} else return 'x';
	}
	// Supprimer une pièce à fournir
	public function destroy($uid)
	{
		if (Session::has('idUsr')) {
			try {
				// Vérifier si la pièce à fournir existe
				$files = File::where('uid', $uid)->first();
				if (!$files) {
					Log::warning("File::destroy - Aucune pièce à fournir trouvée pour l'UID : {$uid}");
					return "0|Pièce à fournir non trouvée.";
				}
				// Vérifier si des utilisateurs sont associés
				$fileCount = Attachment::where('file_id', $files->id)->count();
				if ($fileCount > 0) {
					Log::warning("File::destroy - Cette pièce à fournir est associée à {$fileCount} documents(s).");
					return "0|Cette pièce à fournir est associée à {$fileCount} documents(s).";
				}
				DB::beginTransaction();
				// Supprimer la pièce à fournir
				$files->delete();
            	$files->update(['deleted_id' => Session::get('idUsr')]);
				DB::commit();
				Myhelper::logs(Session::get('username'), Session::get('profil'), "Pièce à fournir: " . $files->libelle, 'Supprimer', 'success', Session::get('avatar'));
				return "1|Pièce à fournir supprimée avec succès.";
			} catch (\Exception $e) {
				DB::rollBack();
				Log::warning("File::destroy : {$e->getMessage()} " . json_encode($request->all()));
				return "0|Erreur lors de la suppression.";
			}
		} else return 'x';
	}
}

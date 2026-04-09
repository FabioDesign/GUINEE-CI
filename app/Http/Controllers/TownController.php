<?php

namespace App\Http\Controllers;

use Session;
use Myhelper;
use App\Models\Town;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\{DB, Log, Storage, Validator};

class TownController extends Controller
{
    //Liste des Villes
	public function index()
	{
        if (!Session::has('idUsr')) {
            return redirect('/');
        }
		//Title
		$title = 'Gestion des Villes';
		//Menu
		$currentMenu = 'towns';
		//Modal
		$actionIds = Myhelper::actions(Session::get('idPro'), 5);
		$addmodal = in_array(2, $actionIds) ? '<a href="/towns/create" class="btn btn-sm fw-bold btn-primary">Ajouter une ville</a>':'';
		//Requete Read
		$query = Town::select('towns.uid', 'towns.libelle as town', 'towns.status', 'towns.created_at', 'alpha', 'country.libelle AS country')
		->join('country', 'country.id','=','towns.country_id')
        ->orderByDesc('created_at')->get();
		return view('pages.towns.index', compact('title', 'currentMenu', 'addmodal', 'actionIds', 'query'));
	}
    //Liste des villes
	public function create()
	{
    	if (Session::has('idUsr')) {
			//Title
			$title = "Ajout d'une ville";
			//Menu
			$currentMenu = 'towns';
			//Modal
			$addmodal = '<!--begin::Secondary button-->
			<a href="/towns" class="btn btn-sm fw-bold btn-danger">Retour</a>
			<!--end::Secondary button-->
			<!--begin::Primary button-->
			<a href="#" class="btn btn-sm fw-bold btn-success submitForm">Ajouter</a>
			<!--end::Primary button-->';
			return view('pages.towns.create', compact('title', 'currentMenu', 'addmodal'));
	    } else return redirect('/');
	}
	//Add ville
	public function store(request $request)
	{
		if (Session::has('idUsr')) {
			// Validator
			$validator = Validator::make($request->all(), [
				'libelle' => [
					'required',
					Rule::unique('towns')->where(function ($query) {
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
				Log::warning("Town::store - Validator : {$validator->errors()->first()} - " . json_encode($request->all()));
				return "0|" . $validator->errors()->first();
			}
			// Enregistrer le fichier
            $path = $request->file('specimen')->store('towns', 'public');
			$set = [
				'specimen' => $path,
				'libelle' => $request->libelle,
				'icone' => "far fa-address-card",
				'created_by' => Session::get('idUsr'),
			];
			DB::beginTransaction();
			try {
				Town::create($set);
				DB::commit();
				Myhelper::logs(Session::get('username'), Session::get('profil'), "ville: {$request->libelle}", 'Ajouter', 'success', Session::get('avatar'));
				return "1|ville enregistrée avec succès.";
			} catch (\Exception $e) {
				DB::rollBack();
				Log::warning("Town::store : {$e->getMessage()} " . json_encode($request->all()));
				return "0|Erreur lors de l'enregistrement de la ville.";
			}
		} else return 'x';
	}
	// Afficher le formulaire d'édition d'une ville
	public function edit($uid)
	{
		if (Session::has('idUsr')) {
			// Title
			$title = 'Modification de la ville';
			// Menu
			$currentMenu = 'towns';
            // Vérifier si la ville existe
            $towns = Town::where('uid', $uid)->first();
            if (!$towns) {
                Log::warning("Town::edit - Aucune ville trouvée pour l'UID : {$uid}");
                return redirect('/towns');
            }
			// Modal
			$addmodal = '<!--begin::Secondary button-->
			<a href="/towns" class="btn btn-sm fw-bold btn-danger">Retour</a>
			<!--end::Secondary button-->
			<!--begin::Primary button-->
			<a href="#" class="btn btn-sm fw-bold btn-success submitForm">Modifier</a>
			<!--end::Primary button-->';
			return view('pages.towns.edit', compact('title', 'currentMenu', 'addmodal', 'towns'));
		} else return redirect('/');
	}
	// Mettre à jour une ville
	public function update(Request $request, $uid)
	{
		if (Session::has('idUsr')) {
			// Validator
			$validator = Validator::make($request->all(), [
				'libelle' => [
					'required',
					Rule::unique('towns')->where(function ($query) use ($uid) {
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
				Log::warning("Town::update - Validator : {$validator->errors()->first()} - " . json_encode($request->all()));
				return "0|" . $validator->errors()->first();
			}
            // Vérifier si le ville existe
            $towns = Town::where('uid', $uid)->first();
            if (!$towns) {
                Log::warning("Town::update - Aucune ville trouvée pour l'UID : {$uid}");
				return "0|ville non trouvée.";
			}
			// Enregistrer le fichier
            $path = $request->file('specimen')->store('towns', 'public');
			$set = [
				'specimen' => $path,
				'libelle' => $request->libelle,
				'updated_by' => Session::get('idUsr'),
			];
			DB::beginTransaction(); // Démarrer une transaction
			try {
				// Mettre à jour la ville
				$towns->update($set);
				DB::commit(); // Valider la transaction
				Myhelper::logs(Session::get('username'), Session::get('profil'), "ville: {$request->libelle}", 'Modifier', 'success', Session::get('avatar'));
				return "1|ville modifiée avec succès.";
			} catch (\Exception $e) {
				DB::rollBack(); // Annuler la transaction en cas d'erreur
				Log::warning("Town::update : {$e->getMessage()} " . json_encode($request->all()));
				return "0|Erreur lors de la modification de la ville.";
			}
		} else return 'x';
	}
	// Changer le statut d'une ville (activer/désactiver)
	public function status($uid)
	{
		if (Session::has('idUsr')) {
			try {
				// Vérifier si la ville existe
				$towns = Town::where('uid', $uid)->first();
				if (!$towns) {
					Log::warning("Town::status - Aucue ville trouvée pour l'UID : {$uid}");
					return "0|ville non trouvée.";
				}
				$newStatus = $towns->status == 1 ? 0 : 1;
				$action = $newStatus == 1 ? 'Activée' : 'Désactivée';
				// Mettre à jour le statut du ville
				$towns->update([
					'status' => $newStatus,
					'updated_by' => Session::get('idUsr')
				]);
				Myhelper::logs(Session::get('username'), Session::get('profil'), "ville: " . $towns->libelle, $action, 'success', Session::get('avatar'));
				return "1|ville " . Str::lower($action) . " avec succès.";
			} catch (\Exception $e) {
				Log::error("Town::status : {$e->getMessage()}");
				return "0|Erreur lors du changement de statut.";
			}
		} else return 'x';
	}
	// Supprimer une ville
	public function destroy($uid)
	{
		if (Session::has('idUsr')) {
			try {
				// Vérifier si la ville existe
				$towns = Town::where('uid', $uid)->first();
				if (!$towns) {
					Log::warning("Town::destroy - Aucune ville trouvée pour l'UID : {$uid}");
					return "0|ville non trouvée.";
				}
				// Vérifier si des utilisateurs sont associés
				$fileCount = Attachment::where('file_id', $towns->id)->count();
				if ($fileCount > 0) {
					Log::warning("Town::destroy - Cette ville est associée à {$fileCount} documents(s).");
					return "0|Cette ville est associée à {$fileCount} documents(s).";
				}
				DB::beginTransaction();
				// Supprimer la ville
				$towns->delete();
            	$towns->update(['deleted_by' => Session::get('idUsr')]);
				DB::commit();
				Myhelper::logs(Session::get('username'), Session::get('profil'), "ville: " . $towns->libelle, 'Supprimer', 'success', Session::get('avatar'));
				return "1|ville supprimée avec succès.";
			} catch (\Exception $e) {
				DB::rollBack();
				Log::warning("Town::destroy : {$e->getMessage()} " . json_encode($request->all()));
				return "0|Erreur lors de la suppression.";
			}
		} else return 'x';
	}
}

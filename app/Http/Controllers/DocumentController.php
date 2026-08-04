<?php

namespace App\Http\Controllers;

use Session;
use Myhelper;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\{Auth, DB, Log, Validator};
use App\Models\{AnnualStat, DocFile, Document, File, User};

class DocumentController extends Controller
{
    // Liste des documents
	public function index() {
        if (!Auth::check()) {
            return redirect('/');
        }
		// Title
		$title = 'Gestion des documents';
		// Menu
		$currentMenu = 'documents';
		// Modal
		$actionIds = Myhelper::actions(Auth::user()->profile_id, 3);
		$addmodal = in_array(2, $actionIds) ? '<a href="/documents/create" class="btn btn-sm fw-bold btn-primary">Ajouter un document</a>':'';
		// Requete Read
		$query = Document::orderByDesc('created_at')->get();
		Myhelper::auditTrail(
			Auth::user()->consulat_id,
			Auth::user()->profile_id,
			Session::get('username'),
			Session::get('profil'),
			"Document: Liste",
			'Consulter',
			Session::get('avatar')
		);
		return view('pages.documents.index', compact('title', 'currentMenu', 'addmodal', 'actionIds', 'query'));
	}
	// Afficher le détail d'un document
	public function show($uuid) {
        if (!Auth::check()) {
            return redirect('/');
        }
		// Title
		$title = 'Détail du document';
		// Menu
		$currentMenu = 'documents';
		// Vérifier si le document existe
		$query = Document::where('uuid', $uuid)->first();
		if (!$query) {
			Log::warning("Document::show - Aucun document trouvé pour l'uUID : {$uuid}");
			return redirect('/documents');
		}
		// Modal
		$addmodal = '<a href="/documents" class="btn btn-sm fw-bold btn-danger">Retour</a>';
		// Requete Read
		$docFiles = DocFile::where('document_id', $query->id)->get();
		return view('pages.documents.show', compact('title', 'currentMenu', 'addmodal', 'query', 'docFiles'));
	}
    // Liste des documents
	public function create() {
        if (!Auth::check()) {
            return redirect('/');
        }
		// Title
		$title = "Ajout d'un document";
		// Menu
		$currentMenu = 'documents';
		// Modal
		$addmodal = '<a href="/documents" class="btn btn-sm fw-bold btn-danger">Retour</a>
		<a href="#" class="btn btn-sm fw-bold btn-success submitForm">Ajouter</a>';
		// Requete Read
		$query = File::orderBy('label')->get();
		return view('pages.documents.create', compact('title', 'currentMenu', 'addmodal', 'query'));
	}
	// Add document
	public function store(request $request) {
		// dd($request->all());
        if (!Auth::check()) {
            return 'x';
        }
		// Validator
		$validator = Validator::make($request->all(), [
			'label' => [
				'required',
				Rule::unique('documents')->where(function ($query) {
					return $query->whereNull('deleted_at');
				}),
			],
			'file_id' => 'required|array',
			'code' => 'required|string|max:5',
			'price' => 'required|integer|min:1',
			'number' => 'required|integer|min:1',
			'description' => 'required',
		], [
			'label.required' => "Le document est obligatoire.",
			'label.unique' => "Le document existe déjà dans la base de données.",
			'file_id.required' => "Les pièces jointes sont obligatoires.",
			'file_id.array' => "Les pièces jointes doivent être un tableau.",
			'code.*' => "Le code est obligatoire et doit être une chaîne de caractères de 5 caractères.",
			'price.*' => "Le montant est obligatoire et doit être un entier.",
			'number.*' => "Le nombre de jours est obligatoire et doit être un entier.",
			'description.required' => "La description est obligatoire.",
		]);
		// Error field
		if ($validator->fails()) {
			Log::warning("Document::store - Validator : {$validator->errors()->first()} - " . json_encode($request->all()));
			return response()->json([
				'status' => 0,
				'message' => $validator->errors()->first(),
			]);
		}
		// Enregistrer le document
		$label = Str::upper(Myhelper::valideString($request->label));
		$set = [
			'label' => $label,
			'price' => $request->price,
			'number' => $request->number,
			'icone' => "far fa-address-card",
			'code' => str::upper($request->code),
			'description' => $request->description,
		];
		DB::beginTransaction();
		try {
			$document = Document::create($set);
			foreach ($request->file_id as $file_id) {
				DocFile::firstOrCreate([
					'file_id' => $file_id,
					'document_id' => $document->id,
				]);
			}
			DB::commit();
			Myhelper::auditTrail(
				Auth::user()->consulat_id,
				Auth::user()->profile_id,
				Session::get('username'),
				Session::get('profil'),
				"Document: {$label}",
				'Ajouter',
				Session::get('avatar')
			);
			return response()->json([
				'status' => 1,
				'message' => "Document enregistré avec succès.",
			]);
		} catch (\Exception $e) {
			DB::rollBack();
			Log::warning("Document::store - Erreur : {$e->getMessage()} " . json_encode($request->all()));
			return response()->json([
				'status' => 0,
				'message' => "Erreur lors de l'enregistrement.",
			]);
		}
	}
	// Afficher le formulaire d'édition d'un document
	public function edit($uuid) {
        if (!Auth::check()) {
            return redirect('/');
        }
		// Title
		$title = 'Modification du document';
		// Menu
		$currentMenu = 'documents';
		// Vérifier si le document existe
		$query = Document::where('uuid', $uuid)->first();
		if (!$query) {
			Log::warning("Document::edit - Aucune document trouvé pour l'uUID : {$uuid}");
			return redirect('/documents');
		}
		// Modal
		$addmodal = '<a href="/documents" class="btn btn-sm fw-bold btn-danger">Retour</a>
		<a href="#" class="btn btn-sm fw-bold btn-success submitForm">Modifier</a>';
		// Requete Read
		$files = File::orderBy('label')->get();
		// Requete Read
		$docFiles = DocFile::where('document_id', $query->id)->get();
		return view('pages.documents.edit', compact('title', 'currentMenu', 'addmodal', 'query', 'files', 'docFiles'));
	}
	// Mettre à jour un document
	public function update(Request $request, $uuid) {
        if (!Auth::check()) {
            return 'x';
        }
		// Validator
		$validator = Validator::make($request->all(), [
			'label' => [
				'required',
				Rule::unique('documents')->where(function ($query) use ($uuid) {
					return $query->where('uuid', '!=', $uuid)->whereNull('deleted_at');
				}),
			],
			'file_id' => 'required|array',
			'code' => 'required|string|max:5',
			'price' => 'required|integer|min:1',
			'number' => 'required|integer|min:1',
			'description' => 'required',
		], [
			'label.required' => "Le document est obligatoire.",
			'label.unique' => "Le document existe déjà dans la base de données.",
			'file_id.required' => "Les pièces jointes sont obligatoires.",
			'file_id.array' => "Les pièces jointes doivent être un tableau.",
			'code.*' => "Le code est obligatoire et doit être une chaîne de caractères de 5 caractères.",
			'price.*' => "Le montant est obligatoire et doit être un entier.",
			'number.*' => "Le nombre de jours est obligatoire et doit être un entier.",
			'description.required' => "La description est obligatoire.",
		]);
		// Error field
		if ($validator->fails()) {
			Log::warning("Document::update - Validator : {$validator->errors()->first()} - " . json_encode($request->all()));
			return response()->json([
				'status' => 0,
				'message' => $validator->errors()->first(),
			]);
		}
		// Vérifier si le document existe
		$query = Document::where('uuid', $uuid)->first();
		if (!$query) {
			Log::warning("Document::update - Aucune document trouvé pour l'uUID : {$uuid}");
			return response()->json([
				'status' => 0,
				'message' => "Document non trouvé.",
			]);
		}
		$set = [
			'number' => $request->number,
			'price' => $request->price,
			'code' => str::upper($request->code),
			'description' => $request->description,
			'label' => Str::upper(Myhelper::valideString($request->label)),
		];
		DB::beginTransaction(); // Démarrer une transaction
		try {
			// Mettre à jour le document
			$query->update($set);
			// Supprimer les anciennes pièces jointes
			DocFile::where('document_id', $query->id)->delete();
			// Ajouter les nouvelles pièces jointes
			foreach ($request->file_id as $file_id) {
				DocFile::create([
					'file_id' => $file_id,
					'document_id' => $query->id,
				]);
			}
			DB::commit(); // Valider la transaction
			Myhelper::auditTrail(
				Auth::user()->consulat_id,
				Auth::user()->profile_id,
				Session::get('username'),
				Session::get('profil'),
				"Document: {$request->label}",
				'Modifier',
				Session::get('avatar')
			);
			return response()->json([
				'status' => 1,
				'message' => "Document modifié avec succès.",
			]);
		} catch (\Exception $e) {
			DB::rollBack(); // Annuler la transaction en cas d'erreur
			Log::warning("Document::update - Erreur : {$e->getMessage()} " . json_encode($request->all()));
			return response()->json([
				'status' => 0,
				'message' => "Erreur lors de la modification.",
			]);
		}
	}
	// Supprimer un document
	public function destroy($uuid) {
        if (!Auth::check()) {
            return 'x';
        }
		try {
			// Vérifier si le document existe
			$document = Document::where('uuid', $uuid)->first();
			if (!$document) {
				Log::warning("Document::destroy - Aucune document trouvé pour l'uUID : {$uuid}");
				return response()->json([
					'status' => 0,
					'message' => "Document non trouvé.",
				]);
			}
			// Vérifier si des utilisateurs sont associés
			$documentCount = User::where('document_id', $document->id)->count();
			if ($documentCount > 0) {
				Log::warning("Document::destroy - Cet document est associé à {$documentCount} utilisateur(s).");
				return response()->json([
					'status' => 0,
					'message' => "Cet document est associé à {$documentCount} utilisateur(s).",
				]);
			}
			DB::beginTransaction();
			// Supprimer le document
			$document->delete();
			DB::commit();
			Myhelper::auditTrail(
				Auth::user()->consulat_id,
				Auth::user()->profile_id,
				Session::get('username'),
				Session::get('profil'),
				"Document: {$document->label}",
				'Supprimer',
				Session::get('avatar')
			);
			return response()->json([
				'status' => 1,
				'message' => "Document supprimé avec succès.",
			]);
		} catch (\Exception $e) {
			DB::rollBack();
			Log::warning("Document::destroy - Erreur : {$e->getMessage()} " . json_encode($request->all()));
			return response()->json([
				'status' => 0,
				'message' => "Erreur lors de la suppression.",
			]);
		}
	}
	// Récupérer un document
	public function getDocs($id) {
        if (!Auth::check()) {
            return 'x';
        }
		// Requete Read
		$data['docs'] = Document::select('id', 'label', 'code', 'number', 'price', 'description')
		->where('id', $id)
		->first();
		$files = DocFile::where('document_id', $id)->get();
		// Transformer les données
		$data['files'] = $files->map(fn($data) => [
			'id' => $data->files->id,
			'label' => $data->files->label,
			'path' => $data->files->path,
		]);
		return response()->json([
			'status' => 1,
			'data' => $data,
		]);
	}
	// Liste des documents
	public function listDocs(Request $request) {
		if (!Auth::check()) {
			return 'x';
		}
		$query = DB::select('CALL sp_chart_docs_data(?, ?)',[
			Session::get('consulat'),
			$request->docyears,
		]);
		$dataDoc = $dataNum = [];
		foreach ($query as $data) :
			$dataDoc[] = $data->label;
			$dataNum[] = $data->total;
		endforeach;
		return response()->json([
			'status' => 1,
			'data' => [
				'dataDoc' => $dataDoc,
				'dataNum' => $dataNum,
			],
		]);
	}
}

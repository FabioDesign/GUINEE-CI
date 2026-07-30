<?php

namespace App\Http\Controllers;

use Session;
use Myhelper;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\{Auth, DB, Log, Validator};
use App\Models\{Consulat, Attachment, Country, Demand, DocFile, Document, File, Profile, Town, User};

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
		$actionIds = Myhelper::actions(Auth::user()->profile_id, 2);
		$transmis = (($query->status == 0) && (in_array(6, $actionIds))) ? '<a href="#" data-url="/demands/status/' . $uuid . '" data-type="PATCH" data-bs-toggle="tooltip" data-bs-placement="top" title="Transmettre la demande" class="btn btn-sm fw-bold btn-success status">Transmettre</a>' : '';
		$valid = (($query->status == 1) && (in_array(7, $actionIds))) ? '<a href="#" data-url="/demands/status/' . $uuid . '" data-type="PATCH" data-bs-toggle="tooltip" data-bs-placement="top" title="Valider la demande" class="btn btn-sm fw-bold btn-success status">Valider</a>' : '';
		$rejet = (($query->status == 1) && (in_array(8, $actionIds))) ? '<a href="#" data-type="PATCH" data-bs-toggle="tooltip" data-bs-placement="top" title="Rejeter la demande" class="btn btn-sm fw-bold btn-danger btn-rjt">Rejeter</a>' : '';
		// Modal
		$addmodal = '<a href="/demands" class="btn btn-sm fw-bold btn-primary">Retour</a>' . $transmis . $valid . $rejet;
		$prefecture = Town::find(optional($query->user)->town_id);
		$country = Country::find($prefecture->country_id);
		$dmdFiles = Attachment::where('demand_id', $query->id)->get();
		return view('pages.demands.show', compact('title', 'currentMenu', 'addmodal', 'query', 'country', 'prefecture', 'dmdFiles'));
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
		$addmodal = '<a href="/demands" class="btn btn-sm fw-bold btn-danger">Retour</a>';
        $civility = ['M.', 'Mme', 'Mlle'];
		$nationality = Country::orderBy('nationality')->get();
		$town = Town::where('country_id', 61)->orderBy('label')->get();
		$country = Country::orderBy('country')->get();
		$documents = Document::orderBy('label')->get();
		$firstDoc = $documents->first();
		$docFiles = DocFile::where('document_id', $firstDoc->id)->get();
		return view('pages.demands.create', compact('title', 'currentMenu', 'addmodal', 'civility', 'town', 'country', 'nationality', 'documents', 'docFiles', 'firstDoc'));
	}
    // Account creation
    public function store(Request $request) {
        if (!Auth::check()) {
            return 'x';
        }
		// Validator
		$validator = Validator::make($request->all(), [
			'civility' => 'required|in:M.,Mme,Mlle',
			'lastname' => 'required',
			'firstname' => 'required',
			'phone_number' => [
				'required',
				'numeric',
                'digits_between:8,15',
			],
			'email' => [
				'nullable',
				'email',
			],
			'profession' => 'required',
			'nationality_id' => 'required|exists:countries,id',
            'town_id' => 'required|exists:towns,id',
            'birthday_at' => 'required|date|date_format:Y-m-d',
            'birthplace' => 'required',
            'father_fullname' => 'required',
            'mother_fullname' => 'required',
            'size' => 'required',
            'complexion' => 'required',
            'hairs' => 'required',
            'particular_sign' => 'required',
            'home_address' => 'required',
            'person_fullname' => 'required',
            'person_number' => 'required',
            'person_address' => 'required',
            'arrival_at' => 'required|date|date_format:Y-m-d',
			'document_id' => 'required|exists:documents,id',
			'number' => 'required|integer|min:1',
			'total' => 'required|integer',
			'copy' => 'required|integer|min:1',
			'filename' => 'required|array',
		], [
			'civility.required' => "La civilité est obligatoire.",
			'civility.in' => "La civilité est incorrecte.",
			'lastname.required' => "Le nom est obligatoire.",
			'firstname.required' => "Les prénoms sont obligatoires.",
			'phone_number.required' => "Le numéro de téléphone est obligatoire.",
            'phone_number.regex' => "Le numéro de téléphone doit contenir 10 chiffres.",
			'phone_number.unique' => "Le numéro de téléphone existe déjà dans la base de données.",
            'email.email' => "Adresse e-mail non valide.",
			'email.unique' => "Adresse e-mail existe déjà dans la base de données.",
			'profession.required' => "La profession est obligatoire.",
			'nationality_id.required' => "La nationalité est obligatoire.",
			'nationality_id.exists' => "La nationalité n'existe pas dans la base de données.",
			'birthday_at.required' => "La date de naissance est obligatoire.",
			'birthday_at.date_format' => "Le format de la date de naissance est incorrecte.",
			'town_id.required' => "La prefecture est obligatoire.",
			'town_id.exists' => "La prefecture n'existe pas dans la base de données.",
			'birthplace.required' => "Le lieu de naissance est obligatoire.",
			'father_fullname.required' => "Le nom et prénoms du père est obligatoire.",
			'mother_fullname.required' => "Le nom et prénoms de la mère est obligatoire.",
			'size.required' => "La taille est obligatoire.",
			'complexion.required' => "Le teint est obligatoire.",
			'hairs.required' => "Les cheveux sont obligatoires.",
			'particular_sign.required' => "Les Signes particuliers sont obligatoires.",
			'home_address.required' => "L'adresse domiciliale est obligatoire.",
			'arrival_at.required' => "La date d'arrivée est obligatoire.",
			'arrival_at.date_format' => "Le format de la date d'arrivée est incorrecte.",
			'document_id.required' => "Le document est obligatoire.",
			'document_id.exists' => "Le document n'existe pas dans la base de données.",
			'number.required' => "Le numéro est obligatoire.",
			'number.integer' => "Le numéro doit être un nombre entier.",
			'number.min' => "Le numéro doit être supérieur à 0.",
			'total.required' => "Le prix est obligatoire.",
			'total.integer' => "Le prix doit être un nombre entier.",
			'copy.required' => "Le nombre de copies est obligatoire.",
			'copy.integer' => "Le nombre de copies doit être un nombre entier.",
			'copy.min' => "Le nombre de copies doit être supérieur à 0.",
			'filename.required' => "Les fichiers sont obligatoires.",
			'filename.array' => "Les fichiers doivent être un tableau.",
		]);
		// Error field
		if ($validator->fails()) {
			Log::warning("Demand::store - Validator : {$validator->errors()->first()} - " . json_encode($request->all()));
			return response()->json([
				'status' => 0,
				'message' => $validator->errors()->first(),
			]);
		}
        // Gendre
        $gender = match($request->civility) {
            'Mme', 'Mlle' => 'F',
            default => 'M',
        };
        // Formatage du nom et prénoms
		$lastname = Str::upper(Myhelper::valideString($request->lastname, 'UTF-8'));
		$firstname = Str::upper(Myhelper::valideString($request->firstname, 'UTF-8'));
		$set = [
			'civility' => $request->civility,
			'lastname' => $lastname,
			'firstname' => $firstname,
            'gender' => $gender,
            'phone_code' => $request->phone_code,
            'phone_number' => $request->phone_number,
            'email' => Str::lower($request->email) ?? '',
            'profession' => Str::upper(Myhelper::valideString($request->profession),'UTF-8'),
            'nationality_id' => $request->nationality_id,
            'birthday_at' => $request->birthday_at,
            'town_id' => $request->town_id,
            'birthplace' => Str::upper(Myhelper::valideString($request->birthplace),'UTF-8'),
            'father_fullname' => Str::upper(Myhelper::valideString($request->father_fullname),'UTF-8'),
            'mother_fullname' => Str::upper(Myhelper::valideString($request->mother_fullname),'UTF-8'),
            'size' => Str::upper(Myhelper::valideString($request->size),'UTF-8'),
            'complexion' => Str::upper(Myhelper::valideString($request->complexion),'UTF-8'	),
            'hairs' => Str::upper(Myhelper::valideString($request->hairs),'UTF-8'),
            'particular_sign' => Str::upper(Myhelper::valideString($request->particular_sign),'UTF-8'),
            'home_address' => Str::upper(Myhelper::valideString($request->home_address),'UTF-8'),
            'person_fullname' => Str::upper(Myhelper::valideString($request->person_fullname),'UTF-8'),
            'person_code' => $request->person_code,
            'person_number' => $request->person_number,
            'person_address' => Str::upper(Myhelper::valideString($request->person_address),'UTF-8'),
            'arrival_at' => $request->arrival_at,
        ];
        DB::beginTransaction(); // Démarrer une transaction
        try {
            // Création de l'utilisateur
            if ($request->user_id) {
				$user = User::findOrFail($request->user_id)->update($set);
            } else {
				$user = User::create($set);
            }
            // Création de la demande
			$reference = Demand::reference($request->codeDoc, $user->birthday_at);
            $set = [
				'reference' => $reference,
                'document_id' => $request->document_id,
                'number' => $request->number,
                'price' => $request->total,
                'copy' => $request->copy,
                'user_id' => $user->id,
				'consulat_id' => Auth::user()->consulat_id,
            ];
            $demand = Demand::create($set);
            // Création des fichiers
            foreach ($request->filename as $file_id => $filename) {
				$path = $request->file('filename')[$file_id]->store('documents/' . date('Ymd') . '/' . Auth::user()->uuid, 'public');
				Attachment::create([
					'demand_id' => $demand->id,
					'file_id' => $file_id,
					'path' => $path,
				]);
			}
            DB::commit(); // Valider la transaction
            Myhelper::logs(
                Session::get('username'),
                Session::get('profil'),
                "Demande consulaire: {$reference} - {$user->lastname} {$user->firstname}",
                'Ajouter',
                Session::get('avatar')
            );
            return response()->json([
                'status' => 1,
                'message' => "Demande consulaire enregistrée avec succès.",
            ]);
        } catch (\Exception $e) {
            DB::rollBack(); // Annuler la transaction en cas d'erreur
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
		$addmodal = '<a href="/demands" class="btn btn-sm fw-bold btn-danger">Retour</a>';
		$documents = Document::orderBy('label')->get();
		$docFiles = DocFile::where('document_id', $query->document_id)->get();
        $civility = ['M.', 'Mme', 'Mlle'];
		$country = Country::orderBy('country')->get();
		$nationality = Country::orderBy('nationality')->get();
		$ville = Town::find(optional($query->user)->town_id);
		$pays = Country::find($ville->country_id);
		$town = Town::where('country_id', $ville->country_id)->orderBy('label')->get();
		$user['phone'] = Country::select('alpha')->where('code', $query->user->phone_code)->first();
		$user['person'] = Country::select('alpha')->where('code', $query->user->person_code)->first();
		$dmdFiles = Attachment::where('demand_id', $query->id)->get();
		return view('pages.demands.edit', compact('title', 'currentMenu', 'addmodal', 'query', 'country', 'pays', 'civility', 'town', 'documents', 'user', 'ville', 'nationality', 'docFiles', 'dmdFiles'));
	}
	// Mettre à jour une demande
	public function update(Request $request, $uuid) {
		dd($request->all());
        if (!Auth::check()) {
            return 'x';
        }
		// Validator
		$validator = Validator::make($request->all(), [
			'civility' => 'required|in:M.,Mme,Mlle',
			'lastname' => 'required',
			'firstname' => 'required',
			'phone_number' => [
				'required',
				'numeric',
                'digits_between:8,15',
			],
			'email' => [
				'nullable',
				'email',
			],
			'profession' => 'required',
			'nationality_id' => 'required|exists:countries,id',
            'town_id' => 'required|exists:towns,id',
            'birthday_at' => 'required|date|date_format:Y-m-d',
            'birthplace' => 'required',
            'father_fullname' => 'required',
            'mother_fullname' => 'required',
            'size' => 'required',
            'complexion' => 'required',
            'hairs' => 'required',
            'particular_sign' => 'required',
            'home_address' => 'required',
            'person_fullname' => 'required',
            'person_number' => 'required',
            'person_address' => 'required',
            'arrival_at' => 'required|date|date_format:Y-m-d',
			'document_id' => 'required|exists:documents,id',
			'number' => 'required|integer|min:1',
			'total' => 'required|integer|min:1',
			'copy' => 'required|integer|min:1',
			'filename' => 'required|array',
		], [
			'civility.required' => "La civilité est obligatoire.",
			'civility.in' => "La civilité est incorrecte.",
			'lastname.required' => "Le nom est obligatoire.",
			'firstname.required' => "Les prénoms sont obligatoires.",
			'phone_number.required' => "Le numéro de téléphone est obligatoire.",
            'phone_number.regex' => "Le numéro de téléphone doit contenir 10 chiffres.",
			'phone_number.unique' => "Le numéro de téléphone existe déjà dans la base de données.",
            'email.email' => "Adresse e-mail non valide.",
			'email.unique' => "Adresse e-mail existe déjà dans la base de données.",
			'profession.required' => "La profession est obligatoire.",
			'nationality_id.required' => "La nationalité est obligatoire.",
			'nationality_id.exists' => "La nationalité n'existe pas dans la base de données.",
			'birthday_at.required' => "La date de naissance est obligatoire.",
			'birthday_at.date_format' => "Le format de la date de naissance est incorrecte.",
			'town_id.required' => "La prefecture est obligatoire.",
			'town_id.exists' => "La prefecture n'existe pas dans la base de données.",
			'birthplace.required' => "Le lieu de naissance est obligatoire.",
			'father_fullname.required' => "Le nom et prénoms du père est obligatoire.",
			'mother_fullname.required' => "Le nom et prénoms de la mère est obligatoire.",
			'size.required' => "La taille est obligatoire.",
			'complexion.required' => "Le teint est obligatoire.",
			'hairs.required' => "Les cheveux sont obligatoires.",
			'particular_sign.required' => "Les Signes particuliers sont obligatoires.",
			'home_address.required' => "L'adresse domiciliale est obligatoire.",
			'arrival_at.required' => "La date d'arrivée est obligatoire.",
			'arrival_at.date_format' => "Le format de la date d'arrivée est incorrecte.",
			'document_id.required' => "Le document est obligatoire.",
			'document_id.exists' => "Le document n'existe pas dans la base de données.",
			'number.required' => "Le numéro est obligatoire.",
			'number.integer' => "Le numéro doit être un nombre entier.",
			'number.min' => "Le numéro doit être supérieur à 0.",
			'total.required' => "Le prix est obligatoire.",
			'total.integer' => "Le prix doit être un nombre entier.",
			'total.min' => "Le prix doit être supérieur à 0.",
			'copy.required' => "Le nombre de copies est obligatoire.",
			'copy.integer' => "Le nombre de copies doit être un nombre entier.",
			'copy.min' => "Le nombre de copies doit être supérieur à 0.",
			'filename.required' => "Les fichiers sont obligatoires.",
			'filename.array' => "Les fichiers doivent être un tableau.",
		]);
		// Error field
		if ($validator->fails()) {
			Log::warning("Demand::update - Validator : {$validator->errors()->first()} - " . json_encode($request->all()));
			return response()->json([
				'status' => 0,
				'message' => $validator->errors()->first(),
			]);
		}
		// Vérifier si la demande existe
		$query = Demand::where('uuid', $uuid)->first();
		if (!$query) {
			Log::warning("Demand::update - Aucune demande trouvée pour l'UUID : {$uuid}");
			return response()->json([
				'status' => 0,
				'message' => "Demande non trouvée.",
			]);
		}
        // Gendre
        $gender = match($request->civility) {
            'Mme', 'Mlle' => 'F',
            default => 'M',
        };
        // Formatage du nom et prénoms
		$lastname = Str::upper(Myhelper::valideString($request->lastname, 'UTF-8'));
		$firstname = Str::upper(Myhelper::valideString($request->firstname, 'UTF-8'));
		$set = [
			'civility' => $request->civility,
			'lastname' => $lastname,
			'firstname' => $firstname,
            'gender' => $gender,
            'phone_code' => $request->phone_code,
            'phone_number' => $request->phone_number,
            'email' => Str::lower($request->email) ?? '',
            'profession' => Str::upper(Myhelper::valideString($request->profession),'UTF-8'),
            'nationality_id' => $request->nationality_id,
            'birthday_at' => $request->birthday_at,
            'town_id' => $request->town_id,
            'birthplace' => Str::upper(Myhelper::valideString($request->birthplace),'UTF-8'),
            'father_fullname' => Str::upper(Myhelper::valideString($request->father_fullname),'UTF-8'),
            'mother_fullname' => Str::upper(Myhelper::valideString($request->mother_fullname),'UTF-8'),
            'size' => Str::upper(Myhelper::valideString($request->size),'UTF-8'),
            'complexion' => Str::upper(Myhelper::valideString($request->complexion),'UTF-8'	),
            'hairs' => Str::upper(Myhelper::valideString($request->hairs),'UTF-8'),
            'particular_sign' => Str::upper(Myhelper::valideString($request->particular_sign),'UTF-8'),
            'home_address' => Str::upper(Myhelper::valideString($request->home_address),'UTF-8'),
            'person_fullname' => Str::upper(Myhelper::valideString($request->person_fullname),'UTF-8'),
            'person_code' => $request->person_code,
            'person_number' => $request->person_number,
            'person_address' => Str::upper(Myhelper::valideString($request->person_address),'UTF-8'),
            'arrival_at' => $request->arrival_at,
        ];
        DB::beginTransaction(); // Démarrer une transaction
        try {
            // Création de l'utilisateur
			$user = $query->user->update($set);
            // Mettre à jour la demande
            $set = [
                'document_id' => $request->document_id,
                'number' => $request->number,
                'price' => $request->total,
                'copy' => $request->copy,
            ];
            $query->update($set);
			// Suppression des fichiers
			$dmdFiles = Attachment::where('demand_id', $query->id)->get();
            foreach ($dmdFiles as $dmdFile) {
                Storage::disk('public')->delete($dmdFile->path);
                $dmdFile->delete();
            }
            // Mettre à jour les fichiers
            foreach ($request->filename as $file_id => $filename) {
				$path = $request->file('filename')[$file_id]->store('documents/' . date('Ymd') . '/' . Auth::user()->uuid, 'public');
				Attachment::create([
					'demand_id' => $query->id,
					'file_id' => $file_id,
					'path' => $path,
				]);
			}
			DB::commit(); // Valider la transaction
			Myhelper::logs(
				Session::get('username'),
				Session::get('profil'),
				"Demande consulaire: {$query->reference}",
				'Modifier',
				Session::get('avatar')
			);
			return response()->json([
				'status' => 1,
				'message' => "Demande consulaire modifiée avec succès.",
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
			'status' => 1,
			'data' => $users,
		]);
	}
    // Liste des demandes consulaires
	public function getDemands() {
        if (!Auth::check()) {
            return 'x';
        }
		//Requete Read
		$query = DB::select('CALL sp_list_demands(?)', [Auth::id()]);
		// Transformer les données
		$demands = collect($query)->map(fn($data) => [
			'uuid' => $data->uuid,
			'reference' => $data->reference,
			'user' => $data->civility . ' ' . $data->firstname . ' ' . $data->lastname,
			'label' => $data->label,
			'number' => $data->number,
			'price' => $data->price,
			'copy' => $data->copy,
			'status' => $data->status,
			'path' => ($data->path == null && $data->status == 2) ? Demand::print_dmd($data->uuid) : asset($data->path),
		]);
		return response()->json([
			'status' => 1,
			'data' => $demands,
		]);
	}
	// Rejeter une demande
	public function reject(Request $request) {
        if (!Auth::check()) {
            return 'x';
        }
		// Validator
		$validator = Validator::make($request->all(), [
			'uuid' => 'required|uuid|exists:demands,uuid',
			'motif' => 'required|string|min:10',
		], [
			'uuid.required' => "L'identifiant est obligatoire.",
			'uuid.uuid' => "L'identifiant doit être un UUID valide.",
			'uuid.exists' => "La demande spécifiée n'existe pas.",
			'motif.required' => "Le motif est obligatoire.",
			'motif.min' => "Le motif doit contenir au moins 10 caractères.",
		]);
		// Error field
		if ($validator->fails()) {
			Log::warning("Demand::reject - Validator : {$validator->errors()->first()} - " . json_encode($request->all()));
			return response()->json([
				'status' => 0,
				'message' => $validator->errors()->first(),
			]);
		}
		// Vérifier si la caisse existe
		$query = Demand::where('uuid', $request->uuid)->first();
		if (!$query) {
			Log::warning("Demand::reject - Aucune demande trouvée pour l'UUID : {$request->uuid}");
			return response()->json([
				'status' => 0,
				'message' => "Demande non trouvée.",
			]);
		}
		$label = optional($query->document)->label;
		$set = [
			'status' => 3,
			'rejeted_at' => now(),
			'motif' => $request->motif,
			'rejeted_by' => Auth::user()->id,
		];
		DB::beginTransaction();
		try {
			// Mettre à jour la demande
			$query->update($set);
			DB::commit();
			Myhelper::logs(
				Session::get('username'),
				Session::get('profil'),
				"Demande consulaire: {$label}",
				'Rejeter',
				Session::get('avatar')
			);
			return response()->json([
				'status' => 1,
				'message' => "Demande consulaire rejetée avec succès.",
			]);
		} catch (\Exception $e) {
			DB::rollBack(); // Annuler la transaction en cas d'erreur
			Log::warning("Demand::reject - Erreur : {$e->getMessage()} " . json_encode($request->all()));
			return response()->json([
				'status' => 0,
				'message' => "Erreur lors du rejet.",
			]);
		}
	}
}

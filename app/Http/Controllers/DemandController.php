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
			'phone_number' => $data->phone_number,
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
		dd($request->all());
        if (!Auth::check()) {
            return redirect('/');
        }
		// Validator
		$validator = Validator::make($request->all(), [
			'civility' => 'required|in:M.,Mme,Mlle',
			'lastname' => 'required',
			'firstname' => 'required',
			'phone_number' => [
				'required',
                'regex:/^\d{10}$/',
                Rule::unique('users')->where(function ($query) {
					return $query->whereNull('deleted_at');
                }),
			],
			'email' => [
				'required',
				'email',
                Rule::unique('users')->where(function ($query) {
					return $query->whereNull('deleted_at');
                }),
			],
			'profession' => 'required',
            'profile_id' => 'required|exists:profiles,id',
			'nationality_id' => 'required|exists:countries,id',
            'embassy_id' => 'required|exists:countries,id',
            'agency_id' => 'required|exists:agencies,id',
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
			'signature' => 'nullable|file|mimes:png,jpg,jpeg|max:2048',
			'stamp' => 'nullable|file|mimes:png,jpg,jpeg|max:2048',
		], [
			'civility.required' => "La civilité est obligatoire.",
			'civility.in' => "La civilité est incorrecte.",
			'lastname.required' => "Le nom est obligatoire.",
			'firstname.required' => "Les prénoms sont obligatoires.",
			'phone_number.required' => "Le numéro de téléphone est obligatoire.",
            'phone_number.regex' => "Le numéro de téléphone doit contenir 10 chiffres.",
			'phone_number.unique' => "Le numéro de téléphone existe déjà dans la base de données.",
			'email.required' => "Adresse e-mail est obligatoire.",
            'email.email' => "Adresse e-mail non valide.",
			'email.unique' => "Adresse e-mail existe déjà dans la base de données.",
			'profession.required' => "La profession est obligatoire.",
            'profile_id.required' => "Le profil est obligatoire.",
            'profile_id.exists' => "Le profil n'existe pas dans la base de données.",
            'embassy_id.required' => "L'ambassade est obligatoire.",
            'embassy_id.exists' => "L'ambassade n'existe pas dans la base de données.",
            'agency_id.required' => "L'agence est obligatoire.",
            'agency_id.exists' => "L'agence n'existe pas dans la base de données.",
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
			'signature.file' => "La signature doit être un fichier.",
			'signature.mimes' => "La signature doit être un fichier de type : png, jpg ou jpeg",
			'signature.max' => "La signature ne doit pas être supérieur à 2Mo.",
			'stamp.file' => "Le cachet doit être un fichier.",
			'stamp.mimes' => "Le cachet doit être un fichier de type : png, jpg ou jpeg",
			'stamp.max' => "Le cachet ne doit pas être supérieur à 2Mo.",
		]);
		// Error field
		if ($validator->fails()) {
			Log::warning("User::store - Validator : {$validator->errors()->first()} - " . json_encode($request->all()));
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
        $firstname = Str::title(Myhelper::valideString($request->firstname, 'UTF-8'));
		// Enregistrer le fichier
		$signature = $request->file('signature') != '' ? $request->file('signature')->store('signatures', 'public') : '';
		$stamp = $request->file('stamp') != '' ? $request->file('stamp')->store('stamps', 'public') : '';
        $set = [
            'code' => substr($request->code, 1),
            'civility' => $request->civility,
            'lastname' => $lastname,
            'firstname' => $firstname,
            'gender' => $gender,
            'phone_number' => $request->phone_number,
            'email' => Str::lower($request->email),
            'profession' => Str::upper(Myhelper::valideString($request->profession)),
            'profile_id' => $request->profile_id,
            'embassy_id' => $request->embassy_id,
            'agency_id' => $request->agency_id,
            'nationality_id' => $request->nationality_id,
            'birthday_at' => $request->birthday_at,
            'town_id' => $request->town_id,
            'birthplace' => Str::upper(Myhelper::valideString($request->birthplace)),
            'father_fullname' => Str::upper(Myhelper::valideString($request->father_fullname)),
            'mother_fullname' => Str::upper(Myhelper::valideString($request->mother_fullname)),
            'size' => Str::upper(Myhelper::valideString($request->size)),
            'complexion' => Str::upper(Myhelper::valideString($request->complexion)),
            'hairs' => Str::upper(Myhelper::valideString($request->hairs)),
            'particular_sign' => Str::upper(Myhelper::valideString($request->particular_sign)),
            'home_address' => Str::upper(Myhelper::valideString($request->home_address)),
            'person_fullname' => Str::upper(Myhelper::valideString($request->person_fullname)),
            'person_number' => $request->person_number,
            'person_address' => Str::upper(Myhelper::valideString($request->person_address)),
            'arrival_at' => $request->arrival_at,
            'signature' => $signature,
            'stamp' => $stamp,
            'password_at' => now(),
            'password' => Hash::make('Azerty@123'),
        ];
        DB::beginTransaction(); // Démarrer une transaction
        try {
            // Création de l'utilisateur
            User::create($set);
            DB::commit(); // Valider la transaction
            Myhelper::logs(
                Session::get('username'),
                Session::get('profil'),
                "Utilisateur: {$lastname} {$firstname}",
                'Ajouter',
                Session::get('avatar')
            );
            return response()->json([
                'status' => 1,
                'message' => "Utilisateur enregistré avec succès.",
            ]);
        } catch (\Exception $e) {
            DB::rollBack(); // Annuler la transaction en cas d'erreur
            Log::warning("User::store - Erreur : {$e->getMessage()} " . json_encode($request->all()));
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

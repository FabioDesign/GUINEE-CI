<?php
namespace App\Http\Controllers; 

use Session;
use Myhelper;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\{Auth,DB, Hash, Log, Validator};
use App\Models\{Consulat, Country, Document, Logs, Consulardoc, Permission, Profile, Town, User};

class UserController extends Controller
{
    // Liste des utilisateurs
    public function index() {
        if (!Auth::check()) {
            return redirect('/');
        }
		// Title
		$title = 'Gestion des utilisateurs';
		// Menu
		$currentMenu = 'users';
		// Modal
		$actionIds = Myhelper::actions(Auth::user()->profile_id, 8);
		$addmodal = in_array(2, $actionIds) ? '<a href="/users/create" class="btn btn-sm fw-bold btn-primary">Ajouter un utilisateur</a>':'';
		// Requete Read
		$query = User::join('profiles', 'users.profile_id', '=', 'profiles.id')
        ->select('users.uuid', 'firstname', 'lastname', 'gender', 'phone_code', 'phone_number', 'users.created_at', 'users.status', 'profiles.label')
		->where('consulat_id', Auth::user()->consulat_id)
		->where('users.id', '!=', Auth::id())
        ->whereNotIn('role_id', [1, 4])
        ->orderByDesc('users.created_at')
        ->get();
		Myhelper::logs(
			Auth::user()->consulat_id,
			Auth::user()->profile_id,
			Session::get('username'),
			Session::get('profil'),
			"Utilisateur: Liste",
			'Consulter',
			Session::get('avatar')
		);
        return view('pages.users.index', compact('title', 'currentMenu', 'addmodal', 'actionIds', 'query'));
    }
    // Détail d'Utilisateur
	public function show($uuid) {
        if (!Auth::check()) {
            return redirect('/');
        }
		// Title
		$title = "Détail de l'utilisateur";
		// Menu
		$currentMenu = 'users';
		// Vérifier si l'utilisateur existe
		$query = User::where('uuid', $uuid)->first();
		if (!$query) {
			Log::warning("User::show - Aucun utilisateur trouvée pour l'uUID : {$uuid}");
			return redirect('/users');
		}
		// Modal
		$addmodal = '<a href="/users" class="btn btn-sm fw-bold btn-danger">Retour</a>';
		$country = Country::orderBy('country')->get();
		$ville = Town::where('id', $query->town_id)->first();
		$user['phone'] = Country::select('alpha')->where('code', $query->phone_code)->first();
		$user['person'] = Country::select('alpha')->where('code', $query->person_code)->first();
		return view('pages.users.show', compact('title', 'currentMenu', 'addmodal', 'query', 'ville', 'country', 'user'));
	}
    // Liste des utilisateurs
	public function create() {
        if (!Auth::check()) {
            return redirect('/');
        }
		// Title
		$title = "Ajout d'un utilisateur";
		// Menu
		$currentMenu = 'users';
		// Modal
		$addmodal = '<a href="/users" class="btn btn-sm fw-bold btn-danger">Retour</a>
		<a href="#" class="btn btn-sm fw-bold btn-success submitForm">Ajouter</a>';
        $civility = ['M.', 'Mme', 'Mlle'];
		$country = Country::orderBy('country')->get();
		$consulat = Consulat::where('country_id', 41)->orderBy('label')->get();
		$nationality = Country::orderBy('nationality')->get();
		$town = Town::where('country_id', 61)->orderBy('label')->get();
		$embassy = Country::where('embassy', 1)->orderBy('country')->get();
		$profile = Profile::where('id', '!=', 1)->orderBy('label')->get();
		return view('pages.users.create', compact('title', 'currentMenu', 'addmodal', 'civility', 'town', 'country', 'embassy', 'profile', 'nationality', 'consulat'));
	}
    // Account creation
    public function store(Request $request) {
		// Validator
		$validator = Validator::make($request->all(), [
			'civility' => 'required|in:M.,Mme,Mlle',
			'lastname' => 'required',
			'firstname' => 'required',
			'phone_number' => [
				'required',
				'numeric',
                'digits_between:8,15',
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
            'consulat_id' => 'required|exists:consulats,id',
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
            'person_number' => [
                'required',
                'numeric',
                'digits_between:8,15',
            ],
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
            'phone_number.numeric' => "Le numéro de téléphone doit être un nombre.",
            'phone_number.digits_between' => "Le numéro de téléphone doit être entre 8 et 15 chiffres.",
			'phone_number.unique' => "Le numéro de téléphone existe déjà dans la base de données.",
			'email.required' => "Adresse e-mail est obligatoire.",
            'email.email' => "Adresse e-mail non valide.",
			'email.unique' => "Adresse e-mail existe déjà dans la base de données.",
			'profession.required' => "La profession est obligatoire.",
            'profile_id.required' => "Le profil est obligatoire.",
            'profile_id.exists' => "Le profil n'existe pas dans la base de données.",
            'embassy_id.required' => "L'ambassade est obligatoire.",
            'embassy_id.exists' => "L'ambassade n'existe pas dans la base de données.",
            'consulat_id.required' => "Le consulat est obligatoire.",
            'consulat_id.exists' => "Le consulat n'existe pas dans la base de données.",
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
            'person_fullname.required' => "Le nom et prénoms de la personne est obligatoire.",
            'person_number.required' => "Le numéro de la personne est obligatoire.",
            'person_address.required' => "L'adresse de la personne est obligatoire.",
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
        $firstname = Str::upper(Myhelper::valideString($request->firstname, 'UTF-8'));
		// Enregistrer le fichier
		$signature = $request->file('signature') != '' ? $request->file('signature')->store('signatures', 'public') : '';
		$stamp = $request->file('stamp') != '' ? $request->file('stamp')->store('stamps', 'public') : '';
        $set = [
            'civility' => $request->civility,
            'lastname' => $lastname,
            'firstname' => $firstname,
            'gender' => $gender,
            'phone_code' => $request->phone_code,
            'phone_number' => $request->phone_number,
            'email' => Str::lower($request->email),
            'profession' => Str::upper(Myhelper::valideString($request->profession),'UTF-8'),
            'profile_id' => $request->profile_id,
            'embassy_id' => $request->embassy_id,
            'consulat_id' => $request->consulat_id,
            'nationality_id' => $request->nationality_id,
            'birthday_at' => $request->birthday_at,
            'town_id' => $request->town_id,
            'birthplace' => Str::upper(Myhelper::valideString($request->birthplace),'UTF-8'),
            'father_fullname' => Str::upper(Myhelper::valideString($request->father_fullname),'UTF-8'),
            'mother_fullname' => Str::upper(Myhelper::valideString($request->mother_fullname),'UTF-8'),
            'size' => Str::upper(Myhelper::valideString($request->size),'UTF-8'),
            'complexion' => Str::upper(Myhelper::valideString($request->complexion),'UTF-8'),
            'hairs' => Str::upper(Myhelper::valideString($request->hairs),'UTF-8'),
            'particular_sign' => Str::upper(Myhelper::valideString($request->particular_sign),'UTF-8'),
            'home_address' => Str::upper(Myhelper::valideString($request->home_address),'UTF-8'),
            'person_fullname' => Str::upper(Myhelper::valideString($request->person_fullname),'UTF-8'),
            'person_code' => $request->person_code,
            'person_number' => $request->person_number,
            'person_address' => Str::upper(Myhelper::valideString($request->person_address),'UTF-8'),
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
                Auth::user()->consulat_id,
			    Auth::user()->profile_id,
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
	// Afficher le formulaire d'édition d'un utilisateur
	public function edit($uuid) {
        if (!Auth::check()) {
            return redirect('/');
        }
		// Title
		$title = "Modification d'un utilisateur";
		// Menu
		$currentMenu = 'users';
		// Vérifier si l'utilisateur existe
		$query = User::where('uuid', $uuid)->first();
		if (!$query) {
			Log::warning("User::edit - Aucun utilisateur trouvée pour l'uUID : {$uuid}");
			return redirect('/users');
		}
		// Modal
		$addmodal = '<a href="/users" class="btn btn-sm fw-bold btn-danger">Retour</a>
		<a href="#" class="btn btn-sm fw-bold btn-success submitForm">Modifier</a>';
        $civility = ['M.', 'Mme', 'Mlle'];
		$country = Country::orderBy('country')->get();
		$nationality = Country::orderBy('nationality')->get();
		$consulat = Consulat::where('id', $query->consulat_id)->first();
		$consulats = Consulat::where('country_id', $consulat->country_id)->orderBy('label')->get();
		$ville = Town::where('id', $query->town_id)->first();
		$town = Town::where('country_id', $ville->country_id)->orderBy('label')->get();
		$embassy = Country::where('embassy', 1)->orderBy('country')->get();
		$profile = Profile::where('id', '!=', 1)->orderBy('label')->get();
		$user['phone'] = Country::select('alpha')->where('code', $query->phone_code)->first();
		$user['person'] = Country::select('alpha')->where('code', $query->person_code)->first();
		return view('pages.users.edit', compact('title', 'currentMenu', 'addmodal', 'query', 'ville', 'civility', 'town', 'country', 'embassy', 'profile', 'nationality', 'consulat', 'consulats', 'user'));
	}
    // Modification
    public function update(Request $request, $uuid) {
        if (!Auth::check()) {
            return 'x';
        }
        try {
            // Vérifier si l'utilisateur existe
            $user = User::where('uuid', $uuid)->first();
            if (!$user) {
                Log::warning("User::update - Aucun utilisateur trouvé pour l'uUID : {$uuid}");
                return response()->json([
                    'status' => 0,
                    'message' => "Utilisateur non trouvé.",
                ]);
            }
            $request->merge([
                'phone_number' => str_replace(' ', '', $request->phone_number),
                'person_number' => str_replace(' ', '', $request->person_number),
            ]);
            // Validator
            $validator = Validator::make($request->all(), [
                'civility' => 'required|in:M.,Mme,Mlle',
                'lastname' => 'required',
                'firstname' => 'required',
                'phone_number' => [
                    'required',
					'numeric',
                    'digits_between:8,15',
                    Rule::unique('users')->where(function ($query) use ($uuid) {
                        return $query->where('uuid', '!=', $uuid)->whereNull('deleted_at');
                    }),
                ],
                'email' => [
                    'required',
                    Rule::unique('users')->where(function ($query) use ($uuid) {
                        return $query->where('uuid', '!=', $uuid)->whereNull('deleted_at');
                    }),
                ],
                'profession' => 'required',
                'profile_id' => 'required|exists:profiles,id',
                'nationality_id' => 'required|exists:countries,id',
                'embassy_id' => 'required|exists:countries,id',
                'consulat_id' => 'required|exists:consulats,id',
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
                'person_number' => [
                    'required',
                    'numeric',
                    'digits_between:8,15',
                ],
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
                'phone_number.numeric' => "Le numéro de téléphone doit être un nombre.",
                'phone_number.digits_between' => "Le numéro de téléphone doit être entre 8 et 15 chiffres.",
                'phone_number.unique' => "Le numéro de téléphone existe déjà dans la base de données.",
                'email.required' => "L'email est obligatoire.",
                'email.unique' => "L'email existe déjà dans la base de données.",
                'profession.required' => "La profession est obligatoire.",
                'profile_id.required' => "Le profil est obligatoire.",
                'profile_id.exists' => "Le profil n'existe pas dans la base de données.",
                'nationality_id.required' => "La nationalité est obligatoire.",
                'nationality_id.exists' => "La nationalité n'existe pas dans la base de données.",
                'embassy_id.required' => "L'ambassade est obligatoire.",
                'embassy_id.exists' => "L'ambassade n'existe pas dans la base de données.",
                'consulat_id.required' => "Le consulat est obligatoire.",
                'consulat_id.exists' => "Le consulat n'existe pas dans la base de données.",
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
                'person_fullname.required' => "Le nom et prénoms de la personne est obligatoire.",
                'person_number.required' => "Le numéro de la personne est obligatoire.",
                'person_address.required' => "L'adresse de la personne est obligatoire.",
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
            $firstname = Str::upper(Myhelper::valideString($request->firstname, 'UTF-8'));
            $set = [
                'civility' => $request->civility,
                'lastname' => $lastname,
                'firstname' => $firstname,
                'gender' => $gender,
                'phone_code' => $request->phone_code,
                'phone_number' => $request->phone_number,
                'email' => Str::lower($request->email),
                'profession' => Str::upper(Myhelper::valideString($request->profession),'UTF-8'),
                'profile_id' => $request->profile_id,
                'nationality_id' => $request->nationality_id,
                'embassy_id' => $request->embassy_id,
                'consulat_id' => $request->consulat_id,
                'birthday_at' => $request->birthday_at,
                'town_id' => $request->town_id,
                'birthplace' => Str::upper(Myhelper::valideString($request->birthplace),'UTF-8'),
                'father_fullname' => Str::upper(Myhelper::valideString($request->father_fullname),'UTF-8'),
                'mother_fullname' => Str::upper(Myhelper::valideString($request->mother_fullname),'UTF-8'),
                'size' => Str::upper(Myhelper::valideString($request->size),'UTF-8'),
                'complexion' => Str::upper(Myhelper::valideString($request->complexion),'UTF-8'),
                'hairs' => Str::upper(Myhelper::valideString($request->hairs),'UTF-8'),
                'particular_sign' => Str::upper(Myhelper::valideString($request->particular_sign),'UTF-8'),
                'home_address' => Str::upper(Myhelper::valideString($request->home_address),'UTF-8'),
                'person_fullname' => Str::upper(Myhelper::valideString($request->person_fullname),'UTF-8'),
                'person_code' => $request->person_code,
                'person_number' => $request->person_number,
                'person_address' => Str::upper(Myhelper::valideString($request->person_address),'UTF-8'),
                'arrival_at' => $request->arrival_at,
            ];
            // Enregistrer le fichier
            if ($request->img_sig == 0) {
                $signature = $request->file('signature') != '' ? $request->file('signature')->store('signatures', 'public') : '';
                $set['signature'] = $signature;
            }
            if ($request->img_sta == 0) {
                $stamp = $request->file('stamp') != '' ? $request->file('stamp')->store('stamps', 'public') : '';
                $set['stamp'] = $stamp;
            }
            $avatar = '';
            if ($request->file('avatar') != '') {
                // Validator
                $validator = Validator::make($request->all(), [
                    'avatar' => 'required|file|mimes:png,jpg,jpeg|max:2048',
                ], [
                    'avatar.file' => "L'avatar doit être un fichier.",
                    'avatar.mimes' => "L'avatar doit être un fichier de type : png, jpg ou jpeg",
                    'avatar.max' => "L'avatar ne doit pas être supérieur à 2Mo.",
                ]);
                // Error field
                if ($validator->fails()) {
                    Log::warning("User::store - Validator : {$validator->errors()->first()} - " . json_encode($request->all()));
                    return response()->json([
                        'status' => 0,
                        'message' => $validator->errors()->first(),
                    ]);
                }
                $set['avatar'] = $avatar = $request->file('avatar')->store('avatars', 'public');
            }
            // dd($set);
            DB::beginTransaction(); // Démarrer une transaction
			// Mettre à jour l'utilisateur
			$user->update($set);
            DB::commit(); // Valider la transaction
            Myhelper::logs(
                Auth::user()->consulat_id,
			    Auth::user()->profile_id,
                Session::get('username'),
                Session::get('profil'),
                "Utilisateur: {$lastname} {$firstname}",
                'Modifier',
                Session::get('avatar')
            );
            if ($request->has('account')) {
                // Préparer les données de session
                $prenom = explode(' ', $firstname);
                $username = $prenom[0] . ' ' . $lastname;
                Session::put('username', $username);
                // Avatar
                if ($avatar != '')
                Session::put('avatar', $avatar);
            }
            return response()->json([
                'status' => 1,
                'message' => "Utilisateur modifié avec succès.",
            ]);
        } catch (\Exception $e) {
            DB::rollBack(); // Annuler la transaction en cas d'erreur
            Log::warning("User::store - Erreur : {$e->getMessage()} " . json_encode($request->all()));
            return response()->json([
                'status' => 0,
                'message' => "Erreur lors de la modification.",
            ]);
        }
	}
	// Supprimer un utilisateur
	public function destroy($uuid) {
        if (!Auth::check()) {
            return 'x';
        }
		try {
            // Vérifier si l'utilisateur existe
            $user = User::where('uuid', $uuid)->first();
            if (!$user) {
                Log::warning("User::destroy - Aucun utilisateur trouvé pour l'uUID : {$uuid}");
                return response()->json([
                    'status' => 0,
                    'message' => "Utilisateur non trouvé.",
                ]);
            }
			// Vérifier si des utilisateurs sont associés
			$userCount = Consulardoc::where('user_id', $user->id)->count();
			if ($userCount > 0) {
				Log::warning("User::destroy - Cet utilisateur est associée à {$userCount} document(s).");
				return response()->json([
					'status' => 0,
					'message' => "Cet utilisateur est associée à {$userCount} document(s).",
				]);
			}
			DB::beginTransaction();
			// Supprimer l'utilisateur
			$user->delete();
			DB::commit();
			Myhelper::logs(
                Auth::user()->consulat_id,
			    Auth::user()->profile_id,
                Session::get('username'),
				Session::get('profil'),
				"Utilisateur: {$user->firstname} {$user->lastname}",
				'Supprimer',
				Session::get('avatar')
			);
			return response()->json([
				'status' => 1,
				'message' => "Utilisateur supprimé avec succès.",
			]);
		} catch (\Exception $e) {
			DB::rollBack();
			Log::warning("User::destroy - Erreur : {$e->getMessage()}");
			return response()->json([
				'status' => 0,
				'message' => "Erreur lors de la suppression.",
			]);
		}
	}
	// Info perso user
	public function account() {
        if (!Auth::check()) {
            return redirect('/');
        }
		// Title
		$title = "Modification de mon profil";
		// Menu
		$currentMenu = 'users';
		// Modal
		$addmodal = '<a href="/users" class="btn btn-sm fw-bold btn-danger">Retour</a>
		<a href="#" class="btn btn-sm fw-bold btn-success submitForm">Modifier</a>';
        $civility = ['M.', 'Mme', 'Mlle'];
        $query = User::where('id', Auth::user()->id)->first();
        // Avatar
        if ($query->avatar == '')
        $query->avatar = $query->gender == 'M' ? 'avatars/homme.jpg' : 'avatars/femme.jpg';
		$country = Country::orderBy('country')->get();
		$nationality = Country::orderBy('nationality')->get();
		$consulat = Consulat::where('id', $query->consulat_id)->first();
		$consulats = Consulat::where('country_id', $consulat->country_id)->orderBy('label')->get();
		$ville = Town::where('id', $query->town_id)->first();
		$town = Town::where('country_id', $ville->country_id)->orderBy('label')->get();
		$embassy = Country::where('embassy', 1)->orderBy('country')->get();
		$profile = Profile::where('id', '!=', 1)->orderBy('label')->get();
		$user['phone'] = Country::select('alpha')->where('code', $query->phone_code)->first();
		$user['person'] = Country::select('alpha')->where('code', $query->person_code)->first();
		return view('pages.users.account', compact('title', 'currentMenu', 'addmodal', 'query', 'ville', 'civility', 'town', 'country', 'embassy', 'profile', 'nationality', 'consulat', 'consulats', 'user'));
	}
	// Récupérer un utilisateur
	public function getUsers($id) {
		// Requete Read
		$data['user'] = User::select('civility', 'lastname', 'firstname', 'email', 'phone_code', 'phone_number', 'profession', 'nationality_id', 'town_id', 'birthday_at', 'birthplace', 'father_fullname', 'mother_fullname', 'size', 'complexion', 'hairs', 'particular_sign', 'home_address', 'person_fullname', 'person_code', 'person_number', 'person_address', 'arrival_at')
		->where('id', $id)
		->first();
        $data['civility'] = ['M.', 'Mme', 'Mlle'];
		$data['country'] = Country::select('id', 'alpha', 'code', 'country')->orderBy('country')->get();
		$data['nationality'] = Country::select('id', 'alpha', 'code', 'nationality')->orderBy('nationality')->get();
		$data['label_nation'] = Country::where('id', $data['user']->nationality_id)->first()->nationality;
		$data['ville'] = Town::select('id', 'label', 'country_id')->where('id', $data['user']->town_id)->first();
		$data['town'] = Town::select('id', 'label')->where('country_id', $data['ville']->country_id)->orderBy('label')->get();
		$data['phone'] = Country::select('alpha')->where('code', $data['user']->phone_code)->first();
		$data['person'] = Country::select('alpha')->where('code', $data['user']->person_code)->first();
		return response()->json([
			'status' => 1,
			'data' => $data,
		]);
	}
    // Connexion
	public function login() {
        // Requete Read
        $query = Document::where('status', 1)
        ->orderBy('label')
        ->get();
        return view('login', compact('query'));
	}
    // Authentification avec Laravel Auth
    public function auth(Request $request) {
        // Validator
        $validator = Validator::make($request->all(), [
            'login' => 'required',
            'password' => 'required|min:8',
        ], [
            'login.required' => "Login ou mot de passe incorrect.",
            'password.*' => "Login ou mot de passe incorrect.",
        ]);
        // Error field
        if ($validator->fails()) {
            Log::warning("User::auth - Validator : {$validator->errors()->first()}");
            return response()->json([
                'status' => 0,
                'message' => $validator->errors()->first(),
            ]);
        }
        try {
            // Déterminer si le login est un email ou un numéro de téléphone
            if (filter_var($request->login, FILTER_VALIDATE_EMAIL)) {
                // Authentification par email
                $loginField = 'email';
                $credentials = [
                    'email' => $request->login,
                    'password' => $request->password,
                    'status' => 1,
                ];
            } else {
                // Authentification par téléphone
                $phone = $request->login;
                // Récupérer les codes pays existants
                $countries = Country::orderByRaw('LENGTH(code) DESC')->get();
                $country = '';
                foreach ($countries as $item) :
                    if (str_starts_with($phone, $item->code)) {
                        $country = $item;
                        break;
                    }
                endforeach;
                if (!$country) {
                    return response()->json([
                        'status' => 0,
                        'message' => "Code pays invalide."
                    ]);
                }
                // Séparer le code pays et le numéro
                $phoneCode = $country->code;
                $phoneNumber = substr($phone, strlen($phoneCode));
                $credentials = [
                    'phone_code' => $phoneCode,
                    'phone_number' => $phoneNumber,
                    'password' => $request->password,
                    'status' => 1,
                ];
            }
            // Vérifier si l'utilisateur existe
            $query = User::where(function ($q) use ($credentials) {
                if (isset($credentials['email'])) {
                    $q->where('email', $credentials['email']);
                } else {
                    $q->where('phone_code', $credentials['phone_code'])
                    ->where('phone_number', $credentials['phone_number']);
                }
            });
            $user = $query->first();
            if (!$user) {
                return response()->json([
                    'status' => 0,
                    'message' => "Login ou mot de passe incorrect.",
                ]);
            }
            // Vérifier le statut du compte
            if ($user->status == 0) {
                return response()->json([
                    'status' => 0,
                    'message' => "Votre compte est inactif.",
                ]);
            }
            if ($user->status == 2) {
                return response()->json([
                    'status' => 0,
                    'message' => "Votre compte est bloqué.",
                ]);
            }
            // Vérifier le statut du profil
            if ($user->profile && $user->profile->status == 0) {
                return response()->json([
                    'status' => 0,
                    'message' => "Votre profil est désactivé.",
                ]);
            }
            // Vérifier si le compte n'est pas rattaché à une Ambassade
            if ($user->embassy && $user->embassy->embassy == 0) {
                return response()->json([
                    'status' => 0,
                    'message' => "Votre compte n'est pas rattaché à une Ambassade.",
                ]);
            }
            // Tentative de connexion
            if (!Auth::attempt($credentials)) {
                // Mot de passe incorrect
                Log::warning("User::auth - Tentative de connexion échouée pour : {$request->login}");
                return response()->json([
                    'status' => 0,
                    'message' => "Login ou mot de passe incorrect.",
                ]);
            }
            // Mise à jour de la dernière connexion
            $user->update([
                'login_at' => now(),
            ]);
            // Préparer les données de session
            $prenom = explode(' ', $user->firstname);
            $username = "{$prenom[0]} {$user->lastname}";
            // Récupération des menus
            $menus = Permission::select('menus.id', 'label', 'target', 'icone')
                ->join('menus', 'menus.id', '=', 'permissions.menu_id')
                ->where('profile_id', $user->profile_id)
                ->where('status', 1)
                ->where('action_id', 1)
                ->orderBy('position')
                ->get();
            if ($menus->isEmpty()) {
                Log::warning("User::auth - Aucun menu trouvé pour ce profil : {$user->profile_id}");
                Auth::logout();
                return response()->json([
                    'status' => 0,
                    'message' => "Aucun menu trouvé pour ce profil.",
                ]);
            }
            $page = $menus->first()->target ?? '/';
            // Stocker des informations supplémentaires en session
            Session::put('username', $username);
            Session::put('consulat', $user->consulat_id);
            Session::put('profil', $user->profile->label ?? '');
            Session::put('role', $user->profile->role_id ?? '');
            Session::put('embassy', Str::upper($user->embassy->country ?? '') . ' - ' . $user->consulat->label ?? '','UTF-8');
            Session::put('map', $user->embassy->alpha ?? '');
            Session::put('menus', $menus);
            // Avatar
            if ($user->avatar != '')
                $avatar = $user->avatar;
            else
                $avatar = $user->gender == 'M' ? 'avatars/homme.jpg' : 'avatars/femme.jpg';
            Session::put('avatar', $avatar);
            // Log de connexion
            Myhelper::logs(
                Auth::user()->consulat_id,
			    Auth::user()->profile_id,
                $username,
                $user->profile->label ?? '',
                $menus->first()->label,
                'Connecter',
                $avatar
            );
            return response()->json([
                'status' => 1,
                'data' => $page,
            ]);
        } catch (\Exception $e) {
            Log::warning("User::auth - Echec de connexion : {$e->getMessage()}" . json_encode($request->all()));
			return response()->json([
				'status' => 0,
				'message' => "Service indisponible, veuillez réessayer plus tard !",
			]);
        }
    }
    // Déconnexion avec Laravel Auth
    public function logout(Request $request) {
        if (Auth::check()) {
            Myhelper::logs(
                Auth::user()->consulat_id,
			    Auth::user()->profile_id,
                Session::get('username'), 
                Session::get('profil'), 
                Session::get('title'), 
                'Deconnecter',
                Session::get('avatar')
            );
            // Déconnexion avec Laravel Auth
            Auth::logout();
            // Invalidation de la session
            $request->session()->invalidate();
            $request->session()->regenerateToken();
        }
        return redirect('/');
    }
}
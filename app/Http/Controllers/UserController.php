<?php
namespace App\Http\Controllers; 

use Session;
use Myhelper;
use \Carbon\Carbon;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Validation\Rules\Password;
use App\Models\{Document, Logs, Permission, Profile, User};
use Illuminate\Support\Facades\{DB, Hash, Log, Validator, Auth};

class UserController extends Controller
{    
    // Liste des utilisateurs
    public function index(Request $request)
    {
        // User
        try {
            $num = isset($request->num) ? (int) $request->num:1;
            $limit = isset($request->limit) ? (int) $request->limit:10;
            // Récupérer les données
            $query = User::select('users.uid', 'lastname', 'firstname', 'gender', 'number', 'email', DB::raw("'" . Auth::user()->lg . "' as profile"), 'users.status', 'users.created_at')
            ->leftJoin('profiles', 'profiles.id','=','users.profile_id')
            ->where('profile_id', '!=', 1)
            ->where('users.id', '!=', Auth::user()->id)
            ->orderByDesc('users.created_at')
            ->paginate($limit, ['*'], 'page', $num);
            // Vérifier si les données existent
            if ($query->isEmpty()) {
                Log::warning("User::index - Aucun utilisateur trouvé");
                return $this->sendSuccess(__('message.nodata'));
            }
            // Transformer les données
            $data = $query->map(fn($data) => [
                'uid' => $data->uid,
                'lastname' => $data->lastname,
                'firstname' => $data->firstname,
                'gender' => $data->gender,
                'number' => $data->number,
                'email' => $data->email,
                'profile' => $data->profile,
                'status' => match((int)$data->status) {
                    0 => 'Inactif',
                    1 => 'Actif',
                    2 => 'Bloqué'
                },
                'created_at' => Carbon::parse($data->created_at)->format('d/m/Y H:i'),
            ]);
            return $this->sendSuccess(__('message.listuser'), [
                'lists' => $data,
                'total'  => $query->total(),
                'current_page' => $query->currentPage(),
                'last_page' => $query->lastPage(),
            ]);
        } catch(\Exception $e) {
            Log::warning("User::index - Erreur d'affichage de l'utilisateur : ".$e->getMessage());
            return $this->sendError(__('message.error'));
        }
    }
    // Détail d'Utilisateur
    public function show($uid)
    {
        try {
            // Info user connecté
            if ($uid == 'perso') $uid = Auth::user()->uid;
            // Récupérer les données
            $query = User::where('uid', $uid)->first();
            if (!$query) {
                Log::warning("User::show - Aucun utilisateur trouvé pour l'ID : " . $uid);
                return $this->sendSuccess(__('message.nodata'));
            }
            $data = [
                'lastname' => $query->lastname,
                'firstname' => $query->firstname,
                'gender' => $query->gender,
                'whatsapp' => $query->whatsapp,
                'number' => $query->number,
                'email' => $query->email,
                'birthday_at' => Carbon::parse($query->birthday_at)->format('d/m/Y'),
                'birthplace' => $query->birthplace,
                'size' => $query->size,
                'hair' => $query->hair,
                'complexion' => $query->complexion,
                'profession' => $query->profession,
                'prefecture' => $query->prefecture,
                'father_fullname' => $query->father_fullname,
                'mother_fullname' => $query->mother_fullname,
                'person_fullname' => $query->person_fullname,
                'person_number' => $query->person_number,
                'person_address' => $query->person_address,
                'liveci' => $this->months($query->month) . " " . $query->year,
                'stamp' => $query->stamp != null ? env('APP_URL') . '/assets/stamp/' . $query->stamp : '',
                'signature' => $query->signature != null ? env('APP_URL') . '/assets/signature/' . $query->signature : '',
                'status' => match((int)$query->status) {
                    0 => 'Inactif',
                    1 => 'Actif',
                    2 => 'Bloqué'
                },
                'created_at' => Carbon::parse($query->created_at)->format('d/m/Y H:i'),
            ];
            // Profile
            $data['profile'] = '';
            if ($query->profile_id != 0) {
                $profile = Profile::select("Auth::user()->lg as label")
                ->where('id', $query->profile_id)
                ->first();
                $data['profile'] = [
                    'id' => $query->profile_id,
                    'label' => $profile->label,
                ];
            }
            return $this->sendSuccess('Détail sur un Utilisateur.', $data);
        } catch(\Exception $e) {
            Log::warning("User::show - Erreur d'affichage de l'utilisateur : ".$e->getMessage());
            return $this->sendError(__('message.error'));
        }
    }
    // Account creation
    public function store(Request $request)
    {
        // Validator
        $validator = Validator::make($request->all(), [
            'lg' => 'required|in:fr,en',
            'lastname' => 'required',
            'firstname' => 'required',
            'gender' => 'required|in:M,F',
            'whatsapp' => 'required|numeric|unique:users,whatsapp',
            'number' => 'nullable|numeric|unique:users,number',
            'email' => 'nullable|email|unique:users,email',
            'birthday' => 'required|date_format:Y-m-d',
            'birthplace' => 'required',
            'size' => 'required',
            'hair' => 'required',
            'complexion' => 'required',
            'profession' => 'required',
            'prefecture' => 'required',
            'father_fullname' => 'required',
            'mother_fullname' => 'required',
            'person_fullname' => 'required',
            'person_number' => 'required',
            'person_address' => 'required',
            'month' => 'required|integer|min:1|max:12',
            'year' => 'required|year|before_or_equal:'.date('Y'),
            'g_recaptcha_response' => 'required',
        ]);
        //Error field
        if ($validator->fails()) {
            Log::warning("User::store - Validator : " . $validator->errors()->first() . " - " . json_encode($request->all()));
            return $this->sendSuccess('Champs invalides.', $validator->errors()->first(), 422);
        }
        try {
            // Paramètre de Recapcha
            $url = 'https://www.google.com/recaptcha/api/siteverify';
            $data = [
                'remoteip' => $request->ip(),
                'secret' => env('RECAPTCHAV3_SECRET'),
                'response' => $request->input('g_recaptcha_response'),
            ];
            // Initialiser cURL
            $curl = curl_init();
            curl_setopt($curl, CURLOPT_URL, $url);
            curl_setopt($curl, CURLOPT_POST, true);
            curl_setopt($curl, CURLOPT_POSTFIELDS, http_build_query($data));
            curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($curl, CURLOPT_TIMEOUT, 30);
            $result = curl_exec($curl);
            // Vérifier les erreurs cURL
            if (curl_error($curl)) {
                Log::warning("User::store - cURL Error : " . curl_error($curl));
                return $this->sendError(__('message.error'));
            }
            curl_close($curl);
            $resultJson = json_decode($result);
            if ($resultJson->success == false || $resultJson->score < 0.5) {
                Log::warning("User::store - Recaptcha : " . json_encode($resultJson));
                return $this->sendError(__('message.recaptcha'));
            }
            // Formatage du nom et prénoms
            $lastname = mb_strtoupper($request->lastname, 'UTF-8');
            $firstname = mb_convert_case(Str::lower($request->firstname), MB_CASE_TITLE, "UTF-8");
            $set = [
                'lg' => $request->lg,
                'lastname' => $lastname,
                'firstname' => $firstname,
                'gender' => $request->gender,
                'whatsapp' => $request->whatsapp,
                'number' => $request->number,
                'email' => Str::lower($request->email) ?? '',
                'birthday' => $request->birthday,
                'birthplace' => $request->birthplace,
                'size' => $request->size,
                'hair' => $request->hair,
                'complexion' => $request->complexion,
                'profession' => $request->profession,
                'prefecture' => $request->prefecture,
                'father_fullname' => $request->father_fullname,
                'mother_fullname' => $request->mother_fullname,
                'person_fullname' => $request->person_fullname,
                'person_number' => $request->person_number,
                'person_address' => $request->person_address,
                'month' => $request->month,
                'year' => $request->year,
                // 'password_at' => now(),
                // 'password' => Hash::make($request->password),
            ];
            DB::beginTransaction(); // Démarrer une transaction
            try {
                // Création de l'utilisateur
                $user = User::create($set);
                DB::commit(); // Valider la transaction
                // Retourner les données de l'utilisateur
                $data = [
                    'lastname' => $lastname,
                    'firstname' => $firstname,
                    'gender' => $request->gender,
                    'whatsapp' => $request->whatsapp,
                ];
                return $this->sendSuccess('Utilisateur enregistré avec succès.', $data, 201);
            } catch (\Exception $e) {
                DB::rollBack(); // Annuler la transaction en cas d'erreur
                Log::warning("User::store - Erreur : {$e->getMessage()} " . json_encode($request->all()));
                return $this->sendError(__('message.error'));
            }
        } catch (\Exception $e) {
            Log::warning("User::store - Recaptcha : {$e->getMessage()} " . json_encode($request->all()));
            return $this->sendError(__('message.error'));
        }
    }
    // Modification
    public function update(Request $request, $uid)
    {
        // Validator
        $validator = Validator::make($request->all(), [
            'lastname' => 'required',
            'firstname' => 'required',
            'gender' => 'required|in:M,F',
            'whatsapp' => 'required|numeric|unique:users,whatsapp',
            'number' => 'nullable|numeric|unique:users,number',
            'email' => 'nullable|email|unique:users,email',
            'birthday' => 'required|date_format:Y-m-d',
            'birthplace' => 'required',
            'size' => 'required',
            'hair' => 'required',
            'complexion' => 'required',
            'profession' => 'required',
            'prefecture' => 'required',
            'father_fullname' => 'required',
            'mother_fullname' => 'required',
            'person_fullname' => 'required',
            'person_number' => 'required',
            'person_address' => 'required',
            'month' => 'required|integer|min:1|max:12',
            'year' => 'required|year|before_or_equal:'.date('Y'),
            'profile_id' => 'required|min:1',
        ]);
        //Error field
        if ($validator->fails()) {
            Log::warning("User::update - Validator : " . $validator->errors()->first() . " - " . json_encode($request->all()));
            return $this->sendError('Champs invalides.', $validator->errors()->first(), 422);
        }
        // Vérifier si l'ID est présent et valide
        $query = User::where('uid', $uid)->first();
        if (!$query) {
            Log::warning("User::update - Aucun utilisateur trouvé pour l'ID : " . $uid);
            return $this->sendSuccess(__('message.nodata'));
        }
        // Formatage du nom et prénoms
        $lastname = mb_strtoupper($request->lastname, 'UTF-8');
        $firstname = mb_convert_case(Str::lower($request->firstname), MB_CASE_TITLE, "UTF-8");
        // Génération de password
        $alfa = 'abcdefghijklmnpqrstuvwxyzABCDEFGHIJKLMNPQRSTUVWXYZ0123456789';
        $password = substr(str_shuffle($alfa), 0, 10);
        // Formatage des données
        $set = [
            'lastname' => $lastname,
            'firstname' => $firstname,
            'gender' => $request->gender,
            'whatsapp' => $request->whatsapp,
            'number' => $request->number,
            'email' => Str::lower($request->email) ?? '',
            'birthday' => $request->birthday,
            'birthplace' => $request->birthplace,
            'size' => $request->size,
            'hair' => $request->hair,
            'complexion' => $request->complexion,
            'profession' => $request->profession,
            'prefecture' => $request->prefecture,
            'father_fullname' => $request->father_fullname,
            'mother_fullname' => $request->mother_fullname,
            'person_fullname' => $request->person_fullname,
            'person_number' => $request->person_number,
            'person_address' => $request->person_address,
            'month' => $request->month,
            'year' => $request->year,
            'status' => $request->status,
            'profile_id' => $request->profile_id,
        ];
        // Test de modification de status
        $mail = 0;
        if ($query->status != $request->status) {
            switch ($request->status) {
                case 1:
                    $mail = 1;
                    $set['activated_at'] = now();
                    $set['activated_id'] = $user->id;
                    $set['password_at'] = now();
                    $set['password'] = Hash::make($password);
                    $status = __('message.activated');
                    break;
                case 2:
                    $mail = 2;
                    $set['blocked_at'] = now();
                    $set['blocked_id'] = $user->id;
                    $status = __('message.blocked');
                    break;
            }
        }
        DB::beginTransaction(); // Démarrer une transaction
        try {
            // Création de l'utilisateur
            $query->update($set);
            DB::commit(); // Valider la transaction
            // Test send mail
            if ($mail != 0) {
                // Gender
                if ($request->gender == 'M')
                    $gender = __('message.mr');
                else
                    $gender = __('message.mrs');
                //subject
                $subject = __('message.actifaccount');
                $message = "<div style='color:#156082;font-size:11pt;line-height:1.5em;font-family:Century Gothic'>"
                . __('message.dear') . " " . $gender . " " . $request->lastname . ",<br><br>"
                . __('message.stataccount') . "<b>" . $status . "</b>" . "<br><br>";
                // Test send mail
                if ($mail == 1) {
                    $message .= __('message.paraconn') . " !<br>
                    <b>" . __('message.login') . " : </b>" . $email . "/" . $request->number . "<br>
                    <b>" . __('message.password') . " : </b>" . $password . "<br><br>";
                }
                $message .= __('message.bestregard') . " !<br>
                <hr style='color:#156082;'>
                </div>";
                // Envoi de l'email
                $this->sendMail($email, '', $subject, $message);
            }
            // Retourner les données de l'utilisateur
            $data = [
                'lastname' => $lastname,
                'firstname' => $firstname,
                'gender' => $request->gender,
                'whatsapp' => $request->whatsapp,
            ];
            return $this->sendSuccess('Utilisateur modifié avec succès.', $data, 201);
        } catch (\Exception $e) {
            DB::rollBack(); // Annuler la transaction en cas d'erreur
            Log::warning("User::update - Erreur lors de la modification de l'utilisateur : " . $e->getMessage() . " " . json_encode($set));
            return $this->sendError(__('message.error'));
        }
	}
    // Modification
    public function profil(Request $request)
    {
        //Validator
        $validator = Validator::make($request->all(), [
            'lastname' => 'required',
            'firstname' => 'required',
            'gender' => 'required|in:M,F',
            'number' => 'required|unique:users,number,'.$user->id,
            'email' => 'required|unique:users,email,'.$user->id,
            'birthday' => 'required|date_format:Y-m-d',
            'birthplace' => 'required',
            'profession' => 'required',
            'village' => 'required',
            'street_number' => 'required',
            'house_number' => 'required',
            'family_number' => 'required',
            'fullname_person' => 'required',
            'number_person' => 'required',
            'fullname_father' => 'required',
            'fullname_mother' => 'required',
            'residence_person' => 'required',
            'maritalstatus_id' => 'required|min:1',
            'cellule_id' => 'required|min:1',
            'town_id' => 'required|min:1',
        ]);
        //Error field
        if ($validator->fails()) {
            Log::warning("User::profil - Validator : " . $validator->errors()->first() . " - ".json_encode($request->all()));
            return $this->sendSuccess('Champs invalides.', $validator->errors(), 422);
        }
        // Formatage du nom et prénoms
        $email = Str::lower($request->email);
        $lastname = mb_strtoupper($request->lastname, 'UTF-8');
        $firstname = mb_convert_case(Str::lower($request->firstname), MB_CASE_TITLE, "UTF-8");
        // Formatage des données
        $set = [
            'lastname' => $lastname,
            'firstname' => $firstname,
            'gender' => $request->gender,
            'number' => $request->number,
            'email' => $email,
            'birthday' => $request->birthday,
            'birthplace' => $request->birthplace,
            'profession' => $request->profession,
            'village' => $request->village,
            'street_number' => $request->street_number,
            'house_number' => $request->house_number,
            'family_number' => $request->family_number,
            'fullname_person' => $request->fullname_person,
            'number_person' => $request->number_person,
            'fullname_father' => $request->fullname_father,
            'fullname_mother' => $request->fullname_mother,
            'residence_person' => $request->residence_person,
            'maritalstatus_id' => $request->maritalstatus_id,
            'cellule_id' => $request->cellule_id,
            'town_id' => $request->town_id,
        ];
        DB::beginTransaction(); // Démarrer une transaction
        try {
            // Création de l'utilisateur
            User::findOrFail($user->id)->update($set);
            DB::commit(); // Valider la transaction
            return $this->sendSuccess('Profil utilisateur modifié avec succès.', $set, 201);
        } catch (\Exception $e) {
            DB::rollBack(); // Annuler la transaction en cas d'erreur
            Log::warning("User::profil - Erreur lors de la modification de Profil utilisateur : " . $e->getMessage() . " " . json_encode($set));
            return $this->sendError(__('message.error'));
        }
	}
    // Photo de profil
    public function photo(Request $request)
    {
        //Validator
        $validator = Validator::make($request->all(), [
			'photo' => 'required|file|mimes:png,jpeg,jpg|max:2048',
        ]);
        //Error field
        if ($validator->fails()) {
            Log::warning("User::photo - Validator : " . $validator->errors()->first() . " - ".json_encode($request->all()));
            return $this->sendSuccess('Champs invalides.', $validator->errors(), 422);
        }
        // Upload photo
        $dir = 'assets/photos';
        $image = $request->file('photo');
        $ext = $image->getClientOriginalExtension();
        $photo = User::filenameUnique($ext);
        if (!($image->move($dir, $photo))) {
            Log::warning("User::photo - Erreur de téléchargement de la photo : " . $e->getMessage());
            return $this->sendError(__('message.error'));
        }
        try {
            $set = [
                'photo' => $photo,
            ];
            User::findOrFail($user->id)->update($set);
            return $this->sendSuccess('Photo de profil modifiée avec succès.', [], 201);
        } catch(\Exception $e) {
            Log::warning("Photo::store - Erreur de modification de la photo de profil : " . $e->getMessage());
            return $this->sendError(__('message.error'));
        }
    }
    // Connexion
	public function login()
    {
        //Requete Read
        $query = Document::where('status', 1)
        ->orderBy('position')
        ->get();
        return view('login', compact('query'));
	}
    // Authentification avec Laravel Auth
    public function auth(Request $request)
    {
        //Validator
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
            return $validator->errors()->first();
        }
        try {
            // Déterminer si le login est un email ou un numéro de téléphone
            $loginField = filter_var($request->login, FILTER_VALIDATE_EMAIL) ? 'email' : 'whatsapp';
            // Tentative de connexion avec Laravel Auth
            $credentials = [
                $loginField => $request->login,
                'password' => $request->password,
                'status' => 1, // Compte actif
            ];
            // Vérifier d'abord si l'utilisateur existe et son statut
            $user = User::where($loginField, $request->login)->first();
            if (!$user) {
                return '0|Login ou mot de passe incorrect.';
            }
            // Vérifier le statut du compte
            if ($user->status == 0) {
                return '0|Votre compte est inactif.';
            }
            if ($user->status == 2) {
                return '0|Votre compte est bloqué.';
            }
            // Vérifier le statut du profil
            if ($user->profile && $user->profile->status == 0) {
                return '0|Votre profil est désactivé.';
            }
            // Tentative de connexion
            if (Auth::attempt($credentials)) {
                // Connexion réussie
                $user = Auth::user();
                // Mise à jour de la dernière connexion
                $user->update([
                    'login_at' => now(),
                ]);
                // Préparer les données de session
                $prenom = explode(' ', $user->firstname);
                $username = $prenom[0] . ' ' . $user->lastname;
                // Récupération des menus
                $menus = Permission::select('menus.id', 'libelle', 'target', 'icone')
                    ->join('menus', 'menus.id', '=', 'permissions.menu_id')
                    ->where('profile_id', $user->profile_id)
                    ->where('status', 1)
                    ->where('action_id', 1)
                    ->orderBy('position')
                    ->get();
                if ($menus->isEmpty()) {
                    Log::warning("Aucun menu trouvé pour ce profil : " . $user->profile_id);
                    Auth::logout();
                    return '0|Aucun menu trouvé pour ce profil.';
                }
                $page = $menus->first()->target ?? '/';
                // Stocker des informations supplémentaires en session
                Session::put('username', $username);
                Session::put('profil', $user->profile->libelle ?? '');
                Session::put('menus', $menus);
                // Avatar
                if ($user->avatar != '') {
                    $avatar = $user->avatar;
                } else {
                    $avatar = $user->gender == 'M' ? 'avatars/homme.jpg' : 'avatars/femme.jpg';
                }
                Session::put('avatar', $avatar);
                // Log de connexion
                Myhelper::logs($username, $user->profile->libelle ?? '', $menus->first()->libelle, 'Connecter', 'primary', $avatar);
                return '1|' . $page;
            } else {
                // Mot de passe incorrect
                Log::warning("Tentative de connexion échouée pour : {$request->login}");
                return '0|Login ou mot de passe incorrect.';
            }
        } catch (\Exception $e) {
            Log::warning("Echec de connexion : {$e->getMessage()}");
            return "0|Service indisponible, veuillez réessayer plus tard !";
        }
    }
    // Déconnexion avec Laravel Auth
    public function logout(Request $request)
    {
        if (Auth::check()) {
            Myhelper::logs(
                Session::get('username'), 
                Session::get('profil'), 
                Session::get('title'), 
                'Deconnecter', 
                'primary', 
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
    // Middleware pour vérifier les permissions
    public function checkPermission($permission)
    {
        $user = Auth::user();
        if (!$user) return false;
        
        return Permission::where('profile_id', $user->profile_id)
            ->whereHas('menu', function($query) use ($permission) {
                $query->where('libelle', $permission);
            })
            ->exists();
    }
}
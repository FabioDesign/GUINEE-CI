<?php

namespace App\Http\Controllers;

use Myhelper;
use Illuminate\Http\Request;
use App\Models\{Document, User};
use Illuminate\Validation\Rules\Password;
use Illuminate\Support\Facades\{Hash, Log, Validator};

class PasswordController extends Controller
{
    // Connexion
	public function index()
    {
        //Requete Read
        $query = Document::where('status', 1)
        ->orderBy('position')
        ->get();
        return view('forgotpass', compact('query'));
	}
	//Logic Forgot password
	public function store(request $request)
    {
		//Validator
		$validator = Validator::make($request->all(), [
        	'email' => 'required|email',
	    ], [
        	'email.*' => "0|Adresse e-mail non valide.",
	    ]);
        // Error field
        if ($validator->fails()) {
            Log::warning("Forgotpass::store - Validator : {$validator->errors()->first()} - {$request->email}");
          return $validator->errors()->first();
        }
		//Requete Read
		$user = User::join('profiles', 'profiles.id', '=', 'users.profile_id')
		->where([
			'users.status' => 1,
			'email' => $request->email
		])
		->first();
		if ($user) {
			$prenom = explode(' ', $user->firstname);
			$username = $prenom[0].' '.$user->lastname;
			//Requete Read
			$password = Myhelper::generate();
			$subject = "Nouveau Mot de passe";
			$gender = $user->gender == 'M' ? 'Cher':'Chère';
			$content = "{$gender} {$username},<br/>
			Votre nouveau mot de passe est : <strong>{$password}</strong><br/><br/>
			Cordialement<br/>
			L'équipe Ambassade de Guinée - CI<br>
			27 01 02 03 04<br>
			ambagui-ci@yopomail.com";
			Myhelper::sendMail($user->email, '', $subject, $content);
			//Update passwd_change_code
			$user->update([
				'password_at' => now(),
				'password' => Hash::make($password),
			]);
            if ($user->avatar != '')
                $avatar = 'storage/media/avatar/' . $user->avatar;
            else
                $avatar = $user->gender == 'M' ? 'assets/img/homme.jpg' : 'assets/img/femme.jpg';
			Myhelper::logs($username, $user->libelle, 'Mot de passe oublié', 'Modifier', 'warning', $avatar);
		    return "1|Mot de passe envoyé par mail avec succès.";
		} else {
            Log::warning("Forgotpass::store - Adresse e-mail non trouvée : {$request->email}");
		    return "0|Adresse e-mail non trouvée.";
        }
	}
    //Modification de Mot de passe
    /**
    * @OA\Post(
    *   path="/api/password/editpass",
    *   tags={"Password"},
    *   operationId="editpass",
    *   description="Modification de Mot de passe",
    *   security={{"bearer":{}}},
    *   @OA\RequestBody(
    *      required=true,
    *      @OA\JsonContent(
    *         required={"oldpass", "password", "password_confirmation"},
    *         @OA\Property(property="oldpass", type="string", format="password"),
    *         @OA\Property(property="password", type="string", format="password"),
    *         @OA\Property(property="password_confirmation", type="string", format="password")
    *      )
    *   ),
    *   @OA\Response(response=200, description="Mot de passe modifié avec succès."),
    *   @OA\Response(response=400, description="Serveur indisponible."),
    *   @OA\Response(response=404, description="Page introuvable.")
    * )
    */
    public function editpass(Request $request){
        //User
        $user = Auth::user();
		App::setLocale($user->lg);
        //Data
        Log::notice("ID Utilisateur : {$user->id} - Requête : " . json_encode($request->all()));
        //Validator
        $validator = Validator::make($request->all(), [
            'oldpass' => 'required|min:8',
            'password' => [
                'required', 'confirmed', 'different:oldpass',
                Password::min(8)
                    ->mixedCase() // Majuscules + minuscules
                    ->letters()   // Doit contenir des lettres
                    ->numbers()   // Doit contenir des chiffres
                    ->symbols()   // Doit contenir des caractères spéciaux
            ],
        ]);
        //Error field
        if($validator->fails()){
            Log::warning("Validator password edit : " . json_encode($request->all()));
            return $this->sendSuccess('Champs invalides.', $validator->errors(), 422);
        }
        // Vérification de l'ancien mot de passe
        if (!Hash::check($request->oldpass, $user->password)) {
            Log::warning("Ancien mot de passe incorrect pour l'utilisateur ID : {$user->id}");
            return $this->sendError("Ancien mot de passe incorrect.");
        }
        try {
            // Mettre à jour du password
            User::findOrFail($user->id)->update([
                'password_at' => now(),
                'password' => Hash::make($request->password),
            ]);
            return $this->sendSuccess("Mot de passe modifié avec succès.", [], 201);
        } catch(\Exception $e) {
            Log::warning("Erreur lors de la mise à jour du mot de passe : " . $e->getMessage());
            return $this->sendError("Une erreur est survenue, veuillez réessayer plus tard.");
        }
    }
}

<?php

namespace App\Http\Controllers;

use Session;
use Myhelper;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\{Menu, Permission};
use Illuminate\Support\Facades\{Log, Validator};

class MenuController extends Controller
{
	public function index()
	{
    	if (Session::has('idUsr')) {
			//Title
			$title = 'Gestion des menus';
			//Menu
			$currentMenu = 'menus';
			$actionIds = Myhelper::actions(Session::get('idPro'), 6);
			$addmodal = in_array(2, $actionIds) ? '<a href="#" class="btn btn-sm btn-primary modalform" data-h="0|menuForm|" submitbtn="Valider">Ajouter un menu</a>':'';
			//Requete Read
			$query = Menu::all();
			return view('pages.menus', compact('title', 'currentMenu', 'addmodal', 'actionIds', 'query'));
	    } else return redirect('/');
	}
	//Liste des Adresses Facturactions
	public function lists(request $request){
		if(Session::has('idUsr')){
			//Requete Read
			$query = BillAddr::select('id', 'libelle')
			->whereClientId($request->id)
			->orderBy('libelle')
			->get();
			$return = [];
			foreach($query as $data):
				$return[$data->id] = $data->libelle;
			endforeach;
			return $return;
		}else return 'x';
	}
	//Formulaire Adresse Facturaction
	public function forms(request $request){
    	if(Session::has('idUsr')){
			$id = $request->id;
			if($id != 0){
				//Requete Read
				$query = BillAddr::whereId($id)->first();
				$content = $query->content;
				$libelle = $query->libelle;
				$client_id = $query->client_id;
			}else $libelle = $client_id = $content = '';
			//Requete Read
			$sqlclt = Client::whereStatus('1')
			->orderBy('libelle')
			->get();
			//Page de la vue
			return view('modals.billaddr', compact('id', 'libelle', 'content', 'client_id', 'sqlclt'));
	    }else return 'x';
	}
	//Add/Mod Adresse Facturaction
	public function create(request $request){
    	if(Session::has('idUsr')){
			$Ok = 0;
			$msg = "Service indisponible, veuillez réessayer plus tard !";
			//Validator
			$validator = Validator::make($request->all(), [
				'content' => 'required',
				'libelle' => 'required',
				'client_id' => 'bail|required|integer|gt:0',
			], [
				'content.required' => "Adresse Facturaction obligatoire.",
				'libelle.required' => "Nom obligatoire.",
				'client_id.required' => "Client obligatoire.",
				'client_id.gt' => "Client non valide.",
			]);
			//Error field
			if($validator->fails()){
				$errors = $validator->errors();
				Log::warning("Adresse Facturaction : ".serialize($request->post()));
				if($errors->has('content')) return $Ok.'|'.$errors->first('content');
				if($errors->has('libelle')) return $Ok.'|'.$errors->first('libelle');
				if($errors->has('client_id')) return $Ok.'|'.$errors->first('client_id');
			}
			$id = $request->id;
			//Test Number
			$libelle = Str::upper(Myhelper::valideString($request->libelle));
			if($id == 0) $count = BillAddr::whereLibelle($libelle)->count();
			else $count = BillAddr::where([
				['id', '!=', $id],
				['libelle', $libelle],
			])->count();
			if($count == 0){
				$set = [
					'libelle' => $libelle,
					'content' => $request->content,
					'client_id' => $request->client_id,
				];
				try{
					if($id == 0){
						$set['status'] = '1';
						$set['user_id'] = Session::get('idUsr');
						BillAddr::create($set);
						$msg = 'Adresse Facturaction enregistrée avec succès.';
						$type = 'Ajouter';
						$color = 'success';
					}else{
						BillAddr::findOrFail($id)->update($set);
						$msg = 'Adresse Facturaction modifiée avec succès.';
						$type = 'Modifier';
						$color = 'warning';
					}
					Myhelper::logs(Session::get('username'), Session::get('profil'), 'Adresse Facturaction: '.$libelle, $type, $color, Session::get('avatar'));
					Log::info($type.' Adresse Facturaction : '.serialize($request->post()));
					$Ok = 1;
				}catch(\Exception $e){
					Log::warning("Adresse Facturaction : ".serialize($request->post()));
					Log::warning("Adresse Facturaction : ".$e->getMessage());
				}
			}else{
				$msg = "Nom déjà utilisé";
				Log::warning("Adresse Facturaction : ".$libelle." : ".$msg);
			}
			return $Ok.'|'.$msg;
	    }else return 'x';
	}
}

<?php

namespace App\Http\Controllers;

use Session;
use Myhelper;
use App\Models\Logs;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class LogsController extends Controller
{
    //Liste de Pistes d'audit
	public function index(request $request){
    	if(Session::has('idUsr')){
			//Title
			$title = "Pistes d'audit";
			//Breadcrumb
			$breadcrumb = "Pistes d'audit";
			//Menu
			$currentMenu = 'logs';
			//Submenu
			$currentSubMenu = '';
			//Modal
			$addmodal = '';
			//Data Post
			if($request->has('show')){
				$date = $request->date;
				Session::put('date', $date);
				return redirect('/logs');
			}else $date = date('d-m-Y');
			if(Session::has('date')) $date = Session::get('date');
			$created_at = Myhelper::formatDateEn($date);
			//Requete Read
			$query = Logs::where('created_at', 'LIKE', $created_at.'%')
			->orderByDesc('created_at')
			->get();
			return view('pages.logs', compact('title', 'breadcrumb', 'currentMenu', 'currentSubMenu', 'addmodal', 'date', 'query'));
	    }else{
	        return redirect('/');
	    }
	}
}

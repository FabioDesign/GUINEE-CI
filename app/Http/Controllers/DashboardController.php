<?php

namespace App\Http\Controllers;

use Session;
use Myhelper;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\{Auth};

class DashboardController extends Controller
{
	//Tableau de bord
  	public function index(request $request)
	{
        if (!Auth::check()) {
            return redirect('/');
        }
		// Title
		$title = 'Tableau de bord';
		// Menu
		$currentMenu = 'dashboard';
		// Modal
		$addmodal = '';
		Myhelper::logs(
			Session::get('username'),
			Session::get('profil'),
			"Tableau de bord: Liste",
			'Consulter',
			Session::get('avatar')
		);
		return view('pages.dashboard', compact('title', 'currentMenu', 'addmodal'));
  	}
}

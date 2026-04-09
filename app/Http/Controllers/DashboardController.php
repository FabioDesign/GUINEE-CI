<?php

namespace App\Http\Controllers;

use Session;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
	//Tableau de bord
  	public function index(request $request)
	{
		if (Session::has('idUsr')) {
			// Title
			$title = 'Tableau de bord';
			// Menu
			$currentMenu = 'dashboard';
			// Modal
			$addmodal = '';
			return view('pages.dashboard', compact('title', 'currentMenu', 'addmodal'));
		} else return redirect('/');
  	}
}

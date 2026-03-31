<?php

namespace App\Http\Controllers;

use Session;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DashboardController extends Controller
{
	//Tableau de bord
  	public function index(request $request)
	{
		if (Session::has('idUsr')) {
			//Title
			$title = 'Tableau de bord';
			//Breadcrumb
			$breadcrumb = 'Tableau de bord';
			//Menu
			$currentMenu = 'dashboard';
			return view('pages.dashboard', compact('title', 'breadcrumb', 'currentMenu'));
		} else return redirect('/');
  	}
}

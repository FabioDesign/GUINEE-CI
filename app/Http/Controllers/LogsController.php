<?php

namespace App\Http\Controllers;

use App\Models\Logs;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\{Auth};

class LogsController extends Controller
{
    //Liste de Pistes d'audit
	public function index() {
        if (!Auth::check()) {
            return redirect('/');
        }
		// Title
		$title = "Pistes d'audit";
		// Menu
		$currentMenu = "logs";
		// Modal
		$addmodal = '';
		//Requete Read
		$query = Logs::orderByDesc('created_at')->get();
		return view('pages.logs', compact('title', 'currentMenu', 'addmodal', 'query'));
	}
}

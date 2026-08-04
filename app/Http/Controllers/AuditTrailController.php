<?php

namespace App\Http\Controllers;

use App\Models\AuditTrail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\{Auth};

class AuditTrailController extends Controller
{
    //Liste de Pistes d'audit
	public function index() {
        if (!Auth::check()) {
            return redirect('/');
        }
		// Title
		$title = "Pistes d'audit";
		// Menu
		$currentMenu = "audit_trails";
		// Modal
		$addmodal = '';
		return view('pages.audit_trails', compact('title', 'currentMenu', 'addmodal'));
	}
    //Liste de Pistes d'audit
	public function getAuditTrails() {
		//Requete Read-
		$query = AuditTrail::where('consulat_id', Auth::user()->consulat_id)
		->orderByDesc('created_at')
		->get();
		return response()->json([
			'status' => 1,
			'data' => $query,
		]);
	}
}

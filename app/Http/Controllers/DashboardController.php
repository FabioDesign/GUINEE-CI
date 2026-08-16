<?php

namespace App\Http\Controllers;

use Session;
use Myhelper;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\{Auth, DB};
use App\Models\{AnnualStat, Demand, MonthlyStat};

class DashboardController extends Controller
{
	//Tableau de bord
  	public function index(request $request) {
        if (!Auth::check()) {
            return redirect('/');
        }
		// Title
		$title = 'Tableau de bord';
		// Menu
		$currentMenu = 'dashboard';
		// Requête Read
		$years = AnnualStat::select('years')
		->where('consulat_id', Auth::user()->consulat_id)
		->orderBy('years', 'desc')
		->distinct()
		->get();
		// Documents
		$documents = Demand::select('document_id')
		->join('documents', 'documents.id', '=', 'demands.document_id')
		->where('consulat_id', Auth::user()->consulat_id)
		->where('demands.status', 2)
		->orderBy('documents.label')
		->distinct()
		->get();
		// Modal
		$addmodal = '';
		Myhelper::auditTrail(
			Auth::user()->consulat_id,
			Auth::user()->profile_id,
			Session::get('username'),
			Session::get('profil'),
			"Tableau de bord: Liste",
			'Consulter',
			Session::get('avatar')
		);
		return view('pages.dashboard', compact('title', 'currentMenu', 'addmodal', 'years', 'documents'));
  	}
	// Stats du tableau de bord
	public function stats(request $request) {
		// dd($request->all());
        if (!Auth::check()) {
            return 'x';
        }
		//Requete Read
		$query = DB::select("CALL sp_get_stats_data(?, ?, ?, ?, ?)",
		[
			Session::get('consulat'),
			$request->documents,
			$request->years,
			$request->months,
			$request->days
		]);
		$data = [
			'amount' => $query[0]->amount,
			'paid' => $query[0]->paid,
			'free' => $query[0]->free,
			'recover' => $query[0]->recover,
		];
		return response()->json([
			'status' => 1,
			'data' => $data,
		]);
	}
	// Get months
	public function listMonths(request $request) {
        if (!Auth::check()) {
            return 'x';
        }
		$months = MonthlyStat::select('months')
		->where('consulat_id', Auth::user()->consulat_id)
		->when($request->documents, function ($query, $documents) {
			return $query->whereIn('document_id', $documents);
		})
		->where('years', $request->years)
		->orderBy('months')
		->distinct()
		->get();
		return response()->json([
			'status' => 1,
			'data' => $months,
		]);
	}
	// Get days
	public function listDays(request $request) {
		if (!Auth::check()) {
			return 'x';
		}
		$month = str_pad($request->months, 2, '0', STR_PAD_LEFT);
		$days = Demand::select('validated_at')
		->where('consulat_id', Auth::user()->consulat_id)
		->when($request->documents, function ($query, $documents) {
			return $query->whereIn('document_id', $documents);
		})
		->where('validated_at', 'like', $request->years . '-' . $month . '%')
		->where('status', 2)
		->orderBy('validated_at')
		->distinct()
		->get();
		dd($days);
		return response()->json([
			'status' => 1,
			'data' => $days,
		]);
	}
	// Liste des documents
	public function listDocs() {
		// Requete Read
		$data = Document::where('status', 1)
		->orderBy('label')
		->pluck('label');
		return response()->json([
			'status' => 1,
			'data' => $data,
		]);
	}
}

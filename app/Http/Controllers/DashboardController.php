<?php

namespace App\Http\Controllers;

use Session;
use Myhelper;
use Illuminate\Http\Request;
use App\Models\{AnnualStat, Demand, MonthlyStat};
use Illuminate\Support\Facades\{Auth, DB, Log, Validator, QueryException};

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
        //Validator
        $validator = Validator::make($request->all(), [
            'start_date' => 'required|date|date_format:Y-m-d',
            'end_date' => 'required|date|date_format:Y-m-d|after_or_equal:start_date',
        ], [
            'start_date.required' => "La date de début est obligatoire.",
            'start_date.date' => "La date de début doit être une date valide.",
            'start_date.date_format' => "La date de début doit être au format YYYY-MM-DD.",
            'end_date.required' => "La date de fin est obligatoire.",
            'end_date.date' => "La date de fin doit être une date valide.",
            'end_date.date_format' => "La date de fin doit être au format YYYY-MM-DD.",
            'end_date.after_or_equal' => "La date de fin doit être après la date de début ou égale à la date de début.",
        ]);
        //Error field
        if ($validator->fails()) {
            Log::warning("Dashboard::stats - Validator : {$validator->errors()->first()} - " . json_encode($request->all()));
            return response()->json([
                'status' => 0,
                'message' => $validator->errors()->first(),
            ]);
        }
		try {
			//Requete Read
			$query = DB::select("CALL sp_get_stats_data(?, ?, ?, ?)",
			[
				Auth::user()->consulat_id,
				$request->documents,
				$request->start_date,
				$request->end_date,
			]);
			$data = [
				'amount' => $query[0]->amount,
				'paid' => $query[0]->paid,
				'free' => $query[0]->free,
				'created' => $query[0]->created,
				'transmitted' => $query[0]->transmitted,
				'validated' => $query[0]->validated,
				'rejected' => $query[0]->rejected,
				'recovered' => $query[0]->recovered,
			];
			return response()->json([
				'status' => 1,
				'data' => $data,
			]);
		} catch (QueryException $e) {
			$message = $e->errorInfo[2] ?? 'Une erreur SQL est survenue.';
			Log::warning("Dashboard::stats - QueryException : {$e->errorInfo[2]} - " . json_encode($request->all()));
			return response()->json([
				'status'  => 0,
				'message' => $message,
			], 422);
		}
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

		$days = Demand::selectRaw('DATE(validated_at) as day_date')
		->where('consulat_id', Auth::user()->consulat_id)
		->when($request->documents, function ($query, $documents) {
			return $query->whereIn('document_id', $documents);
		})
		->where('validated_at', 'like', $request->years . '-' . $month . '%')
		->where('status', 2)
		->orderBy('validated_at')
		->distinct()
		->get()
		->map(function ($item) {
			$date = \Carbon\Carbon::parse($item->day_date)->locale('fr');
			return [
				'day_date'  => $date->format('j'),                               // 15
				'label' => ucfirst($date->isoFormat('dddd D')),              // Samedi 15
			];
		});

		return response()->json([
			'status' => 1,
			'data'   => $days,
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

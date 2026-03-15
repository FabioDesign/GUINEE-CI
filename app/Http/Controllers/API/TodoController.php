<?php

namespace App\Http\Controllers\API;

use App\Models\Todo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;

class TodoController extends Controller
{
  //Afficher les todos
  public function index() {
    try {
      //Requete Read
      $query = Todo::select('id', 'task', 'done', 'created_at')
      ->orderBy('task')
      ->get();
      $response = [
        'status' => 200,
        'message' => 'Liste des todos.',
        'data' => $query,
      ];
      return response()->json($response, 200);
    } catch(\Exception $e) {
      Log::warning("Todo::index : " . $e->getMessage());
      $response = [
        'status' => 401,
        'message' => "Service indisponible, veuillez réessayer plus tard !",
        'data' => [],
      ];
      return response()->json($response, 401);
    }
  }
  //Inscription
  public function store(request $request) {
    //Data
    $set = [
      'task' => $request->task,
      'done' => $request->done,
    ];
    try {
      Todo::create($set);
      $response = [
        'status' => 200,
        'message' => "Todo ajouté avec succès.",
        'data' => $set,
      ];
      return response()->json($response, 200);
    } catch(\Exception $e) {
      Log::warning("Todo::create : " . $e->getMessage() . " => " . json_encode($set));
      $response = [
        'status' => 401,
        'message' => "Erreur enregistrement d'un Todo.",
        'data' => [],
      ];
      return response()->json($response, 401);
    }
  }
  //Modification
  public function update(request $request, $id) {
    try {
      //Data 
      $set = [
        'done' => $request->done,
      ];
      //Activation
      Todo::findOrFail($id)->update($set);
      $response = [
        'status' => 200,
        'message' => "Todo modifié avec succès.",
        'data' => [],
      ];
      return response()->json($response, 200);
    } catch(\Exception $e) {
      Log::warning("Todo::update : " . $e->getMessage());
      $response = [
        'status' => 401,
        'message' => "Service indisponible, veuillez réessayer plus tard !",
        'data' => [],
      ];
      return response()->json($response, 401);
    }
  }
  // Suppression
  public function destroy($id) {
    try {
      //Requete Read
      $query = Todo::whereId($id)->first();
      if (!$query) {
        Log::warning("Todo::destroy - L'ID n'existe pas : " . $id);
        $response = [
          'status' => 401,
          'message' => "L'ID n'existe pas !",
          'data' => [],
        ];
        return response()->json($response, 403);
      }
      // Suppression
      $deleted = Todo::destroy($id);
      if (!$deleted) {
        Log::warning("Todo::destroy - Tentative de suppression de Todo : " . $uid);
        return $this->sendError("Impossible de supprimer Todo.", [], 403);
        $response = [
          'status' => 401,
          'message' => 'Impossible de supprimer Todo',
          'data' => [],
        ];
        return response()->json($response, 403);
      }
        $response = [
          'status' => 200,
          'message' => 'Todo supprimé avec succès',
          'data' => [],
        ];
        return response()->json($response, 200);
    } catch(\Exception $e) {
      Log::warning("Todo::delete - Erreur lors de la suppression de Todo : " . $e->getMessage());
      $response = [
        'status' => 401,
        'message' => "Erreur lors de la suppression de Todo !",
        'data' => [],
      ];
      return response()->json($response, 401);
    }
  }
}

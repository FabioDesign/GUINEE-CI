<?php

namespace App\Http\Controllers\API;

use \Carbon\Carbon;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\{Document, File, Period, Requestdoc};
use Illuminate\Support\Facades\{App, Auth, DB, Log, Validator};

class DocumentController extends Controller
{
    //Liste des documents
    /**
    * @OA\Get(
    *   path="/api/documents",
    *   tags={"Documents"},
    *   operationId="listDocument",
    *   description="Liste des documents",
    *   security={{"bearer":{}}},
    *   @OA\Response(response=200, description="Liste des documents."),
    *   @OA\Response(response=400, description="Serveur indisponible."),
    *   @OA\Response(response=404, description="Page introuvable.")
    * )
    */
    public function index(): JsonResponse {
        //User
        $user = Auth::user();
		App::setLocale($user->lg);
        try {
            // Code to list documents
            $query = Document::select('uid', 'code', 'documents.' . "$user->lg as label", 'amount', 'number', 'description_' . $user->lg . ' as description', 'periods.' . $user->lg . ' as period', 'status', 'created_at')
            ->join('periods', 'periods.id','=','documents.period_id')
            ->orderByDesc('created_at')
            ->get();
            // Vérifier si les données existent
            if ($query->isEmpty()) {
                Log::warning("Document::index - Aucun document trouvé.");
                return $this->sendSuccess(__('message.nodata'));
            }
            // Transformer les données
            $data = $query->map(fn($data) => [
                'uid' => $data->uid,
                'code' => $data->code,
                'label' => $data->label,
                'amount' => $data->amount,
                'number' => $data->number,
                'period' => $data->period,
                'description' => $data->description,
                'status' => $data->status ? 'Activé':'Désactivé',
                'date' => Carbon::parse($data->created_at)->format('d/m/Y H:i'),
            ]);
            return $this->sendSuccess("Liste des documents.", $data);
        } catch (\Exception $e) {
            Log::warning("Document::index - Erreur lors de la récupération des documents: " . $e->getMessage());
            return $this->sendError("Erreur lors de la récupération des documents.");
        }
    }
    //Détail d'un document
    /**
    * @OA\Get(
    *   path="/api/documents/{uid}",
    *   tags={"Documents"},
    *   operationId="showDocument",
    *   description="Détail d'un document",
    *   security={{"bearer":{}}},
    *   @OA\Response(response=200, description="Détail d'un document."),
    *   @OA\Response(response=400, description="Serveur indisponible."),
    *   @OA\Response(response=404, description="Page introuvable.")
    * )
    */
    public function show($uid): JsonResponse {
        //User
        $user = Auth::user();
        App::setLocale($user->lg);
        
        // Vérifier si l'ID est présent et valide
        $document = Document::select('id', 'code', "$user->lg as label", 'amount', 'number', 'period_id', 'description_' . $user->lg . ' as description', 'status')
        ->where('uid', $uid)
        ->first();
            
        if (!$document) {
            Log::warning("Document::show - Aucun document trouvé pour l'ID : " . $uid);
            return $this->sendSuccess(__('message.nodata'));
        }
    
        // Periodes
        $period = Period::select('id', "$user->lg as label")
        ->where('id', $document->period_id)
        ->first();
        try {
            // Charger les fichiers avec eager loading et les transformer directement
            $documentWithFiles = Document::with(['files.requestdoc'])->find($document->id);
            
            $docs = $documentWithFiles->files
            ->map(function ($file) use ($user) {
                return [
                    'uid' => $file->requestdoc->uid,
                    'label' => $file->requestdoc->{$user->lg} ?? $file->requestdoc->label, // Adaptez selon votre structure
                    'required' => $file->required,
                    'status' => $file->status,
                ];
            })
            ->sortBy([['label', 'asc'], ['required', 'asc'], ['status', 'asc']])
            ->values()
            ->all();
            
            // Retourner les détails du document avec les files
            return $this->sendSuccess('Détails sur le document', [
                'code' => $document->code,
                'label' => $document->label,
                'amount' => $document->amount,
                'number' => $document->number,
                'description' => $document->description,
                'status' => $document->status ? 'Activé' : 'Désactivé',
                'periods' => [
                    'id' => $period->id,
                    'label' => $period->label,
                ],
                'docs' => $docs,
            ]);
        } catch(\Exception $e) {
            Log::warning("Document::show - Erreur d'affichage d'un document : ".$e->getMessage());
            return $this->sendError("Erreur d'affichage d'un document");
        }
    }
    //Enregistrement
    /**
    * @OA\Post(
    *   path="/api/documents",
    *   tags={"Documents"},
    *   operationId="storeDocs",
    *   description="Enregistrement d'un document",
    *   security={{"bearer":{}}},
    *   @OA\RequestBody(
    *      required=true,
    *      @OA\JsonContent(
    *         required={"code", "en", "fr", "description_en", "description_fr", "docs"},
    *         @OA\Property(property="code", type="string"),
    *         @OA\Property(property="en", type="string"),
    *         @OA\Property(property="fr", type="string"),
    *         @OA\Property(property="amount", type="string"),
    *         @OA\Property(property="number", type="string"),
    *         @OA\Property(property="period_id", type="integer"),
    *         @OA\Property(property="description_en", type="string"),
    *         @OA\Property(property="description_fr", type="string"),
    *         @OA\Property(property="docs", type="array", @OA\Items(
    *               @OA\Property(property="requestdoc_id", type="integer"),
    *               @OA\Property(property="required", type="integer"),
    *               example="[1|1, 2|1, 3|0]"
    *           )
    *         ),
    *      )
    *   ),
    *   @OA\Response(response=200, description="Document enregisté avec succès."),
    *   @OA\Response(response=400, description="Serveur indisponible."),
    *   @OA\Response(response=404, description="Page introuvable.")
    * )
    */
    public function store(Request $request): JsonResponse {
        //User
        $user = Auth::user();
		App::setLocale($user->lg);
        //Data
        Log::notice("Document::store - ID User : {$user->id} - Requête : " . json_encode($request->all()));
        //Validator
        $validator = Validator::make($request->all(), [
            'code' => 'required|string|max:5|unique:documents,code',
            'en' => 'required|string|max:255|unique:documents,en',
            'fr' => 'required|string|max:255|unique:documents,fr',
            'amount' => 'present',
            'number' => 'present',
            'period_id' => 'present',
            'description_en' => 'required',
            'description_fr' => 'required',
            'docs' => 'required|array',
        ]);
        //Error field
        if($validator->fails()){
            Log::warning("Document::store - Validator : " . $validator->errors()->first() . " - ".json_encode($request->all()));
            return $this->sendError('Champs invalides.', $validator->errors(), 422);
        }
        // Création de la reclamation
        $set = [
            'status' => 1,
            'en' => $request->en,
            'fr' => $request->fr,
            'code' => $request->code,
            'created_user' => $user->id,
            'amount' => $request->amount ?? '',
            'number' => $request->number ?? '',
            'period_id' => $request->period_id ?? 0,
            'description_en' => $request->description_en,
            'description_fr' => $request->description_fr,
        ];
        DB::beginTransaction(); // Démarrer une transaction
        try {
            $document = Document::create($set);
            // Valider la transaction
            DB::commit();
            // Si des fichiers sont fournies, les associer au document
            if ($request->has('docs') && is_array($request->docs)) {
                foreach ($request->docs as $docs) {
                    $file = Str::of($docs)->explode('|');
                    $requestdoc = Requestdoc::where('uid', $file[0])->first();
                    // Enregistrer le fichier
                    File::firstOrCreate([
                        'requestdoc_id' => $requestdoc->id,
                        'document_id' => $document->id,
                        'required' => $file[1],
                    ]);
                }
            }
            return $this->sendSuccess("Document enregistré avec succès.", [
                'code' => $request->code,
                'en' => $request->en,
                'fr' => $request->fr,
            ], 201);
        } catch (\Exception $e) {
            DB::rollBack(); // Annuler la transaction en cas d'erreur
            Log::warning("Document::store : " . $e->getMessage() . " " . json_encode($set));
            return $this->sendError("Erreur lors de l'enregistrement du document.");
        }
    }
    // Modification
    /**
    * @OA\Put(
    *   path="/api/documents/{uid}",
    *   tags={"Documents"},
    *   operationId="editDocs",
    *   description="Modification d'un document",
    *   security={{"bearer":{}}},
    *   @OA\RequestBody(
    *      required=true,
    *      @OA\JsonContent(
    *         required={"code", "en", "fr", "description_en", "description_fr", "docs", "status"},
    *         @OA\Property(property="code", type="string"),
    *         @OA\Property(property="en", type="string"),
    *         @OA\Property(property="fr", type="string"),
    *         @OA\Property(property="amount", type="string"),
    *         @OA\Property(property="number", type="string"),
    *         @OA\Property(property="period_id", type="integer"),
    *         @OA\Property(property="description_en", type="string"),
    *         @OA\Property(property="description_fr", type="string"),
    *         @OA\Property(property="status", type="integer"),
    *         @OA\Property(property="docs", type="array", @OA\Items(
    *               @OA\Property(property="requestdoc_id", type="integer"),
    *               @OA\Property(property="required", type="integer"),
    *               example="[1|1, 2|1, 3|0]"
    *           )
    *         ),
    *      )
    *   ),
    *   @OA\Response(response=200, description="Document modifié avec succès."),
    *   @OA\Response(response=400, description="Serveur indisponible."),
    *   @OA\Response(response=404, description="Page introuvable.")
    * )
    */
    public function update(request $request, $uid): JsonResponse {
        //User
        $user = Auth::user();
		App::setLocale($user->lg);
        //Data
        Log::notice("Document::update - ID User : {$user->id} - Requête : " . json_encode($request->all()));
        //Validator
        $validator = Validator::make($request->all(), [
            'code' => 'required|string|max:5|unique:documents,code,' . $uid . ',uid',
            'en' => 'required|string|max:255|unique:documents,en,' . $uid . ',uid',
            'fr' => 'required|string|max:255|unique:documents,fr,' . $uid . ',uid',
            'amount' => 'present',
            'number' => 'present',
            'period_id' => 'present',
            'description_en' => 'required',
            'description_fr' => 'required',
            'docs' => 'required|array',
            'status' => 'required|integer|in:0,1',
        ]);
        //Error field
        if($validator->fails()){
            Log::warning("Document::update - Validator : " . $validator->errors()->first() . " - ".json_encode($request->all()));
            return $this->sendError('Champs invalides.', $validator->errors(), 422);
        }
        // Vérifier si l'ID est présent et valide
        $document = Document::where('uid', $uid)->first();
        if (!$document) {
            Log::warning("Document::update - Aucun document trouvé pour l'ID : " . $uid);
            return $this->sendSuccess(__('message.nodata'));
        }
        // Création de la reclamation
        $set = [
            'en' => $request->en,
            'fr' => $request->fr,
            'code' => $request->code,
            'updated_user' => $user->id,
            'status' => $request->status,
            'amount' => $request->amount ?? '',
            'number' => $request->number ?? '',
            'period_id' => $request->period_id ?? 0,
            'description_en' => $request->description_en,
            'description_fr' => $request->description_fr,
        ];
        DB::beginTransaction(); // Démarrer une transaction
        try {
            $document->update($set);
            // Valider la transaction
            DB::commit();
            // Si des fichiers sont fournies, les associer au profil
            if ($request->has('docs') && is_array($request->docs)) {
                // Supprimer les fichiers existantes pour ce document
                File::where('document_id', $document->id)->delete();
                foreach ($request->docs as $docs) {
                    $file = Str::of($docs)->explode('|');
                    $requestdoc = Requestdoc::where('uid', $file[0])->first();
                    // Enregistrer le fichier
                    File::firstOrCreate([
                        'requestdoc_id' => $requestdoc->id,
                        'document_id' => $document->id,
                        'required' => $file[1],
                    ]);
                }
            }
            return $this->sendSuccess("Document modifié avec succès.", [
                'code' => $request->code,
                'en' => $request->en,
                'fr' => $request->fr,
            ], 201);
        } catch (\Exception $e) {
            DB::rollBack(); // Annuler la transaction en cas d'erreur
            Log::warning("Document::update : " . $e->getMessage() . " " . json_encode($set));
            return $this->sendError("Erreur lors de l'enregistrement du document.");
        }
	}
    // Suppression d'un document
    /**
    *   @OA\Delete(
    *   path="/api/documents/{uid}",
    *   tags={"Documents"},
    *   operationId="deleteDocs",
    *   description="Suppression d'un document",
    *   security={{"bearer":{}}},
    *   @OA\Response(response=200, description="Document supprimé avec succès."),
    *   @OA\Response(response=400, description="Serveur indisponible."),
    *   @OA\Response(response=404, description="Page introuvable.")
    * )
    */
    public function destroy($uid): JsonResponse {
        //User
        $user = Auth::user();
		App::setLocale($user->lg);
        //Data
        Log::notice("Document::destroy - ID User : {$user->id} - Requête : " . $uid);
        try {
            // Vérification si le document est attribué à une demande
            $document = Document::select('documents.id', 'document_id')
            ->where('documents.uid', $uid)
            ->leftJoin('demands', 'demands.document_id','=','documents.id')
            ->first();
            if ($document->document_id != null) {
                Log::warning("Document::destroy - Tentative de suppression d'un document déjà attribué à une demande : " . $uid);
                return $this->sendError("Document est déjà attribué à une demande.", [], 403);
            }
            // Suppression
            $deleted = document::destroy($document->id);
            if (!$deleted) {
                Log::warning("Document::destroy - Tentative de suppression d'un document inexistante : " . $uid);
                return $this->sendError("Impossible de supprimer le document.", [], 403);
            }
            File::where('document_id', $document->id)->delete();
            return $this->sendSuccess("Document supprimé avec succès.");
        } catch(\Exception $e) {
            Log::warning("Document::destroy - Erreur lors de la suppression d'un document : " . $e->getMessage());
            return $this->sendError("Erreur lors de la suppression d'un document.");
        }
    }
}

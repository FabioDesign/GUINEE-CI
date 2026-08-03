<?php

namespace App\Http\Controllers;

use Session;
use Myhelper;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\{Auth, Log};
use App\Models\{Consulat, Demand, Document, File, Profile, Town, User};

class StatusController extends Controller
{
    public function update($type, $uuid) {
        if (!Auth::check()) {
            return 'x';
        }
        try {
            // 🔁 Mapping dynamique
            $models = [
                'consulats' => [
                    'model' => Consulat::class,
                    'label' => 'Consulat'
                ],
                'demands' => [
                    'model' => Demand::class,
                    'label' => 'Demande'
                ],
                'documents' => [
                    'model' => Document::class,
                    'label' => 'Document'
                ],
                'files' => [
                    'model' => File::class,
                    'label' => 'Pièce à fournir'
                ],
                'profiles' => [
                    'model' => Profile::class,
                    'label' => 'Profil'
                ],
                'towns' => [
                    'model' => Town::class,
                    'label' => 'Ville'
                ],
                'users' => [
                    'model' => User::class,
                    'label' => 'Utilisateur'
                ],
            ];
            // Verrifier si le type existe
            if (!isset($models[$type])) {
                return response()->json([
                    'status' => 0,
                    'message' => "Type invalide.",
                ]);
            }
            $modelClass = $models[$type]['model'];
            $label = $models[$type]['label'];
            // Récupération de l'enregistrement
            $item = $modelClass::where('uuid', $uuid)->first();
            if (!$item) {
                Log::warning("StatusController - Aucun {$label} trouver pour uUID : {$uuid}");
                return response()->json([
                    'status' => 0,
                    'message' => "{$label} non trouver.",
                ]);
            }
            // Cas spécifique : Profil admin
            if ($type === 'profiles' && $item->id == 1) {
                Log::warning("StatusController - Tentative désactivation admin uUID : {$uuid}");
                return response()->json([
                    'status' => 0,
                    'message' => "Le profil administrateur ne peut pas être désactiver.",
                ]);
            }
            // Changement de statut
            if ($type === 'demands') {
                $libelle = optional($item->document)->label;
                switch ($item->status) {
                    case 0 :
                        $action = 'Transmettre';
                        $set = [
                            'status' => 1,
                            'transmitted_at' => now(),
                            'transmitted_by' => Auth::user()->id,
                        ];
                        break;
                    case 1 :
                        $action = 'Valider';
                        $set = [
                            'status' => 2,
                            'validated_at' => now(),
                            'validated_by' => Auth::user()->id,
                            'delivered_at' => Myhelper::addWorkingDays($item->copy),
                        ];
                        Demand::printDmd($uuid);
                        break;
                    default :
                        $newStatus = 0;
                        $action = 'Désactiver';
                }
            } else {
                $newStatus = $item->status == 1 ? 0 : 1;
                $action = $newStatus == 1 ? 'Activer' : 'Désactiver';
                $set = [
                    'status' => $newStatus,
                ];
                $libelle = $item->label ?? ($item->lastname . ' ' . $item->firstname);
            }
            $item->update($set);
            // Log
            Myhelper::logs(
                Auth::user()->consulat_id,
			    Auth::user()->profile_id,
                Session::get('username'),
                Session::get('profil'),
                "{$label}: {$libelle}",
				$action,
                Session::get('avatar')
            );
			return response()->json([
				'status' => 1,
				'message' => "{$label} " . Str::lower($action) . " avec succès.",
			]);
        } catch (\Exception $e) {
            Log::warning("StatusController : {$e->getMessage()}");
            return response()->json([
                'status' => 0,
                'message' => "Erreur lors du changement de statut.",
            ]);
        }
    }
}
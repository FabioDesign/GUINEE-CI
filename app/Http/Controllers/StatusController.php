<?php

namespace App\Http\Controllers;

use Session;
use Myhelper;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\{Auth, Log};
use App\Models\{Document, File, Profile, Town};

class StatusController extends Controller
{
    public function update($type, $uid)
    {
        if (!Auth::check()) {
            return 'x';
        }
        try {
            // 🔁 Mapping dynamique
            $models = [
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
            ];
            // Vérifier si le type existe
            if (!isset($models[$type])) {
                return "0|Type invalide.";
            }
            $modelClass = $models[$type]['model'];
            $label = $models[$type]['label'];
            // Récupération de l'enregistrement
            $item = $modelClass::where('uid', $uid)->first();
            if (!$item) {
                Log::warning("StatusController - Aucun {$label} trouvé pour UID : {$uid}");
                return "0|{$label} non trouvé.";
            }
            // Cas spécifique : Profil admin
            if ($type === 'profiles' && $item->id == 1) {
                Log::warning("StatusController - Tentative désactivation admin UID : {$uid}");
                return "0|Le profil administrateur ne peut pas être désactivé.";
            }
            // Changement de statut
            $newStatus = $item->status == 1 ? 0 : 1;
            $action = $newStatus == 1 ? 'Activé' : 'Désactivé';
            $item->update([
                'status' => $newStatus,
            ]);
            // 📝 Log
            Myhelper::logs(
                Session::get('username'),
                Session::get('profil'),
                "{$label}: " . $item->libelle . " " .$action,
				'Modifier',
                Session::get('avatar')
            );
            return "1|{$label} " . Str::lower($action) . " avec succès.";
        } catch (\Exception $e) {
            Log::warning("StatusController : {$e->getMessage()}");
            return "0|Erreur lors du changement de statut.";
        }
    }
}
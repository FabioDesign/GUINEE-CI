<?php

namespace App\Models;

use PDF;
use File;
use DateTime;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Log;
use Illuminate\Database\Eloquent\Model;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Demand extends Model
{
  use HasFactory;

  protected $guarded = [];

  /**
   * The attributes that should be cast.
   *
   * @var array<string, string>
   */
  protected $casts = [
    'delivered_at' => 'date',
    'rejected_at' => 'datetime',
    'recovered_at' => 'datetime',
    'validated_at' => 'datetime',
    'transmitted_at' => 'datetime',
  ];

  protected static function boot() {
    parent::boot();

    static::creating(function ($model) {
      if (empty($model->uuid)) {
        $model->uuid = Str::uuid()->toString();
      }
    });
  }
  // Relation avec le Document
  public function document() {
    return $this->belongsTo(Document::class, 'document_id');
  }
  // Relation avec l'utilisateur
  public function user() {
    return $this->belongsTo(User::class, 'user_id');
  }
  // Relation avec le consulat
  public function consulat() {
    return $this->belongsTo(Consulat::class, 'consulat_id');
  }
  // Relation avec le créateur
  public function createdBy() {
    return $this->belongsTo(User::class, 'created_by');
  }
  // Relation avec le transmetteur
  public function transmittedBy() {
    return $this->belongsTo(User::class, 'transmitted_by');
  }
  // Relation avec le validateur
  public function validatedBy() {
    return $this->belongsTo(User::class, 'validated_by');
  }
  // Relation avec le récupérateur
  public function recoveredBy() {
    return $this->belongsTo(User::class, 'recovered_by');
  }
  // Reference
  public static function reference(string $codeDoc, string $birthday_at): ?string {
    try {
      $monthAn = ['JA', 'FE', 'MR', 'AV', 'MA', 'JN', 'JL', 'AO', 'SE', 'OC', 'NO', 'DE'];
      $date = new DateTime($birthday_at);
      $day = $date->format('d');
      $month = $date->format('m');
      $year = $date->format('y');
      // Mois en Fr
      $monthFr = $monthAn[$month - 1];
      // Nombre de demandes dans la même année
      $lastDemand = self::whereYear('created_at', date('Y'))->count() + 1;
      // Génération de la nouvelle référence
      return $codeDoc . $day . $monthFr . $year . str_pad($lastDemand, 5, '0', STR_PAD_LEFT) . '/AGCI/' . date('my');
    } catch (\Throwable $e) {
      Log::error("Reference generation failed: {$e->getMessage()}");
      return null;
    }
  }

  //Génération de Filename unique
  public static function filenameUnique($codeDoc) {
    do {
      $alfa = 'abcdefghijklmnpqrstuvwxyzABCDEFGHIJKLMNPQRSTUVWXYZ0123456789';
      $string = $codeDoc.substr(str_shuffle($alfa), 0, 13) . '.pdf';
    } while(self::where('path', $string)->exists());
    return $string;
  }

  // Impression de la demande
  public static function printDmd($uuid) {
    try {
      // Récupérer la demande depuis la BDD
      $query = self::where('uuid', $uuid)->first();
      if (!$query) {
        return null;
      }
      // Info du Consul
      $consul = User::find($query->validated_by);
      // Infos de la demande
      $dataPDF = [
        'reference' => $query->reference,
        'document' => optional($query->document)->label,
        'consulat' => optional($query->consulat)->label,
        'sex' => optional($query->user)->gender,
        'gender' => optional($query->user)->gender == 'M' ? 'MASCULIN' : 'FÉMININ',
        'civility' => optional($query->user)->civility,
        'firstname' => optional($query->user)->firstname,
        'lastname' => optional($query->user)->lastname,
        'profession' => optional($query->user)->profession,
        'birthday_at' => optional($query->user)->birthday_at->format('d/m/Y'),
        'birthplace' => optional($query->user)->birthplace,
        'prefecture' => Town::find($query->user->town_id)->label,
        'father' => optional($query->user)->father_fullname,
        'mother' => optional($query->user)->mother_fullname,
        'size' => optional($query->user)->size,
        'complexion' => optional($query->user)->complexion,
        'hairs' => optional($query->user)->hairs,
        'particular_sign' => optional($query->user)->particular_sign,
        'home_address' => optional($query->user)->home_address,
        'validated_at' => optional($query->validated_at)->format('d/m/Y'),
        'signatory' => optional($consul)->civility . ' ' . optional($consul)->firstname . ' ' . optional($consul)->lastname,
        'signature' => optional($consul)->signature,
        'stamp' => optional($consul)->stamp,
      ];
      // Données du Qrcode
      $dataQR = implode("\n", [
        $uuid,
        $dataPDF['reference'],
        $dataPDF['document'],
        $dataPDF['consulat'],
        $dataPDF['signatory'],
        $dataPDF['validated_at'],
      ]);
      // dd($dataPDF, $dataQR);
      // Génération du Qrcode avec les données du reçu
      // $dataPDF['qrcode'] = QrCode::format('png')->size(250)->generate($dataQR);
      // Nom du fichier blade
      $blade = 'pdf.demands.' . Str::lower($query->document->code);
      // Vue PDF
      $pdf = PDF::loadView($blade, compact('dataPDF'));
      //Chemin d'accès
      $dir = 'storage/demands/' . str_replace('-', '', substr($query->created_at, 0, 10)) . '/' . optional($query->user)->uuid;
      if (!File::isDirectory($dir)) {
        File::makeDirectory($dir, 0755, true, true);
      }
      // Path to file
      $filename = self::filenameUnique($query->document->code);
      $path = $dir . '/' . $filename;
      // Save file
      $pdf->save($path);
      // Mettre à jour le nom de fichier dans la transaction
      $query->update([
        'path' => $path,
      ]);
      return $path;
    } catch(\Exception $e) {
      Log::warning("Demand::printDmd - Erreur : {$e->getMessage()}");
      return null;
    }
  }
}

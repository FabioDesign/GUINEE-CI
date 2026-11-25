<?php

namespace App\Models;

use PDF;
use File;
use DateTime;
use App\Models\DemandCdi;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Log;
use Illuminate\Database\Eloquent\Model;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Demand extends Model
{
  use HasFactory;

  // Constantes
  const DATE_FORMAT = 'd/m/Y';

  protected $guarded = [];

  /**
   * The attributes that should be cast.
   *
   * @var array<string, string>
   */
  protected $casts = [
    'date_at' => 'date',
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
  // Relation avec le statut matrimonial
  public function maritalstatus() {
    return $this->belongsTo(MaritalStatus::class, 'maritalstatus_id');
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
      $string = $codeDoc . substr(str_shuffle($alfa), 0, 13) . '.pdf';
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
        'code' => optional($query->document)->code,
        'consulat' => optional($query->consulat)->label,
        'sex' => optional($query->user)->gender,
        'gender' => optional($query->user)->gender == 'M' ? 'MASCULIN' : 'FÉMININ',
        'civility' => optional($query->user)->civility,
        'firstname' => optional($query->user)->firstname,
        'lastname' => optional($query->user)->lastname,
        'profession' => optional($query->user)->profession,
        'birthday_at' => optional($query->user)->birthday_at->format(self::DATE_FORMAT),
        'birthplace' => optional($query->user)->birthplace,
        'prefecture' => Town::find($query->user->town_id)->label,
        'father' => optional($query->user)->father_fullname,
        'mother' => optional($query->user)->mother_fullname,
        'size' => optional($query->user)->size,
        'complexion' => optional($query->user)->complexion,
        'hairs' => optional($query->user)->hairs,
        'particular_sign' => optional($query->user)->particular_sign,
        'home_address' => optional($query->user)->home_address,
        'arrival_at' => optional($query->user)->arrival_at->format(self::DATE_FORMAT),
        'validated_at' => optional($query->validated_at)->format(self::DATE_FORMAT),
        'signatory' => optional($consul)->civility . ' ' . optional($consul)->firstname . ' ' . optional($consul)->lastname,
        'signature' => optional($consul)->signature,
        'stamp' => optional($consul)->stamp,
      ];
      // Carte d'identité
      if (optional($query->document)->code == 'ADI') {
        $dmdFiles = Attachment::where('demand_id', $query->id)->where('file_id', 1)->first();
        $dataPDF['photo'] = $dmdFiles->path;
      }
      // Certificat de conjoint
      if (optional($query->document)->code == 'CBC') {
        $dataPDF['number'] = $query->number;
        $dataPDF['maritalstatus'] = Str::upper(optional($query->maritalstatus)->label);
      }
      // Certificat d'individualité
      if (optional($query->document)->code == 'CDI') {
        $dataPDF['number'] = $query->number;
        $dataPDF['lastname_cdi'] = $query->field_1;
        $dataPDF['firstname_cdi'] = $query->field_2;
        $dataPDF['dateat_cdi'] = $query->date_at->format(self::DATE_FORMAT);
      }
      // Certificat de décès
      if (optional($query->document)->code == 'CND') {
        $dataPDF['number'] = $query->number;
        $dataPDF['lastname_cnd'] = $query->field_1;
        $dataPDF['firstname_cnd'] = $query->field_2;
        $dataPDF['wedding_at'] = $query->date_at->format(self::DATE_FORMAT);
        $dataPDF['wedding_place'] = $query->field_3;
      }
      // Permis de conduire
      if ((optional($query->document)->code == 'APC') || (optional($query->document)->code == 'APP')) {
        $dataPDF['number'] = $query->number;
        $dataPDF['delivery_at'] = $query->date_at->format(self::DATE_FORMAT);
        $dmdFiles = Attachment::where('demand_id', $query->id)->where('file_id', 1)->first();
        $dataPDF['photo'] = $dmdFiles->path;
      }
      // Données du Qrcode
      $dataQR = implode("\n", [
        $dataPDF['reference'],
        $dataPDF['document'],
        $dataPDF['consulat'],
        $dataPDF['signatory'],
        $dataPDF['validated_at'],
      ]);
      // Génération du Qrcode avec les données du reçu
      $qrcodePng = QrCode::format('png')->size(250)->generate($dataQR);
      $dataPDF['qrcode'] = 'data:image/png;base64,' . base64_encode($qrcodePng);
      // Nom du fichier blade
      // APC (permis de conduire) et APP (passeport) partagent la même vue : aap.blade.php
      $blade = in_array($query->document->code, ['APC', 'APP'])
        ? 'pdf.demands.aap'
        : 'pdf.demands.' . Str::lower($query->document->code);
      // Vue PDF
      $pdf = PDF::loadView($blade, compact('dataPDF'));
      //Chemin d'accès
      $dir = 'storage/demands/' . str_replace('-', '', substr($query->created_at, 0, 10)) . '/' . optional($query->user)->uuid;
      if (!File::isDirectory($dir)) {
        File::makeDirectory($dir, 0755, true, true);
      }
      // Nom du fichier pdf
      $filename = self::filenameUnique($query->document->code);
      // Path to file
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

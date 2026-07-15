<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use DateTime;

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
        'rejeted_at' => 'datetime',
        'retrieved_at' => 'datetime',
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
    
  // Reference
  public static function reference(string $codeDoc, string $birthday_at): ?string {
    try {
        $monthAn = ['JAN', 'FEV', 'MAR', 'AVR', 'MAI', 'JUN', 'JUL', 'AOU', 'SEP', 'OCT', 'NOV', 'DEC'];
        $date = new DateTime($birthday_at);
        $day = $date->format('d');
        $month = $date->format('m');
        $year = $date->format('y');
        // Mois en Fr
        $monthFr = $monthAn[$month - 1];
      // Nombre de demandes dans la même année
      $lastDemand = self::whereYear('created_at', date('Y'))->count() + 1;
      // Génération de la nouvelle référence
      return $codeDoc . $day . $monthFr . $year . str_pad($lastDemand, 5, '0', STR_PAD_LEFT) . '/AGCI/' . date('mY');
    } catch (\Throwable $e) {
      Log::error("Reference generation failed: {$e->getMessage()}");
      return null;
    }
  }
}

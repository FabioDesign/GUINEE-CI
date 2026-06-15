<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Agency extends Model
{
    use HasFactory, SoftDeletes;

    protected $guarded = [];
    
    protected static function boot() {
        parent::boot();

        static::creating(function ($model) {
            if (empty($model->uuid)) {
                $model->uuid = Str::uuid()->toString();
            }
        });
    }
    
    // Relation avec le Pays
    public function country() {
        return $this->belongsTo(Country::class, 'country_id');
    }
}

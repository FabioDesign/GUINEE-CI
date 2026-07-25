<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Attachment extends Model
{
    use HasFactory;

    protected $guarded = [];

    public $timestamps = false;

    // Relation avec le fichier
    public function file() {
        return $this->belongsTo(File::class, 'file_id');
    }
}

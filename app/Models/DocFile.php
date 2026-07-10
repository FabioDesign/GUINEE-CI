<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DocFile extends Model
{
    use HasFactory;

    protected $guarded = [];
    
    public $timestamps = false;

    public function files() {
        return $this->belongsTo(File::class, 'file_id');
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    use HasFactory;

    protected $fillable = [
        'en',
        'fr',
        'icone',
        'status',
        'target',
        'menu_id',
        'position',
    ];
    
    public $timestamps = false;

    public function actions()
    {
        return $this->belongsToMany(Action::class, 'menu_actions');
    }
}

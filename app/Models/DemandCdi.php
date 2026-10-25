<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DemandCdi extends Model
{
    public $table = 'demand_cdi';

    protected $guarded = [];

    protected $casts = [
        'birthday_at' => 'date',
      ];
    
}

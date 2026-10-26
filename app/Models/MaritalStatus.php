<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MaritalStatus extends Model
{
    public $table = 'marital_status';

    protected $guarded = [];
    
    public $timestamps = false;
}
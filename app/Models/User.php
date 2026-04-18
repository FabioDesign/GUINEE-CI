<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Str;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'title',
        'lastname',
        'firstname',
        'gender',
        'whatsapp',
        'number',
        'email',
        'password',
        'password_at',
        'birthday_at',
        'birthplace',
        'size',
        'hair',
        'complexion',
        'profession',
        'father_fullname',
        'mother_fullname',
        'person_fullname',
        'person_number',
        'person_address',
        'arrival_at',
        'stamp',
        'signature',
        'avatar',
        'login_at',
        'status',
        'activated_at',
        'blocked_at',
        'created_by',
        'updated_by',
        'blocked_by',
        'activated_by',
        'town_id',
        'profile_id',
        'country_id',
        'nationality_id',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'birthday_at' => 'date',
        'login_at' => 'datetime',
        'blocked_at' => 'datetime',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
        'password_at' => 'datetime',
        'activated_at' => 'datetime',
    ];
    // Génération de UUID unique
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            if (empty($model->uid)) {
                $model->uid = Str::uuid()->toString();
            }
        });
    }
    // Relation avec le profil
    public function profile()
    {
        return $this->belongsTo(Profile::class, 'profile_id');
    }

    // Relation avec la ville
    public function town()
    {
        return $this->belongsTo(Town::class, 'town_id');
    }

    // Relation avec le Pays
    public function country()
    {
        return $this->belongsTo(Country::class, 'country_id');
    }
}

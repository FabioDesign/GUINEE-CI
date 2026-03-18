<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;
use Illuminate\Support\Str;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'lg',
        'uid',
        'otp',
        'size',
        'hair',
        'year',
        'stamp',
        'month',
        'email',
        'gender',
        'status',
        'number',
        'otp_at',
        'town_id',
        'whatsapp',
        'password',
        'login_at',
        'lastname',
        'signature',
        'blocked_id',
        'profile_id',
        'blocked_at',
        'firstname',
        'birthplace',
        'complexion',
        'profession',
        'prefecture',
        'password_at',
        'birthday_at',
        'activated_at',
        'activated_id',
        'person_number',
        'person_address',
        'father_fullname',
        'mother_fullname',
        'person_fullname',
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
        'otp_at' => 'datetime',
        'birthday_at' => 'date',
        'login_at' => 'datetime',
        'blocked_at' => 'datetime',
        'password_at' => 'datetime',
        'activated_at' => 'datetime',
        'password' => 'hashed',
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
}

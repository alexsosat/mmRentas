<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'surname',
        'email',
        'phone',
        'password',
        'image_url',
        'facebook_url',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function getfullNameAttribute()
    {
        return $this->name . " " . $this->surname;
    }

    public function getwhatsappPhoneAttribute()
    {

        return str_replace("+", "", $this->phone);
    }


    public function getfacebookIdAttribute()
    {
        $explodes = explode("/", $this->facebook_url);
        return $explodes[3];
    }

    public function publications()
    {
        return $this->hasMany(Publication::class);
    }
}

<?php

namespace App\Entidades;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use Notifiable, HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'activo'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    protected $casts = [
        'activo'=>'boolean'
    ];

    /**
     * Mediciones que ha realizado el usuario
     *
     * @return 
     */
    public function mediciones() {
        return $this->hasMany( Medicion::class );
    }

    /**
     * Cais asociados a este usuario
     *
     * @return 
     */
    public function cais () {
        return $this->belongsToMany(Cai::class, 'users_cai');
    }
}
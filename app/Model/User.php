<?php

namespace App\Model;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * Связь один ко многим
     */
    public function relationRole()
    {
        return $this->hasMany('App\Model\Role', 'id', 'role_id');
    }

    /**
     * Связь многие ко многим
     */
    public function relationCompany()
    {
        return $this->belongsToMany('App\Model\Companies\Company', 'user_company', 'user_id', 'company_id');
    }
}

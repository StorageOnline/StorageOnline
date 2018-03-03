<?php

namespace App\Model\Companies;

use Illuminate\Database\Eloquent\Model;

class UserCompany extends Model
{
    /*Имя таблицы в Базе Данных*/
    protected $table = 'user_company';

    public $timestamps = true;

    protected $fillable = ['*'];
}

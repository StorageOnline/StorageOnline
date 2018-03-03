<?php

namespace App\Model\Companies;

use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    /*Имя таблицы в Базе Данных*/
    protected $table = 'company';

    public $timestamps = true;

    protected $fillable = ['*'];
}

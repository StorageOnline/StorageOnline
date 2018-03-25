<?php

namespace App\Model\Companies;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Company extends Model
{
    // для возможности "мягкого удаления"
    use SoftDeletes;

    /*Имя таблицы в Базе Данных*/
    protected $table = 'company';

    public $timestamps = true;

    protected $fillable = ['*'];

    /**
     * Атрибуты, которые должны быть преобразованы в даты.
     *
     * @var array
     */
    protected $dates = ['deleted_at'];
}

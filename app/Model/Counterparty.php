<?php

namespace App\Model;

use App\Scopes\CompanyScope;
use Illuminate\Database\Eloquent\Model;

class Counterparty extends Model
{
    /*Имя таблицы в Базе Данных*/
    protected $table = 'counterparties';

    public $timestamps = false;

    protected $fillable = ['*'];

    /**
     * Подгрузка "условия запросов (QUERY SCOPES)"
     * для того, чтоб модель выбирала только контрагентов в привязке к компании
     */
    protected static function boot()
    {
        parent::boot();
        static::addGlobalScope(new CompanyScope());
    }
}

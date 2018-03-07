<?php

namespace App\Model;

use App\Scopes\CompanyScope;
use Illuminate\Database\Eloquent\Model;

class IncomingInvoice extends Model
{
    /*Имя таблицы в Базе Данных*/
    protected $table = 'incoming_invoices';

    public $timestamps = false;

    protected $guarded = [];

    /**
     * Подгрузка "условия запросов (QUERY SCOPES)"
     * для того, чтоб модель выбирала только инвойсы в привязке к компании
     */
    protected static function boot()
    {
        parent::boot();
        static::addGlobalScope(new CompanyScope());
    }

    /**
     * Устанавливает связь один к одному с базой товаров
     */
    public function relationProduct()
    {
        return $this->hasOne('App\Model\Product', 'id', 'product_id')->withTrashed();
    }
}

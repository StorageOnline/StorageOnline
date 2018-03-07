<?php

namespace App\Model;

use App\Scopes\CompanyScope;
use Illuminate\Database\Eloquent\Model;

class IncomingPaymentOrder extends Model
{
    /*Имя таблицы в Базе Данных*/
    protected $table = 'incoming_payment_orders';

    public $timestamps = true;

    protected $fillable = ['*'];

    /**
     * Подгрузка "условия запросов (QUERY SCOPES)"
     * для того, чтоб модель выбирала Приходные ордера в привязке к компании
     */
    protected static function boot()
    {
        parent::boot();
        static::addGlobalScope(new CompanyScope());
    }

    /**
     *  Устанавливает связь "один ко многим" номер накладной к сформированным товарам
     */
    public function relationInvoiceIncoming()
    {
        return $this->hasMany('App\Model\IncomingInvoice', 'incoming_payment_order_id', 'id');
    }

    /**
     * Устанавливает связь один к одному между IncomingPaymentOrder и Counterparty
     */
    public function relationCounterparty()
    {
        return $this->hasOne('App\Model\Counterparty', 'id', 'counterparty_id');
    }
}

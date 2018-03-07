<?php

namespace App\Model;

use App\Scopes\CompanyScope;
use Illuminate\Database\Eloquent\Model;

class OutgoingPaymentOrder extends Model
{
    /*Имя таблицы в Базе Данных*/
    protected $table = 'outgoing_payment_orders';

    public $timestamps = true;

    /**
     * Подгрузка "условия запросов (QUERY SCOPES)"
     * для того, чтоб модель выбирала Расходные ордера в привязке к компании
     */
    protected static function boot()
    {
        parent::boot();
        static::addGlobalScope(new CompanyScope());
    }

    /**
     * Устанавливает связь один к одному между IncomingPaymentOrder и Counterparty
     */
    public function relationCounterparty()
    {
        return $this->hasOne('App\Model\Counterparty', 'id', 'counterparty_id');
    }

    /**
     *  Устанавливает связь "один ко многим" номер накладной к сформированным товарам
     */
    public function relationInvoiceOutgoing()
    {
        return $this->hasMany('App\Model\OutgoingInvoice', 'outgoing_payment_order_id', 'id');
    }
}

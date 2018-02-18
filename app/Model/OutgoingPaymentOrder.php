<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class OutgoingPaymentOrder extends Model
{
    /*Имя таблицы в Базе Данных*/
    protected $table = 'outgoing_payment_orders';

    public $timestamps = true;

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

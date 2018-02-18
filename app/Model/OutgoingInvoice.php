<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class OutgoingInvoice extends Model
{
    /*Имя таблицы в Базе Данных*/
    protected $table = 'outgoing_invoices';

    public $timestamps = false;

    protected $guarded = [];

    /**
     * Устанавливает связь один к одному с базой товаров
     */
    public function relationProduct()
    {
        return $this->hasOne('App\Model\Product', 'id', 'product_id');
    }
}

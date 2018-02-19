<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    /*Имя таблицы в Базе Данных*/
    protected $table = 'products';

    public $timestamps = false;

    protected $fillable = ['*'];

    /**
     * Связь один ко многим
     * таблица Product к Price
     */
    public function relationPrice()
    {
        return $this->hasMany('App\Model\Price', 'product_id', 'id');
    }
}

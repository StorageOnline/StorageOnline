<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    // для возможности "мягкого удаления"
    use SoftDeletes;

    /*Имя таблицы в Базе Данных*/
    protected $table = 'products';

    public $timestamps = false;

    // разрешенные поля для массового заполнения
    protected $fillable = ['id', 'name', 'code', 'quantity', 'price'];

    /**
     * Атрибуты, которые должны быть преобразованы в даты.
     *
     * @var array
     */
    protected $dates = ['deleted_at'];

    /**
     * Связь один ко многим
     * таблица Product к Price
     */
    public function relationPrice()
    {
        return $this->hasMany('App\Model\Price', 'product_id', 'id');
    }
}

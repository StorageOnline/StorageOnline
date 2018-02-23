<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Price extends Model
{
    /*Имя таблицы в Базе Данных*/
    protected $table = 'prices';

    // разрешенные поля для массового заполнения
    protected $fillable = ['id', 'product_id', 'price'];
}

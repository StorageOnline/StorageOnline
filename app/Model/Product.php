<?php

namespace App\Model;

use App\Scopes\CompanyScope;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Builder;

class Product extends Model
{
    // для возможности "мягкого удаления"
    use SoftDeletes;

    /*Имя таблицы в Базе Данных*/
    protected $table = 'products';

    public $timestamps = false;

    // разрешенные поля для массового заполнения
    protected $fillable = ['id', 'name', 'code', 'quantity', 'price', 'company_id'];

    /**
     * Атрибуты, которые должны быть преобразованы в даты.
     *
     * @var array
     */
    protected $dates = ['deleted_at'];

    /**
     * Подгрузка "условия запросов (QUERY SCOPES)"
     * для того, чтоб модель выбирала только товары в привязке к компании
     */
    protected static function boot()
    {
        parent::boot();
        static::addGlobalScope(new CompanyScope());
    }

    /**
     * Связь один ко многим
     * таблица Product к Price
     */
    public function relationPrice()
    {
        return $this->hasMany('App\Model\Price', 'product_id', 'id');
    }
}

<?php

namespace App\Http\Controllers;

use App\Model\Product;
use Illuminate\Http\Request;

class StorageController extends Controller
{
    protected $model;
    public function __construct(Product $product)
    {
        parent::__construct();
        $this->model = $product;
    }

    /**
     * Получение всех товаров для отображения на складе
     * с историей по изменению цен
     */
    public function index()
    {
        $items = $this->model->withTrashed()->paginate(10);

        foreach($items as $item) {
            $item->relationPrice;
        }
        $products ['products'] = $items;
        // html код пагинации на странице
        $products ['render'] = $items->render();

        return view('storage', $products);
    }
}

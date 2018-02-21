<?php

namespace App\Http\Controllers;

use App\Model\Product;
use Illuminate\Http\Request;

class StorageController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Получение всех товаров для отображения на складе
     * с историей по изменению цен
     */
    public function index()
    {
        $items = Product::withTrashed()->get();
        foreach($items as $item) {
            $item->relationPrice;
        }
        $products ['products'] = $items->toArray();

        return view('storage', $products);
    }
}

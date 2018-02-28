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
        $items = Product::withTrashed()->paginate(3);

        foreach($items as $item) {
            $item->relationPrice;
        }
        $products ['products'] = $items;
        // html код пагинации на странице
        $products ['render'] = $items->render();

        return view('storage', $products);
    }

    // живой поиск
    public function search(Request $request)
    {
        $request_search = '%'.$request->search.'%';
        $items = Product::withTrashed()->where(function($q) use ($request_search){
            $q->where('name', 'LIKE', $request_search);
        })->get();

        return $items;
    }

    // Поиск с пагинацией
    public function getSearch(Request $request)
    {
        $request_search = '%'.$request->search.'%';
        $items = Product::withTrashed()->where(function($q) use ($request_search){
            $q->where('name', 'LIKE', $request_search);
        })->paginate(2);
        $items->setPath('search?search='.$request->search);
        $products ['products'] = $items;
        $products ['render'] = $items->render();
        return view('storage', $products);
    }
}

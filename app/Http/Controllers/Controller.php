<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\Request;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    // объект модели
    protected  $model;
    // Поиск с пагинацией
    public function getSearch(Request $request)
    {
        $request_search = '%'.$request->search.'%';
        $items = $this->model->withTrashed()->where(function($q) use ($request_search){
            $q->where('name', 'LIKE', $request_search);
        })->paginate(2);
        $items->setPath('search?search='.$request->search);
        $products ['products'] = $items;
        $products ['render'] = $items->render();
        return view('storage', $products);
    }

    // живой поиск
    public function search(Request $request)
    {
        $request_search = '%'.$request->search.'%';
        $items = $this->model->withTrashed()->where(function($q) use ($request_search){
            $q->where('name', 'LIKE', $request_search);
        })->paginate(3);

        return $items;
    }
}

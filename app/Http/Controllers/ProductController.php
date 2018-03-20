<?php

namespace App\Http\Controllers;

use App\Model\IncomingInvoice;
use App\Model\IncomingPaymentOrder;
use Illuminate\Http\Request;
use App\Model\Product;

class ProductController extends Controller
{
    protected $model;

    public function __construct(Product $product)
    {
        parent::__construct();
        $this->model = $product;
    }

    public function index()
    {
        $items = $this->model->paginate(10);
        $products ['products'] = $items;
        $products ['render'] = $items->render();

        return view('product', $products);
    }

    /**
     * Сохранение информации при добавлении или редактировании товара
     */
    public function setProduct(Request $request)
    {
        $id = $request->product_id;
        $name = $request->product_name;
        $quantity = $request->product_quantity;
        $code = $request->product_code;
        $price = $request->product_price;
        $company_id = session('company_id');

        // создание или редактирование
        $product = $this->model->updateOrCreate(
                                            ['id' => $id],
                                                ['name' => $name,
                                                'code' => $code,
                                                'quantity' => $quantity,
                                                'price' => $price,
                                                'company_id' => $company_id
                                                ]);
        // проверка и изменение цены если пользователь внёс изменения
        if(!empty(count($product->relationPrice))) {
            // получение последней цены на товар
            $product_price = $product->relationPrice()->latest()->first()->price;
            if($product_price != $price) {
                $product->relationPrice()->create(['price' => $price]);
            }
        } else {
            $product->relationPrice()->create(['price' => $price]);
        }

        $products = $this->getAllProducts();

        return $products;

    }

    /**
     * Получение данных по конкретному продукту
     */
    public function getProduct(Request $request)
    {
        $id = $request->id;

        $productInfo = $this->model->find($id);
        // получение всех цен на товар
        $prices = $productInfo->relationPrice;
//        dump(empty(0));
        // получение последней цены товара
        $price_last = $productInfo->relationPrice()->orderby('id', 'desc')->first()->price;
        $product = [
            'product_info' => $productInfo->toArray(),
            'product_prices' => $prices,
            'product_price' => $price_last,
        ];

        return $product;
    }

    /**
     * Удаление продукта
     */
    public function delProduct(Request $request)
    {
        $id = $request->id;
        $item = $this->model->find($id);
        if($item->delete()) {
            return $this->getAllProducts();
        }
    }

    /**
     * Получение списка всех товаров
     *
     * @return array
     */
    public function getAllProducts()
    {
        $items = $this->model->all();
        $products = $items->toArray();
//        dump($products);
        return $products;
    }

    // живой поиск
    public function search(Request $request)
    {
        $request_search = '%'.$request->search.'%';
        $items = $this->model->where(function($q) use ($request_search){
            $q->where('name', 'LIKE', $request_search);
        })->paginate(10);

        return $items;
    }
}

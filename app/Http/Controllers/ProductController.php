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
        $this->middleware('auth');
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

        $product = $this->model->updateOrCreate(['id' => $id], ['name' => $name, 'code' => $code, 'quantity' => $quantity, 'price' => $price]);
        // проверка и изменение цены если пользователь всё изменения
        if(!empty($product->relationPrice)) {
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


}

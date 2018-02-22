<?php

namespace App\Http\Controllers;

use App\Model\IncomingInvoice;
use App\Model\IncomingPaymentOrder;
use Illuminate\Http\Request;
use App\Model\Product;

class ProductController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $items = Product::all();
        $products ['products'] = $items->toArray();

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

        if($id) {
            $product = Product::find($id);
            $product->name = $name;
            $product->code = $code;
            $product->quantity = $quantity;
            $product->price = $price;
        } else {
            $product = new Product();

            $product->name = $name;
            $product->code = $code;
            $product->quantity = $quantity;
            $product->price = $price;
        }
//        dump($product->name);
        $product->save();

        /*$products = $this->getAllProducts();

        return $products;*/

        // для отображение при работе через Form
        $items = Product::all();
        $products ['products'] = $items->toArray();

        return redirect('products');

    }

    /**
     * Получение данных по конкретному продукту
     */
    public function getProduct(Request $request)
    {
        $id = $request->id;

        $productInfo = Product::find($id);
        $product = $productInfo->toArray();

        return $product;
    }

    /**
     * Удаление продукта
     */
    public function delProduct(Request $request)
    {
        $id = $request->id;
        $item = Product::find($id);
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
        $items = Product::all();
        $products = $items->toArray();

//        dump($products);
        return $products;
    }


}

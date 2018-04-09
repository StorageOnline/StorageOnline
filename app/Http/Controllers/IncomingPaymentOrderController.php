<?php

namespace App\Http\Controllers;

use App\Model\IncomingInvoice;
use App\Model\Counterparty;
use App\Model\Product;
use Illuminate\Http\Request;
use App\Model\IncomingPaymentOrder;

class IncomingPaymentOrderController extends Controller
{
    public function __construct(IncomingPaymentOrder $order)
    {
        parent::__construct();
        $this->model = $order;
    }

    public function index()
    {
        $order = $this->model->with('relationCounterparty')->paginate(10);
        $counterparty = Counterparty::all()->where('type', 2);
        $orders['orders'] = $order;
        $orders['counterparties'] =  $counterparty->toArray();
        $orders['render'] =  $order->render();

        return view('incoming-payment-order', $orders);
    }

    /**
     * Сохранение информации при добавлении или редактировании приходного ордера
     */
    public function setIncomingPaymentOrder(Request $request)
    {
        $order_id = $request->order_id;
        $counterparty_id = $request->counterparty_id;
        $order_date = $request->order_date;
        $quantity = $request->quantity;
        $summa = $request->summa;
        $company_id = session('company_id');

        if($order_id) {
            $order = $this->model->find($order_id);
        } else {
            $order = new IncomingPaymentOrder();
        }
        $order->counterparty_id = $counterparty_id;
        $order->sum = $summa;
        $order->quantity = $quantity;
        $order->company_id = $company_id;

        $order->save();

        $this->updateProductQuantity($order->relationInvoiceIncoming);

        return $order;

    }

    /**
     * Получение данных по конкретному контрагенту
     */
    public function getOrderByCounterparty(Request $request)
    {
        $id = $request->id;

        $ordersInfo = Counterparty::find($id);
        $orders = $ordersInfo->toArray();

        return $orders;
    }

    /**
     * Удаление ордера
     */
    public function delIncomingPaymentOrder(Request $request)
    {
        $id = $request->id;

        $order = $this->model->find($id);
        foreach ($order->relationInvoiceIncoming as $item) {
            $item->delete();
        }
        $order->delete();
        return $this->getAllIncomingPaymentOrder();
    }

    /**
     * Получение списка всех ордеров
     *
     * @return array
     */
    public function  getAllIncomingPaymentOrder()
    {
        $items = $this->model->all();
        foreach ($items as $item) {
            $item->relationCounterparty;
        }
        $orders = $items->toArray();

        return $orders;
    }

    /**
     * Получение списка товаров в накладной по ID
     */
    public function getOrderById(Request $request)
    {
        $items = $this->model->find($request->id);
        foreach ($items->relationInvoiceIncoming as $item) {
            $item->relationProduct;
        }
        return $items;
    }

    /**
     * Добавление товара в приходную накладную
     */
    public function addProductIncoming(Request $request)
    {
        $product_id = $request->product_id;
        // номер накладной
        $order_id = $request->order_id;
        $counterparty_id = $request->counterparty_id;
        $incoming_payment_order_quantity = $request->incoming_payment_order_quantity;
        $incoming_payment_order_summa = $request->incoming_payment_order_summa;

        $product = Product::find($product_id);
        $price = $product->price;

        if($order_id) {
            $order = $this->model->find($order_id);
            if(!empty($items = $order->relationInvoiceIncoming->where('product_id', $product_id)->first())) {
                $items->quantity++;
                $items->price = $items->price + $price;
                $items->save();
            } else {
                $order->relationInvoiceIncoming()->create([
                    'incoming_payment_order_id' => $order_id,
                    'product_id' => $product_id,
                    'price' => $price,
                    'quantity' => 1,
                    'company_id' => session('company_id'),
                ]);
                $order->reFresh();
            }
            foreach ($order->relationInvoiceIncoming as $item) {
                $item->relationProduct;
            }

            $incoming_order = [
                'quantity' => $order->relationInvoiceIncoming()->sum('quantity'),
                'sum' => $order->relationInvoiceIncoming()->sum('price'),
                'relation_invoice_incoming' => $order->relationInvoiceIncoming,
            ];

            return $incoming_order;

        } else {
            $order = new IncomingPaymentOrder();
            $order->counterparty_id = $counterparty_id;
            $order->quantity = $incoming_payment_order_quantity;
            $order->sum = $incoming_payment_order_summa;
            $order->company_id = session('company_id');
            $order->save();
            $order_id = $order->id;

            $order->relationInvoiceIncoming()->create([
                'incoming_payment_order_id' => $order_id,
                'product_id' => $product_id,
                'price' => $price,
                'quantity' => 1,
                'company_id' => session('company_id'),
            ]);
            $order->reFresh();

            foreach ($order->relationInvoiceIncoming as $item) {
                $item->relationProduct;
            }

            $incoming_order = [
                'quantity' => $order->relationInvoiceIncoming()->sum('quantity'),
                'sum' => $order->relationInvoiceIncoming()->sum('price'),
                'relation_invoice_incoming' => $order->relationInvoiceIncoming,
            ];

            return $incoming_order;
        }
    }

    /**
     * Удаление товара из приходной накладной
     */
    public function delProductIncoming(Request $request)
    {
        $product_id = $request->product_id;
        $order_id = $request->order_id;

        $order = $this->model->find($order_id);
            $item = $order->relationInvoiceIncoming->where('id', $product_id)->first();
            $item->delete();
        $order->reFresh();
        $incoming_quantity = $order->relationInvoiceIncoming()->sum('quantity');
        $incoming_sum = $order->relationInvoiceIncoming()->sum('price');


        foreach ($order->relationInvoiceIncoming as $item) {
            $item->relationProduct;
        }

        $incoming_order = [
            'quantity' => $incoming_quantity,
            'sum' => $incoming_sum,
            'relation_invoice_incoming' => $order->relationInvoiceIncoming,
        ];

        return $incoming_order;
}

    /**
     * Обновление количества товаров после создания приходной накладной
     */
    public function updateProductQuantity($array)
    {
        foreach ($array as $product) {
            $quantity = IncomingInvoice::where('product_id', $product->product_id)->get();
            $sum = $quantity->sum('quantity');
            $item = $product->relationProduct()->first();
            $item->quantity = $sum;
            $item->save();
        }
        return true;
    }

    // живой поиск
    public function search(Request $request)
    {
//        DB::enableQueryLog();
        $request_search = '%'.$request->search.'%';
        // поиск по связанной таблице, в выборку попадают только строки из "relationCounterparty",
        // которые удовлетворяют запросу и возвращается коллекция OutgoingPaymentOrder со связью relationCounterparty
        $items = $this->model->whereHas('relationCounterparty', function($q) use ($request_search) {
            return $q->where('name', 'LIKE', $request_search);
        })->with('relationCounterparty')->paginate(10);

//        dump(DB::getQueryLog());
        return $items;
    }

    /**
     * Формирование PDF файла по ID накладной
     * @param $id
     * @return mixed
     */
    public function getToPdf($id)
    {
        $pdf = new PdfController();
        $result = $pdf->exportIncomingView($this->model->find($id)->relationInvoiceIncoming()->with('relationProduct')->get());
        return $result;
    }

    public function getToPdfLoad($id)
    {
        $pdf = new PdfController();
        $result = $pdf->exportIncomingLoad($this->model->find($id)->relationInvoiceIncoming()->with('relationProduct')->get(), $id);
        return $result;
    }
}

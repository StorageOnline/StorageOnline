<?php

namespace App\Http\Controllers;

use App\Model\OutgoingPaymentOrder;
use App\Model\Counterparty;
use App\Model\Product;
use Illuminate\Http\Request;
use DB;

class OutgoingPaymentOrderController extends Controller
{
    public function __construct(OutgoingPaymentOrder $order)
    {
        parent::__construct();
        $this->model = $order;
    }

    public function index()
    {
        $order = $this->model->with('relationCounterparty')->paginate(10);
        $counterparty = Counterparty::all()->where('type', 1);
        $orders['orders'] = $order;
        $orders['counterparties'] =  $counterparty->toArray();
        $orders['render'] = $order->render();

        return view('outgoing-payment-order', $orders);
    }

    /**
     * Сохранение информации при добавлении или редактировании Расходного ордера
     */
    public function setOutgoingPaymentOrder(Request $request)
    {
        $order_id = $request->order_id;
        $counterparty_id = $request->counterparty_id;
        $order_date = $request->order_date;
        $quantity = $request->quantity;
        $company_id = session('company_id');
        $summa = $request->summa;

        if($order_id) {
            $order = $this->model->find($order_id);
        } else {
            $order = new OutgoingPaymentOrder();
        }
        $order->counterparty_id = $counterparty_id;
        $order->sum = $summa;
        $order->quantity = $quantity;
        $order->company_id = $company_id;
        $order->save();

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
    public function delOutgoingPaymentOrder(Request $request)
    {
        $id = $request->id;

        $order = $this->model->find($id);
        foreach ($order->relationInvoiceOutgoing as $item) {
            $item->delete();
        }
        $order->delete();
        return $this->getAllOutgoingPaymentOrder();
    }

    /**
     * Получение списка всех ордеров
     *
     * @return array
     */
    public function  getAllOutgoingPaymentOrder()
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
        foreach ($items->relationInvoiceOutgoing as $item) {
            $item->relationProduct;
        }
        return $items;
    }

    /**
     * Добавление товара в Расходную накладную
     */
    public function addProductOutgoing(Request $request)
    {
        $product_id = $request->product_id;
        // номер накладной
        $order_id = $request->order_id;
        $counterparty_id = $request->counterparty_id;
        $outgoing_payment_order_quantity = $request->outgoing_payment_order_quantity;
        $outgoing_payment_order_summa = $request->outgoing_payment_order_summa;
        $company_id = session('company_id');

        $product = Product::find($product_id);
        $price = $product->price;

        if($order_id) {
            $order = $this->model->find($order_id);
            if(!empty($items = $order->relationInvoiceOutgoing->where('product_id', $product_id)->first())) {
                $items->quantity++;
                $items->price = $items->price + $price;
                $items->save();
            } else {
                $order->relationInvoiceOutgoing()->create([
                    'outgoing_payment_order_id' => $order_id,
                    'product_id' => $product_id,
                    'price' => $price,
                    'quantity' => 1,
                    'company_id' => $company_id,
                ]);
                $order->reFresh();
            }
            foreach ($order->relationInvoiceOutgoing as $item) {
                $item->relationProduct;
            }

            $outgoing_order = [
                'quantity' => $order->relationInvoiceOutgoing()->sum('quantity'),
                'sum' => $order->relationInvoiceOutgoing()->sum('price'),
                'relation_invoice_outgoing' => $order->relationInvoiceOutgoing,
//                'updated_product_list' => $this->updateProductQuantity($order->relationInvoiceOutgoing),
            ];

            return $outgoing_order;

        } else {
            $order = new OutgoingPaymentOrder();
            $order->counterparty_id = $counterparty_id;
            $order->quantity = $outgoing_payment_order_quantity;
            $order->sum = $outgoing_payment_order_summa;
            $order->company_id = $company_id;
            $order->save();
            $order_id = $order->id;

            $order->relationInvoiceOutgoing()->create([
                'outgoing_payment_order_id' => $order_id,
                'product_id' => $product_id,
                'price' => $price,
                'quantity' => 1,
                'company_id' => $company_id,
            ]);
            $order->reFresh();

            foreach ($order->relationInvoiceOutgoing as $item) {
                $item->relationProduct;
            }

            $outgoing_order = [
                'quantity' => $order->relationInvoiceOutgoing()->sum('quantity'),
                'sum' => $order->relationInvoiceOutgoing()->sum('price'),
                'relation_invoice_outgoing' => $order->relationInvoiceOutgoing,
//                'updated_product_list' => $this->updateProductQuantity($order->relationInvoiceOutgoing),
            ];

            return $outgoing_order;
        }
    }

    /**
     * Удаление товара из Расходной накладной
     */
    public function delProductOutgoing(Request $request)
    {
        $product_id = $request->product_id;
        $order_id = $request->order_id;

        $order = $this->model->find($order_id);
        $item = $order->relationInvoiceOutgoing->where('id', $product_id)->first();
        $item->delete();
        $order->reFresh();

        foreach ($order->relationInvoiceOutgoing as $item) {
            $item->relationProduct;
        }

        $outgoing_order = [
            'quantity' => $order->relationInvoiceOutgoing()->sum('quantity'),
            'sum' => $order->relationInvoiceOutgoing()->sum('price'),
            'relation_invoice_outgoing' => $order->relationInvoiceOutgoing,
        ];

        return $outgoing_order;
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
        $result = $pdf->exportOutgoingView($this->model->find($id)->relationInvoiceOutgoing()->with('relationProduct')->get());
        return $result;
    }

    /**
     * Скачивание PDF файла по ID
     * @param $id
     * @return mixed
     */
    public function getToPdfLoad($id)
    {
        $pdf = new PdfController();
        $result = $pdf->exportOutgoingLoad($this->model->find($id)->relationInvoiceOutgoing()->with('relationProduct')->get(), $id);
        return $result;
    }
}

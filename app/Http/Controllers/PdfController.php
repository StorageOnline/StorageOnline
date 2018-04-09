<?php

namespace App\Http\Controllers;

use PDF;
use Illuminate\Http\Request;

class PdfController extends Controller
{
    /**
     * Экспорт товаров в PDF
     * @param $model
     * @return mixed
     */
    public function exportProductsView($model)
    {
        $items = $model->all();
        $pdf = PDF::loadView('pdf.products-pdf', ['items' => $items]);
        return $pdf->stream('products.pdf');
    }

    /**
     * Скачать список товаров в PDF
     * @param $model
     * @return mixed
     */
    public function exportProductsLoad($model)
    {
        $items = $model->all();
        $pdf = PDF::loadView('pdf.products-pdf', ['items' => $items]);
        return $pdf->download('products.pdf');
    }

    /**
     * Экспорт Приходной накладной в PDF
     * @param $model
     * @return mixed
     */
    public function exportIncomingView($model)
    {
        $order = $model->all();
        $pdf = PDF::loadView('pdf.incoming-pdf', ['items' => $order]);
        return $pdf->stream('incoming.pdf');
    }

    /**
     * Скачивание приходной накладной в PDF
     * @param $model
     * @return mixed
     */
    public function exportIncomingLoad($model, $num)
    {
        $order = $model->all();
        $pdf = PDF::loadView('pdf.incoming-pdf', ['items' => $order]);
        return $pdf->download('incoming-' . $num . '.pdf');
    }

    /**
     * Экспорт Расходной накладной в PDF
     * @param $model
     * @return mixed
     */
    public function exportOutgoingView($model)
    {
        $order = $model;
//        return dump($order);
        $pdf = PDF::loadView('pdf.outgoing-pdf', ['items' => $order]);
        return $pdf->stream('incoming.pdf');
    }

    /**
     * Скачивание Расходной накладной в PDF
     * @param $model
     * @return mixed
     */
    public function exportOutgoingLoad($model, $num)
    {
        $order = $model->all();
        $pdf = PDF::loadView('pdf.outgoing-pdf', ['items' => $order]);
        return $pdf->download('outgoing-' . $num . '.pdf');
    }
}

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
}

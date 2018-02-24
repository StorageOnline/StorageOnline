<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LocalizationController extends Controller
{
    public function index(Request $request, $locale)
    {
        // устанавливаем локаль приложения
        app()->setLocale($locale);

        echo trans('messages.goods');
        return redirect('home');
    }
}

<?php

namespace App\Http\Controllers\Settings;

use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SettingsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request)
    {
        // получаем авторизованного пользователя
        $user = new UserController(\Auth::user());

        // перечень компаний, к которым у пользователя есть доступ
        $data['company'] = $user->getCompanyByUser()->sortByDesc('created_at');
        dump($data['company']);

        return view('settings', $data);
    }
}

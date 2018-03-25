<?php

namespace App\Http\Controllers\Settings;

use App\Model\Companies\Company;
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
        $company = new CompanyController();
        $data['company'] = $company->getCompany()->sortByDesc('created_at');
        return view('settings', $data);
    }
}

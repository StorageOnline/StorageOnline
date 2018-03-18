<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CompanyController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function setCompanyId(Request $request)
    {
        return session()->put('company_id', $request->id);
    }
}

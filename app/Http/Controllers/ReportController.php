<?php

namespace App\Http\Controllers;

use App\Model\IncomingPaymentOrder;
use Faker\Provider\DateTime;
use Illuminate\Http\Request;
use Carbon\Carbon;

class ReportController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        return view('report');
    }

    public function getReport(Request $request)
    {
        $date_start = $request->date_start;
        $date_end = $request->date_end;
        $date_end = Carbon::createFromFormat('Y-m-d', $date_end);
//        dump($date);
        $arr = [];

        $arr = IncomingPaymentOrder::all()->where('created_at', '>=', $date_start)->where('created_at', '<=', $date_end);

        return $arr;
    }
}

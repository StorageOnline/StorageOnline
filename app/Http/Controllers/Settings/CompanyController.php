<?php

namespace App\Http\Controllers\Settings;

use App\Model\Companies\Company;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CompanyController extends Controller
{
    protected $company;

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $companies = $this->getCompany();
        return view('settings', $companies);
    }

    /**
     * Получение информации по конкретной компании или по всем сразу
     * @param Request|null $request
     * @return \Illuminate\Database\Eloquent\Collection|\Illuminate\Database\Eloquent\Model|null|static|static[]
     */
    public function getCompany(Request $request = null)
    {
        if(!isset($request->id)){
            return Company::all();
        }
        return Company::find($request->id);
    }

    /**
     * Устанавливает компанию, которую использует пользователь в данный момент
     * @param Request $request
     * @return mixed
     */
    public function setCompanyId(Request $request)
    {
        return session()->put('company_id', $request->id);
    }

    /**
     * Сохраняет данные по компании при добавлении или редактировании
     * @param Request $request
     * @return mixed
     */
    public function saveCompany(Request $request)
    {
        if (!$request->id){
            $company = new Company();
        } else {
            $company = Company::find($request->id);
        }
        $company->name = $request->company_name;
        $company->full_name = $request->company_full_name;
        $company->okpo = $request->company_okpo;
        $company->acc = $request->company_acc;
        $company->adress = $request->company_adress;
        $company->tel = $request->company_tel;
        $company->save();

        return $company->id;
    }
}

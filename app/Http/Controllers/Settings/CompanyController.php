<?php

namespace App\Http\Controllers\Settings;

use App\Model\Companies\Company;
use App\Model\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CompanyController extends Controller
{
    protected $company;

    public function __construct(Company $company)
    {
        $this->middleware('auth');
        $this->company = $company;
    }

    public function index()
    {
       /* $companies = $this->getCompany();
        return view('settings', $companies);*/
    }

    /**
     * Получение информации по конкретной компании или по всем сразу
     * @param Request|null $request
     * @return \Illuminate\Database\Eloquent\Collection|\Illuminate\Database\Eloquent\Model|null|static|static[]
     */
    public function getCompany(Request $request = null)
    {
        if(!isset($request->id)){
            return $this->company->all();
        }
        return $this->company->find($request->id);
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
     * в связке с авторизованным пользователем
     * @param Request $request
     * @return mixed
     */
    public function saveCompany(Request $request)
    {
        // если не пришел ID компании
        if (!$request->id){
            // то создаем новый экземпляр класса Компании
            $company = new Company();
        } else {
            // если же пришел, то ищем компанию по ID
            $company = $this->company->find($request->id);
        }
        $company->name = $request->company_name;
        $company->full_name = $request->company_full_name;
        $company->okpo = $request->company_okpo;
        $company->acc = $request->company_acc;
        $company->adress = $request->company_adress;
        $company->tel = $request->company_tel;
        $company->save();

        // получаем авторизованного пользователя
        $user = User::find(\Auth::user()->id);
        // сохраняем связь пользователя и компании
        $user->relationCompany()->attach(['company_id' => $company->id],
                                         ['created_at' => Carbon::now(), 'updated_at' => $company->updated_at]
                                         );

        return $company->id;
    }

    /**
     * Удаление компании (нужно доделать)
     * @param Request $request
     */
    public function delCompany(Request $request)
    {
        if(isset($request->id)) {
            $company = $this->company->find($request->id);
            $company->delete();
        }
    }
}

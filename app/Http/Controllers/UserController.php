<?php

namespace App\Http\Controllers;

use App\Model\Role;
use App\Model\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function __construct(User $user)
    {
        parent::__construct();
        $this->model = $user;
    }

    public function index()
    {
        $users = $this->model->paginate(10);
        foreach ($users as $user) {
            $user->relationRole;
            $user->relationCompany;
        }
        $data['users'] = $users;
        return view('user', $data);
    }

    /**
     * получение всех компаний, к которым у пользователя есть доступ
     * @return mixed
     */
    public function getCompanyByUser()
    {
        return $this->model->relationUserCompany()->with('relationCompany')->get();
    }

    /**
     * Псевдоудаление компании в настройках
     * на самом деле удаляется связь в табилце User_Company
     * @param Request $request
     * @return string
     */
    public function delCompanyRelation(Request $request)
    {
        $user = \Auth::user();
        if(isset($request->id)) {
            // если выбранная для удаления компания не совпадает с автивной компанией на данный момент
            if($request->id != session('company_id')) {
                // удаляем связь
                $companyRelation = $user->relationUserCompany()->where('company_id', $request->id)->first();
                $companyRelation->delete();
            // если выбранная для удаления компания совпадает с активной, то возвращаем ошибку
            } else {
                return "Нельзя удалить активную компанию";
            }

        }
    }


}

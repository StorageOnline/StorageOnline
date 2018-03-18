<?php

namespace App\Http\Middleware;

use App\Model\User;
use Closure;

class SettingCompany
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        // установка company_id если у пользователя есть default предприятие
        if(\Auth::user()->id) {
            $user_id = \Auth::user()->id;
            $user = User::find($user_id);
            if (!session()->has('company_id')) {
//            dd($user->relationUserCompany);
                foreach ($user->relationUserCompany as $company) {
                    if($company->default) {
                        session()->put('company_id', $company->company_id);
                    }
                }
            }
        }
        // проверка наличия данных в сессии для выбора предприятия, с которым работает пользователь
        if(!$request->session()->has('company_id')) {
            return redirect()->route('settings')->with('message', 'Для начала работы выберите предприятие!');
        }
        return $next($request);
    }
}

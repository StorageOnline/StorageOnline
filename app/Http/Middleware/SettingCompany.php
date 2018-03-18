<?php

namespace App\Http\Middleware;

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
        if(!$request->session()->has('company_id')) {
            return redirect()->route('settings')->with('message', 'Для начала работы выберите предприятие!');
        }
        return $next($request);
    }
}

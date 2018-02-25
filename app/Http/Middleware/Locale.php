<?php

namespace App\Http\Middleware;

use App;
use Config;
use Session;
use Closure;

class Locale
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
        // если пользователь уже был на сайте,
        // то просто берем инфо из сессии
        $raw_locale = Session::get('locale');

        // проверяем, что у пользователя в сессии установлен доступный язык
        if(in_array($raw_locale, Config::get('app.locales'))){
            // и присваиваем значение переменной $locale
            $locale = $raw_locale;
        } else {
            // иначе присваиваем язык установленный по-умолчанию
            $locale = Config::get('app.locale');
        }

        // устанавливаем локаль приложения
        App::setLocale($locale);

        return $next($request);
    }
}

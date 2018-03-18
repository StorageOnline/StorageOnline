<?php

namespace App\Scopes;

use Illuminate\Database\Eloquent\Scope;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

class CompanyScope implements Scope
{
    /**
     * Применение заготовки к данному построителю запросов Eloquent.
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $builder
     * @param  \Illuminate\Database\Eloquent\Model  $model
     * @return void
     */
    public function apply(Builder $builder, Model $model)
    {
        /*if(session()->has('company_id')) {
            $company_id = session()->get('company_id');
        }*/
        $builder->where('company_id', session()->get('company_id'));
    }
}
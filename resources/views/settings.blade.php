@extends('layouts.app')

@section('content')
    <div class="container small-container">
        <div class="row">
            <div class="col-md-12 small-column">
                <div class="panel panel-default">
                    <div class="panel-heading text-center">{{ trans('menu.settings') }}</div>

                    <div class="panel-body">

                            @if(session('message'))
                            <div id="mes" class="alert-danger">
                                {{ session('message') }}
                            </div>
                            @endif

                        <div class="row">
                            <ul class="nav nav-tabs tools">
                                <li class="active"><a data-toggle="tab" href="#company">Управление компаниями</a></li>
                                <li><a data-toggle="tab" href="#datas">Персональные данные</a></li>
                                <li><a data-toggle="tab" href="#vars">Переменные</a></li>
                            </ul>
                            <div class="tab-content col-md-12">
                                <div id="company" class="tab-pane fade in active">
                                    <div class="container">
                                        <div class="col-md-6 pLeft0">
                                            <h2>Управление компаниями</h2> 
                                            
                                        </div>

                                        <div class="col-md-6 add-btn-row pRight0"><a  data-toggle="tooltip" href="#modal" data-toggle="modal" onclick="addCompany()" class="btn btn-success add-new-company" data-original-title="Добавить новую компанию"><i class="fa fa-plus"></i></a>
                                        </div>
                                       

                                    </div>
                                    <div class="all-company-block">
                                        @if($company)
                                            @foreach($company as $comp)
                                                <div class="col-md-6 company-block">
                                                    <div class="col-md-12 company-item">
                                                        <div class="row">
                                                            <div class="col-md-8 col-xs-8 descripton-company">
                                                                <div class="row">
                                                                    <div class="col-md-12">
                                                                        <h2><input id="company-name" value="{{ $comp->relationCompany->name }}"></h2>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-4 col-xs-4 company-logo">
                                                                <h2>
                                                                    <img src="../../img/company-logo/company1.png" alt="">
                                                                </h2>
                                                            </div>
                                                            <div class="col-md-12">
                                                                <div class="row">
                                                                    <div class="col-md-12">
                                                                        <input id="company-full-name" class="bold uppercase company-full-name" type="text" value="{{ $comp->full_name }}">
                                                                    </div>
                                                                </div>
                                                                <div class="row">
                                                                    <div class="col-md-12">
                                                                        <label for='company-okpo' class="bold">ОКПО</label>
                                                                        <input id='company-okpo' type="text" value="{{ $comp->relationCompany->okpo }}">
                                                                    </div>
                                                                </div>
                                                                <div class="row">
                                                                    <div class="col-md-12">
                                                                        <label for='company-acc' class="bold">Р.С.</label>
                                                                        <input id='company-acc' type="text" value="{{ $comp->relationCompany->acc }}">
                                                                    </div>
                                                                </div>
                                                                <div class="row">
                                                                    <div class="col-md-12">
                                                                        <label for='company_adress' class="bold">Адрес:</label>
                                                                        <input id='company_adress' type="text" value="{{ $comp->relationCompany->adress }}">
                                                                    </div>
                                                                </div>
                                                                <div class="row">
                                                                    <div class="col-md-12">
                                                                        <label for='company-tel' class="bold">Контакты:</label>
                                                                        <input id='company-tel' type="text" value="{{ $comp->relationCompany->tel }}">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-12 control-block">

                                                                <button type="button" class="btn btn-oval btn-success" onclick="setCompany({{ $comp->relationCompany->id }})">Выбрать</button>
                                                                <span type="" class="btn btn-oval edit-company"><i class="fa fa-pencil"></i> Редактировать</span>

                                                                <button type="button" class="btn btn-oval btn-danger">Удалить</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endforeach
                                        @endif
                                    </div>
                                </div>
                                <div id="datas" class="tab-pane fade personal-info">
                                    <h2 class="container">Персональные данные</h2>
                                    <div class="col-sm-12">
                                        <div class="panel panel-default">
                                            <div class="panel-heading">Личная информация</div>
                                            <div class="panel-body">
                                                <form class="form-horizontal">
                                                    <div class="form-group">
                                                        <label for="login" class="col-lg-2 control-label">Логин</label>
                                                        <div class="col-lg-4">
                                                            <input id="login" type="text" placeholder="Логин" class="form-control">
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="name" class="col-lg-2 control-label">Имя</label>
                                                        <div class="col-lg-4">
                                                            <input id="name" type="text" placeholder="Имя" class="form-control">
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="surname" class="col-lg-2 control-label">Фамилия</label>
                                                        <div class="col-lg-4">
                                                            <input id="surname" type="text" placeholder="Фамилия" class="form-control">
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="gender" class="col-lg-2 control-label gender-label">Пол</label>
                                                        <div class="col-sm-10">
                                                           <label class="radio-inline c-radio">
                                                            <input id="inlineradio3" type="radio" name="i-radio" value="option3" checked>
                                                            <span class="male fa fa-circle"></span>Мужской</label>
                                                            <label class="radio-inline c-radio">
                                                                <input id="inlineradio3" type="radio" name="i-radio" value="option3">
                                                                <span class="fa fa-circle"></span>Женский</label>

                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="col-sm-3 col-md-2 control-label birth-day-label">Дата рождения</label>
                                                        <div class="col-sm-9">
                                                           <select id="day" name="day">
                                                          </select>

                                                          <select id="month" name="month">
                                                          </select>

                                                         <select id="year" name="year">
                                                          </select>
                                                      </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="work-experience" class="col-lg-2 control-label">Стаж работы</label>

                                                        <div class="col-lg-10">
                                                            <select id="work" name="work">
                                                          </select>
                                                        </div>
                                                    </div>
                                                  
                                                    <div class="form-group">
                                                        <div class="col-lg-offset-2 col-lg-10">
                                                            <button type="submit" class="btn btn-sm btn-default">Sign in</button>
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div id="vars" class="tab-pane fade">Переменные</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('modal')
    <!-- HTML-код модального окна -->
    <div id="modal" class="modal fade">
        <div class="modal-dialog modal-sm">
            <div class="modal-content">
                <div class="modal-header" style="text-align: center;">
                    <h4 class="modal-title" style="display: inline-block;">Выберите компанию</h4>
                    <button id="" type="button" class="close" data-dismiss="modal" aria-hidden="true">×
                    </button>
                </div>
                <div class="modal-body alert-danger">
                    {{ session('message') }}
                </div>
            </div>
        </div>
    </div>
@endsection

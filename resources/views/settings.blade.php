@extends('layouts.app')

@section('content')
    <div class="container small-container">
        <div class="row">
            <div class="col-md-12 small-column">
                <div class="panel panel-default">
                    <div class="panel-heading text-center">{{ trans('menu.settings') }}</div>

                    <div class="panel-body">
                        <div class="alert-danger">
                            @if(session('message'))
                                {{ session('message') }}
                            @endif
                        </div>
                        <div class="row">
                            <ul class="nav nav-tabs">
                                <li class="active"><a data-toggle="tab" href="#company">Управление компаниями</a></li>
                                <li><a data-toggle="tab" href="#datas">Персональные данные</a></li>
                                <li><a data-toggle="tab" href="#vars">Переменные</a></li>
                            </ul>
                            <div class="tab-content">
                                <div id="company" class="tab-pane fade in active">
                                    <h2>Управление компаниями</h2>
                                    <div class="col-md-3" style="margin-left: 50px; border: 1px dashed #c5d7b5; background-color: #e8f4de;">
                                        <div class="col-md-12" style="height: 250px; border: 1px solid #fff">
                                           <span class="icon icon-plus2" style="margin: 100px 75px; display: block"></span>
                                        </div>
                                        <a href="#" onclick="setCompany(1)">Выбрать компанию 1</a>
                                    </div>

                                    <div class="col-md-3" style="margin-left: 50px; border: 1px dashed #c5d7b5; background-color: #e8f4de;">
                                        <div class="col-md-12" style="height: 250px; border: 1px solid #fff">
                                            <span class="icon icon-plus2" style="margin: 100px 75px; display: block"></span>
                                        </div>
                                        <a href="#" onclick="setCompany(2)">Выбрать компанию 2</a>
                                    </div>

                                    <div class="col-md-3" style="margin-left: 50px; border: 1px dashed #c5d7b5; background-color: #e8f4de;">
                                        <div class="col-md-12" style="height: 250px; border: 1px solid #fff">
                                            <span class="icon icon-plus2" style="margin: 100px 75px; display: block"></span>
                                        </div>
                                        <a href="#" onclick="setCompany(3)">Выбрать компанию 3</a>
                                    </div>

                                </div>
                                <div id="datas" class="tab-pane fade">
                                    <h3>Персональные данные</h3>
                                    <div>
                                        <label for="name">Имя</label>
                                        <input id="name" type="text" placeholder="Имя">
                                        <label for="surname">Фамилия</label>
                                        <input id="surname" type="text" placeholder="Фамилия"></br>
                                        <label>Пол</label></br>
                                        <label>Дата рождения</label></br>
                                        {{--Контакты--}}
                                        <h4>Контакты</h4>
                                        <label>Телефон</label></br>
                                        <label>Скайп</label></br>

                                    </div>

                                    <button id="" type="submit" form="" class="btn btn-success">
                                        Сохранить
                                    </button>
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
        <div class="modal-dialog modal-lg modalInsideEmployee">
            <div class="modal-content">
                <div class="modal-header" style="text-align: center;">
                    <h4 class="modal-title" style="display: inline-block;">Информация о товаре</h4>
                    <button id="" type="button" class="close" data-dismiss="modal" aria-hidden="true">×
                    </button>
                </div>
                <div class="modal-body">
                    <div class="col-md-12 padding-10">
                        {{ csrf_field() }}
                        <label for="product_name" class="col-md-4 control-label">Наименование</label>
                        <input id="product_id" type="hidden" class="form-control" name="product_id">
                        <div class="col-md-6">
                            <input id="product_name" type="text" class="form-control" name="product_name" value="{{ old('product_name') }}" required autofocus>
                        </div>
                    </div>
                    <div class="col-md-12 padding-10">
                        <label for="product_quantity" class="col-md-4 control-label">Количество</label>
                        <div class="col-md-6">
                            <input id="product_quantity" type="text" class="form-control" name="product_quantity" value="{{ old('product_quantity') }}" required>
                        </div>
                    </div>
                    <div class="col-md-12 padding-10">
                        <label for="product_price" class="col-md-4 control-label">Цена</label>
                        <div class="col-md-6">
                            <input id="product_price" type="text" class="form-control" name="product_price" value="{{ old('product_price') }}" required>
                        </div>
                    </div>
                    <div class="col-md-4 col-md-offset-8 btn-submit-counterpart">
                        <button id="" type="submit" form="" class="btn btn-danger" onclick="setProducts();">
                            Сохранить
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
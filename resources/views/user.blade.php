@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="panel panel-default">
                    <div class="panel-heading text-center">Пользователи</div>

                    <div class="panel-body">
                        <a href="#modal" class="btn btn-success"  data-toggle="modal" onclick="clearProductModal()">Добавить</a>
                        <div class="input-group">
                            <input type="text" class="form-control" placeholder="Поиск" name="search">
                        </div>
                    </div>

                    <table id="" class="table">
                        <thead>
                        <tr>
                            <th style="width: 40px;">&#8470;</th>
                            <th style="width: 230px;">Имя</th>
                            <th style="width: 50px;padding-left: 0px!important;text-align: center;">email</th>
                            <th style="width: 50px;">Роль</th>
                            <th style="width: 50px;">Действия</th>
                        </tr>
                        </thead>
                        <tbody id="all-product-tab" class="">
                        @foreach($users as $user)
                            <tr>
                                <td>{{ $user['id'] }}</td>
                                <td>{{ $user['name'] }}</td>
                                <td>{{ $user['email'] }}</td>
                                @foreach($user['relationRole'] as $us)
                                    <td>{{ $us['name'] }}</td>
                                @endforeach
                                <td class="text-center"><a href="#modal" data-toggle="modal" onclick="editProduct({{ $user['id'] }})">
                                        <i class="fa fa-pencil" aria-hidden="true"></i>
                                    </a>
                                    <a class="col-md-offset-3" href="#" onclick="delProduct({{ $user['id'] }})">
                                        <i class="fa fa-trash-o fa-lg"></i>
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('modal')
<!-- HTML-код модального окна -->
<div id="modal" class="modal fade">
    <div class="modal-dialog modal-lg modalInsideEmployee">
        <div class="modal-content" style="min-height: 400px;">
            <div class="modal-header" style="text-align: center;">
                <h4 class="modal-title" style="display: inline-block;">Информация о товаре</h4>
                <button id="" type="button" class="close" data-dismiss="modal" aria-hidden="true">×
                </button>
            </div>
            <div class="modal-body">
                {{ csrf_field() }}
                <label for="product_name" class="col-md-4 control-label">Наименование</label>
                <input id="product_id" type="hidden" class="form-control" name="product_id">
                <div class="col-md-6">
                    <input id="product_name" type="text" class="form-control" name="product_name" value="{{ old('product_name') }}" required autofocus>
                </div>
                <label for="product_quantity" class="col-md-4 control-label">Количество</label>
                <div class="col-md-6">
                    <input id="product_quantity" type="text" class="form-control" name="product_quantity" value="{{ old('product_quantity') }}" required>
                </div>
                <label for="product_price" class="col-md-4 control-label">Цена</label>
                <div class="col-md-6">
                    <input id="product_price" type="text" class="form-control" name="product_price" value="{{ old('product_price') }}" required>
                </div>
                <div class="col-md-4 col-md-offset-8">
                    <button id="" type="submit" form="" class="btn btn-danger" onclick="setProducts();">
                        Сохранить
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
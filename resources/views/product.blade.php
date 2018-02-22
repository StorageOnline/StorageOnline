@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading text-center">Товары</div>

                    <div class="panel-body">
                        <div class="row">
                            <div class="col-md-12 add-btn-row">
                                <a href="#modal" class="btn btn-success"  data-toggle="modal" onclick="clearProductModal()">Добавить</a>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                            <table id="" class="table">
                            <thead >
                            <tr>
                                <th class="text-center" style="width: 50px;">&#8470;</th>
                                <th style="width: 430px;">Наименование</th>
                                <th style="width: 100px;padding-left: 0px!important;text-align: center;">Код</th>
                                <th style="width: 120px;padding-left: 0px!important;text-align: center;">Кол-во</th>
                                <th class="text-center" style="width: 120px;">Цена</th>
                                <th class="text-center" colspan="2" style="width: 50px;">Действия</th>
                            </tr>
                            </thead>
                            <tbody id="all-product-tab" class="text-center">
                            @foreach($products as $product)
                                <tr>
                                    <td>{{ $product['id'] }}</td>
                                    <td class="text-left">{{ $product['name'] }}</td>
                                    <td>{{ $product['code'] }}</td>
                                    <td>{{ $product['quantity'] }}</td>
                                    <td>{{ $product['price'] }}</td>
                                    <td class="text-center"><a href="#modal" data-toggle="modal" onclick="editProduct({{ $product['id'] }})">
                                            <i class="fa fa-pencil" aria-hidden="true"></i>
                                        </a>
                                    </td>    
                                    <td class="text-center">
                                        <a href="#" onclick="delProduct({{ $product['id'] }})">
                                            <i class="fa fa-trash-o fa-lg red"></i>
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
                <label for="product_code" class="col-md-4 control-label">Код</label>
                <div class="col-md-6">
                    <input id="product_code" type="text" class="form-control" name="product_code" value="{{ old('product_code') }}" required>
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
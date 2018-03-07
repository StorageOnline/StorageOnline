@extends('layouts.app')

@section('content')
    <div class="container small-container">
        <div class="row">
            <div class="col-md-12 small-column">
                <div class="panel panel-default">
                    <div class="panel-heading text-center">Пользователи</div>

                    <div class="panel-body">
                        <div class="row">
                            <div class="col-md-12 add-btn-row">
                                <a href="#modal" class="btn btn-success"  data-toggle="modal" onclick="clearProductModal()">Добавить</a>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <div class="input-group">
                                        <input id="search-table" name="search-table" class="form-control rightBorderNone" placeholder="Поиск по таблице">
                                    <div class="input-group-addon">
                                        <a href="" class="fa fa-search with-btn" data-toggle="modal" data-target=""><i></i>
                                        </a>
                                    </div>
                                    </div>
                                </div>
                            </div>
                             <div class="col-md-8"> 
                            <ul class="filter">
                                <li class="dropLi">
                                  <ul class="nav-pills">
                                    <li role="presentation" class="dropdown bgB center">
                                        <a class="dropdown-toggle" data-toggle="dropdown" href="#" aria-haspopup="true" aria-expanded="true">
                                            Сортировать 
                                        </a>
                                        <ul class="dropdown-menu dropLi sortFilter">
                                            <form method="POST" name='form_name2' id='form_name2'>

                                                <li><a href="#" class="dropdown-item"><input type="checkbox" id="awesome" name="cheks" value="0" onclick="sel_all2('form_name2')"/>
                                                    <label for="awesome"></label><span>Выбрать все</span></a></li>
                                                
                                                <li><a href="#" class="dropdown-item"><input type="checkbox" id="awesome1" name="cheks" value="1" />
                                                <label for="awesome1"></label><span>№</span></a></li>

                                               <li><a href="#" class="dropdown-item"><input type="checkbox" id="awesome2" name="cheks" value="2" />
                                                <label for="awesome2"></label><span>Имя</span></a></li>

                                                <li><a href="#" class="dropdown-item"><input type="checkbox" id="awesome3" name="cheks" value="3" />
                                                <label for="awesome3"></label><span>E-mail</span></a></li>

                                                <li><a href="#" class="dropdown-item"><input type="checkbox" id="awesome4" name="cheks" value="4" />
                                                <label for="awesome4"></label><span>Роль</span></a></li>
                                            </form>
                                             <li><a href="#" class="dropdown-item"><label class="pointer">Применить</label></a></li>
                                   </ul>
                               </li>
                           </ul>
                        </li>
                        </ul>
                        </div>
                        </div>
                    <table id="" class="table">
                        <thead>
                        <tr>
                            <th style="width: 40px;">&#8470;</th>
                            <th style="width:450px;">Имя</th>
                            <th class="small-display text-center" style="width: 180px;">email</th>
                            <th class="small-display text-center" style="width: 180px;">Роль</th>
                            <th colspan="3" style="width: 50px;">Действия</th>
                        </tr>
                        </thead>
                        <tbody id="all-product-tab" class="">
                        @foreach($users as $user)
                            <tr>
                                <td>{{ $user['id'] }}</td>
                                <td>{{ $user['name'] }}</td>
                                <td class="small-display text-center">{{ $user['email'] }}</td>
                                @foreach($user['relationRole'] as $us)
                                    <td class="small-display text-center">{{ $us['name'] }}</td>
                                @endforeach
                                <td class="text-center preview"><a href="#modal" data-toggle="modal" >
                                    <i class="fa fa-eye" aria-hidden="true"></i>
                                </a>
                                </td>
                                <td class="text-center">
                                    <a href="#modal" data-toggle="modal" onclick="editProduct({{ $user['id'] }})">
                                        <i class="fa fa-pencil" aria-hidden="true"></i>
                                    </a>
                                </td>
                                <td class="text-center">
                                    <a  href="#" onclick="delProduct({{ $user['id'] }})">
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
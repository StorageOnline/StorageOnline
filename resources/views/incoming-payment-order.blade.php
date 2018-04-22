@extends('layouts.app')

@section('content')
    <div class="container small-container">
        <div class="row">
            <div class="col-md-12 small-column">
                <div class="panel panel-default">
                    <div class="panel-heading text-center">Приходный ордер</div>

                    <div class="panel-body">
                         <div class="row">
                             <div class="col-md-12 add-btn-row dropdown">
                                 <a href="#modal" class="btn btn-success"  data-toggle="modal" onclick="clearIncomingModal()">Добавить</a>
                                 <a href="#" class="btn btn-danger"  onclick="">Возврат товара</a>
                             </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                            <div class="form-group">
                                <div class="input-group">
                                    <input id="search-table" name="search-table" class="form-control rightBorderNone" onkeyup="searchFunction()" placeholder="Поиск по таблице">
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
                                                <label for="awesome2"></label><span>Дата</span></a></li>

                                                <li><a href="#" class="dropdown-item"><input type="checkbox" id="awesome3" name="cheks" value="3" />
                                                <label for="awesome3"></label><span>Поставщик</span></a></li>

                                                <li><a href="#" class="dropdown-item"><input type="checkbox" id="awesome4" name="cheks" value="4" />
                                                <label for="awesome4"></label><span>Количество</span></a></li>

                                                <li><a href="#" class="dropdown-item"><input type="checkbox" id="awesome5" name="cheks" value="5" />
                                                <label for="awesome5"></label><span>Сумма</span></a></li>
                                            </form>
                                            <li><a href="#" class="dropdown-item"><label class="pointer">Применить</label></a></li>
                                        </ul>
                                    </li>
                                    </ul>
                                </li>
                            </ul>
                        </div>
                        </div>
                    
                    {{--<a href="#modal3" data-fancybox data-src="#modal3" class="popup">Модальное окно</a>--}}

                    <table id="" class="table">
                        <thead>
                        <tr>
                            <th style="width: 40px;">&#8470;</th>
                            <th class="small-display" style="width: 60px;">Дата</th>
                            <th style="width: 450px;">Поставщик</th>
                            <th class="text-center small-display" style="width: 50px;">Количество</th>
                            <th class="text-center small-display" style="width: 50px;">Сумма</th>
                            <th colspan="3" style="width: 50px;">Действия</th>
                        </tr>
                        </thead>
                        <tbody id="all-incoming-tab" class="">
                        @foreach($orders as $order)
                            <tr>
                                <td>{{ $order['id'] }}</td>
                                <td class="small-display">{{ $order['created_at'] }}</td>
                                <td>{{ $order['relationCounterparty']['name'] }}</td>
                                <td class="text-center small-display">{{ $order['quantity'] }}</td>
                                <td class="text-center small-display">{{ $order['sum'] }}</td>
                                <td class="text-center"><a href="#" onclick="getIncomingOrder({{ $order['id'] }})">
                                    <i class="fa fa-eye" aria-hidden="true"></i>
                                </a>
                                </td>
                                <td class="text-center">
                                    <a href="#" onclick="editIncomingOrder({{ $order['id'] }})">
                                        <i class="fa fa-pencil" aria-hidden="true"></i>
                                    </a>
                                </td>
                                <td>
                                    <a class="col-md-offset-3" href="#" onclick="delIncomingOrder({{ $order['id'] }})">
                                        <i class="fa fa-trash-o fa-lg red"></i>
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                        <div id="pagination">
                            {{ $render }}
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
        <div class="modal-dialog modal-lg">
            <div class="modal-content" style="min-height: 370px;">
                <div class="modal-header" style="text-align: center;">
                    <h4 class="modal-title" style="display: inline-block;">Информация о приходном ордере</h4>
                    <button id="" type="button" class="close" data-dismiss="modal" aria-hidden="true">×
                    </button>
                </div>

                <div class="modal-body">
                    <div class="row mb-2">
                    <div class="col-md-6 ">
                        {{ csrf_field() }}
                        <label for="incoming_payment_order_id" class="col-md-6 control-label">Номер накладной</label>
                        <div class="col-md-6">
                            <input id="incoming_payment_order_id"  class="form-control" name="incoming_payment_order_id" disabled>
                        </div>
                    </div>
                     <div class="col-md-6">
                        <label for="incoming_payment_order_date" class="col-md-4 control-label">Дата</label>
                        <div class="col-md-6">
                            <div class="">
                                <input id="incoming_payment_order_date" type="date" class="form-control" name="incoming_payment_order_date" value="{{ old('incoming_payment_order_date') }}" required autofocus>

                            </div>
                        </div>
                    </div>
                    </div>
                    <div class="row mb-2">
                        <div class="col-md-6">
                        <label for="counterparty_id" class="col-md-6 control-label">Поставщик</label>
                        <div class="col-md-6">
                            <div class="form-group resetMargin">
                                <select id="counterparty_id">
                                    @foreach($counterparties as $counterparty)
                                    <option value="{{ $counterparty['id'] }}">{{ $counterparty['name'] }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <label for="incoming_payment_order_item" class="col-md-4 control-label">Выбор товаров</label>
                        <div class="col-md-6">
                            {{--<button id="incoming_payment_order_item" class="btn btn-success">Выбрать</button>--}}
                            <a id="actButton" href="#" class="btn btn-success"  data-toggle="modal" data-target="#modal2" onclick="getAllProduct()">Добавить</a>
                        </div>
                    </div>
                    </div>
                    
                   <div class="row pb-2">
                    
                    <div class="col-md-6">
                        <label for="incoming_payment_order_quantity" class="col-md-6 control-label">Количество товаров</label>
                        <div class="col-md-6">
                            <input id="incoming_payment_order_quantity" type="text" class="form-control" name="incoming_payment_order_quantity" disabled>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <label for="incoming_payment_order_summa" class="col-md-4 control-label">Сумма</label>
                        <div class="col-md-6">
                            <input id="incoming_payment_order_summa" type="text" class="form-control" name="incoming_payment_order_summa" disabled>
                        </div>
                    </div>
                    </div>
                    <div class="row mb-2">
                        {{-- Таблица товаров в модальном окне--}}
                    <div class="col-md-12">
                        <table id="" class="table">
                            <thead>
                            <tr>
                                <th style="width: 40px;">&#8470;</th>
                                <th style="width: 230px;">Наименование</th>
                                <th style="width: 50px;padding-left: 0px!important;text-align: center;">Кол-во</th>
                                <th style="width: 50px;">Цена</th>
                                <th style="width: 50px;">Действия</th>
                            </tr>
                            </thead>
                            <tbody id="invoice-tab" class="">
                            </tbody>
                        </table>
                        {{--Конец таблицы товаров--}}
                    </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 col-md-offset-6 text-right">
                            <button id="" type="submit" form="" class="btn btn-success" onclick="setIncomingOrder();">
                                Сохранить
                            </button>
                            <button id="" type="submit" form="" class="btn btn-danger" onclick="setIncomingOrder();">
                                Отменить
                            </button>
                            <div class="dropup i_block">
                                <button id="dropdownMenu"
                                        class="btn btn-primary dropdown-toggle"
                                        type="button"
                                        data-toggle="dropdown"
                                        aria-haspopup="true"
                                        aria-expanded="true">
                                    Экспорт
                                    <span class="caret"> </span>
                                </button>
                                <ul class="dropdown-menu" aria-labelledby="dropdownMenu">
                                    {{--<li><a id="btn-download" href="/incoming-payment-order/incoming-to-pdf/{{ $order['id'] }}">Экспорт в PDF</a></li>--}}
                                    <li><a id="btn-viewpdf" href="">Экспорт в PDF</a></li>
                                    <li><a id="btn-downloadpdf" href="">Скачать</a></li>
                                    <li><a href="#">Отправить</a></li>
                                </ul>
                            </div>
                        </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

<!-- HTML-код модального окна -->
<div id="modal2" style="z-index: 9999; " class="modal fade in">
    <div class="modal-dialog modal-md">
        <div class="modal-content" style="min-height: 400px;">
            <div class="modal-header" style="text-align: center;">
                <h4 class="modal-title" style="display: inline-block;">Выберите товары</h4>
                <button id="" type="button" class="close" data-dismiss="modal" aria-hidden="true">×
                </button>
            </div>
            <div class="modal-body">
                {{ csrf_field() }}
                <table id="" class="table">
                    <thead>
                    <tr>
                        <th style="width: 40px;">&#8470;</th>
                        <th style="width: 150px;">Наименование</th>
                        <th style="width: 30px;padding-left: 0px!important;text-align: center;">Кол-во</th>
                        <th style="width: 30px;">Цена</th>
                        <th style="width: 30px;">Добавить</th>
                    </tr>
                    </thead>
                    <tbody id="all-product-tab" class="">
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

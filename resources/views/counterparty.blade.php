@extends('layouts.app')

@section('content')
    <div class="container small-container">
        <div class="row">
            <div class="col-md-12 small-column">
                <div class="panel panel-default">
                    <div class="panel-heading text-center">Контрагенты</div>

                    <div class="panel-body">
                        <div class="row">
                            <div class="col-md-12 add-btn-row">
                                <a href="#modal" class="btn btn-success"  data-toggle="modal" onclick="clearCounterpartyModal()">Добавить</a>
                            </div>
                        </div>
                        <div class="row">
                        <div class="col-md-4">
                                <div class="form-group">
                                    <div class="input-group">
                                        <input id="search-table" name="search-table" class="form-control rightBorderNone" placeholder="Поиск по таблице" style="height: 35px;">
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
                                                <label for="awesome2"></label><span>Тип</span></a></li>

                                                <li><a href="#" class="dropdown-item"><input type="checkbox" id="awesome3" name="cheks" value="3" />
                                                <label for="awesome3"></label><span>Наименование</span></a></li>

                                                <li><a href="#" class="dropdown-item"><input type="checkbox" id="awesome4" name="cheks" value="4" />
                                                <label for="awesome4"></label><span>Телефон</span></a></li>

                                                <li><a href="#" class="dropdown-item"><input type="checkbox" id="awesome5" name="cheks" value="5" />
                                                <label for="awesome5"></label><span>E-mail</span></a></li>
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
                            <th style="width: 60px;">Тип</th>
                            <th style="width: 400px;">Наименование</th>
                            <th class="small-display" style="width: 150px;">Телефон</th>
                            <th class="small-display" style="width: 150px;">Email</th>
                            <th class="text-center" colspan="3" style="width: 50px;">Действия</th>
                        </tr>
                        </thead>
                        <tbody id="all-counterparty-tab" class="">
                        @foreach($counterparties as $counterparty)
                            <tr>
                                <td>{{ $counterparty['id'] }}</td>
                                @if($counterparty['type'] == 1)
                                    <td class=""><span class="label label-danger">Покупатель</span></td>
                                @else
                                    <td class=""><span class="label label-success">Поставщик</span></td>
                                @endif
                                <td>{{ $counterparty['name'] }}</td>
                                <td class="small-display">{{ $counterparty['tel'] }}</td>
                                <td class="small-display">{{ $counterparty['email'] }}</td>
                                <td class="text-center preview"><a href="#modal" data-toggle="modal" >
                                    <i class="fa fa-eye" aria-hidden="true"></i>
                                </a>
                                </td>
                                <td class="text-center"><a href="#modal" data-toggle="modal" onclick="editCounterparty({{ $counterparty['id'] }})">
                                <i class="fa fa-pencil" aria-hidden="true"></i>
                                </a>
                                </td>    
                                <td class="text-center">
                                    <a href="#" onclick="delCounterparty({{ $counterparty['id'] }})">
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
@endsection
@section('modal')
    <!-- HTML-код модального окна -->
    <div id="modal" class="modal fade">
        <div class="modal-dialog modal-lg modalInsideEmployee">
            <div class="modal-content" style="min-height: 400px;">
                <div class="modal-header" style="text-align: center;">
                    <h4 class="modal-title" style="display: inline-block;">Информация о контрагенте</h4>
                    <button id="" type="button" class="close" data-dismiss="modal" aria-hidden="true">×
                    </button>
                </div>
                <div class="modal-body">
                   
                <div class="col-md-12 padding-10">
                     {{ csrf_field() }}
                    <input id="counterparty_id" type="hidden" class="form-control" name="counterparty_id">
                <!-- </div> -->
                <!-- <div class="col-md-12 padding-10"> -->
                    <label for="counterparty_type" class="col-md-4 control-label">Тип контрагента</label>
                    <div class="col-md-6">
                        <div class="form-group">
                            <select id="counterparty_type">
                                <option value="1">Покупатель</option>
                                <option value="2">Поставщик</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="col-md-12 padding-10">
                    <label for="counterparty_name" class="col-md-4 control-label">Наименование</label>
                    <div class="col-md-6">
                        <input id="counterparty_name" type="text" class="form-control" name="counterparty_name" value="{{ old('counterparty_name') }}" required autofocus>
                    </div>
                </div>
                <div class="col-md-12 padding-10">
                    <label for="counterparty_tel" class="col-md-4 control-label">Телефон</label>
                    <div class="col-md-6">
                        <input id="counterparty_tel" type="text" class="form-control" name="counterparty_tel" value="{{ old('counterparty_tel') }}" required>
                    </div>
                </div>
                <div class="col-md-12 padding-10">
                    <label for="counterparty_email" class="col-md-4 control-label">Email</label>
                    <div class="col-md-6">
                        <input id="counterparty_email" type="email" class="form-control" name="counterparty_email" value="{{ old('counterparty_email') }}" required>
                    </div>
                </div>
                    <div class="col-md-4 col-md-offset-8 btn-submit-counterpart">
                        <button id="" type="submit" form="" class="btn btn-danger" onclick="setCounterparty();">
                            Сохранить
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection



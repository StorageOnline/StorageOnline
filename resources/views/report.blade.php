@extends('layouts.app')

@section('content')
<div id="reports-vue">
    <div class="container small-container">
        <div class="row">
            <div class="col-md-12 small-column">
                <div class="panel panel-default">
                    <div class="panel-heading text-center">Отчеты</div>

                    <div class="panel-body">
                        <div class="row report-date">
                            <div class="col-md-3">
                                    <vuejs-datepicker v-bind="prop_date" ></vuejs-datepicker>
                            </div>
                            <div class="col-md-3">
                                    <vuejs-datepicker v-bind="prop_date" ></vuejs-datepicker>
                            </div>
                            <div class="col-md-3">
                            <a href="#modal" class="btn btn-success col-md-offset-1"  onclick="getReport()">Сформировать</a>
                            </div>
                        <div class="col-md-3"> 
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

                                                <li><a href="#" class="dropdown-item"><input type="checkbox" id="awesome3" name="cheks" value="3" />
                                                <label for="awesome3"></label><span>Наименование</span></a></li>

                                                <li><a href="#" class="dropdown-item"><input type="checkbox" id="awesome4" name="cheks" value="4" />
                                                <label for="awesome4"></label><span>Период</span></a></li>

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
                        <div class="row">
                            <div class="col-md-12">
                                <table id="" class="table">
                                    <thead>
                                        <tr>
                                            <th style="width: 40px;">&#8470;</th>
                                            <th style="width: 230px;">Наименование</th>
                                            <th style="width: 50px;padding-left: 0px!important;text-align: center;">Период</th>
                                            <th style="width: 50px;">Сумма</th>
                                            <th style="width: 50px;">Действия</th>
                                        </tr>
                                    </thead>
                                    <tbody id="all-report-tab" class="">

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
                <h4 class="modal-title" style="display: inline-block;">Информация об отчете</h4>
                <button id="" type="button" class="close" data-dismiss="modal" aria-hidden="true">×
                </button>
            </div>
            <div class="modal-body">
                <table id="" class="table">
                    <thead>
                    <tr>
                        <th style="width: 40px;">&#8470;</th>
                        <th style="width: 230px;">Наименование</th>
                        <th style="width: 50px;padding-left: 0px!important;text-align: center;">Остаток на начало периода</th>
                        <th style="width: 50px;">Поступление товара</th>
                        <th style="width: 50px;">Расход товара</th>
                        <th style="width: 50px;">Остаток на конец периода</th>
                    </tr>
                    </thead>
                    <tbody id="all-report-tab" class="">

                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
</div>
@endsection
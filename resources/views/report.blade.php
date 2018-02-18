@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="panel panel-default">
                    <div class="panel-heading text-center">Отчеты</div>

                    <div class="panel-body">
                        <div class="row">
                            <input id="date_start" class="col-md-3 col-md-offset-1" type="date" name="date_start"/>
                            <input id="date_end" class="col-md-3 col-md-offset-1" type="date" name="date_end"/>
                            <a href="#modal" class="btn btn-success col-md-offset-1"  onclick="getReport()">Сформировать</a>
                        </div>
                    </div>

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
@endsection
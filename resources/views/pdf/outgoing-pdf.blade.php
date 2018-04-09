<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Раходная накладная</title>
    <style>
        *{
            font-family: DejaVu Sans !important;
        }
        table{
            width: 100%;
            border-collapse: collapse;
        }
        td, th {
            border: 1px solid;
            padding:4px;
            padding-left: 14px;
        }
        thead tr, thead th {
            color: white;
            border: 1px solid #000;
            background-color: rgb(54, 75, 90) !important;
        }

        .bold{
            font-weight: bold;
            font-size: 14px;
        }

        .provider,.contract,.buyer{
            margin-bottom: 25px;
            display:block;
            width: 100%;
            vertical-align: top;
            font-size: 14px;
        }

        .description {
            display: inline-block;
            width: 79%;
            vertical-align: top;
            margin-top: 0px;
            padding-top: 0px;
            font-size: 13px;
            /*line-height: 14px;*/
        }

        h1{
            font-size: 20px;
        }

        .name{
            display: inline-block;
            width: 20%;
            vertical-align: top;
            font-size: 14px;
        }
        .right{
            margin-top: 5px;
            text-align: right;
        }
        .left{
            text-align: left;
        }
        .total{
            font-size: 13px;
            margin-top: 15px;
        }

        .bottom-line:after{
            content:"";
            position: relative;
            bottom: -55px;
            display: inline-block;
            box-sizing: border-box;
            width: 250px;
            height: 1px;
            background: black;
            margin-top: 10px;
            margin-left:15px;
            /*margin-right: -100%;*/
        }

        hr{
            background: black;
        }

        .person{
            margin-top: 15px;
        }

    </style>



</head>
<body>
<h1>Рахунок на оплату No {{ $items->id }} від {{ $items->created_at->format('d-m-Y') }} р.</h1>
<hr style="margin-bottom: 20px;">

<div id="provider" class="provider">
    <div class="name">
        <span  for="" class="control-label">Постачальник:</span>
    </div>
    <div class="description">
            <span>
                <span class="bold">{{ $items->relationCompany->full_name }}</span><br>
                <span>ОКПО: {{ $items->relationCompany->okpo }}</span>
                <span>Р/C: {{ $items->relationCompany->acc }}</span>
                <span>МФО: {{ $items->relationCompany->mfo }}</span><br>
                <span>Адрес: {{ $items->relationCompany->adress }}</span>
                {{--Р/с {{ $items->relationCompany->acc }}, Банк КОМЕРЦІЙНИЙ БАНК "ПІВДЕННИЙ", ОДЕСА, МФО 328209
                ВУЛИЦЯ ЛАБОРАТОРНА, будинок 45, місто Дніпро, Дніпропетровська обл.,49010, тел.:
                0567873736,
                код за ЄДРПОУ 38432130, ІПН 384321304633, No свід. 200083340,
                Є платником податку на прибуток на загальних підставах--}}
            </span>
    </div>
</div>

<div id="buyer" class="buyer">
    <div class="name">
        <span  for="" class="control-label">Покупець:</span>
    </div>
    <div class="description">
            <span>
                <span class="bold">{{ $items->relationCounterparty->name }}</span><br>
                <span>тел. : {{ $items->relationCounterparty->tel }}</span><br>
                <span>e-mail: {{ $items->relationCounterparty->email }}</span><br>
            </span>
    </div>
</div>

<div id="contract" class="contract">
    <div class="name">
        <span  for="" class="control-label">Договір:</span>
    </div>
    <div class="description">
            <span>
                <span class="">ком.усл.NoМК-353 від 14.04.2017р.</span><br>
            </span>
    </div>
</div>


<table>
    <thead>
    <tr>
        <th>№</th>
        <th>Наименование</th>
        <th style="text-align: center">Кол-во, шт</th>
        <th style="text-align: center">Цена, грн</th>
        <th style="text-align: center">Сумма, грн</th>
    </tr>
    </thead>
    @foreach($items->relationInvoiceOutgoing as $item)
        <tr style="font-size: 13px">
            <th>{{ $item->id }}</th>
            <th>{{ $item->relationProduct->name }}</th>
            <th style="text-align: center">{{ $item->quantity }}</th>
            <th style="text-align: center">{{ $item->price }}</th>
            <th style="text-align: center">{{ $item->price }}</th>
        </tr>
    @endforeach
</table>


<div id="sum" class="sum bold">
    <div class="right">
        <span class="">Всього:</span> <span>{{ $items->relationInvoiceOutgoing->sum('price') }}грн</span>
    </div>
</div>

<div id="total" class="total">
    <div class="left">
        <span class="">Всього найменувань:</span><span id="total-product"> {{ $items->relationInvoiceOutgoing->count('id') }}</span>, <span>на суму</span><span id="total-sum">&nbsp;{{ $items->relationInvoiceOutgoing->sum('price') }} </span>грн.
    </div>

    {{--<span class="bold">Двісті дев'ятнадцять гривень 73 копійки</span><br>

    <span class="bold">У т.ч. ПДВ: Тридцять шість гривень 62 копійки</span>--}}

</div>
<hr style="margin-top: 15px;">
<div id="person" class="person" style="float: right;">
    <div class="">
        <span class="bottom-line">Виписав(ла): <span class="bold">{{ Auth::user()->name }}</span></span>
    </div>
</div>





</body>
</html>
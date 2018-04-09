<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Приходная накладная</title>
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
            font-size: 12px;
        }
        thead tr, thead th {
            color: white;
            border: 1px solid #000;
            background-color: rgb(54, 75, 90) !important;
        }
    </style>
</head>
    <body>
        <h1>Приходная накладная</h1>
        <hr>
        <h4>Поставщик:</h4>
        <h4>Покупатель:</h4>
        <table>
            <thead>
            <tr>
                <th>№</th>
                <th>Наименование</th>
                <th>Количество, шт</th>
                <th>Цена, грн</th>
            </tr>
            </thead>
            @foreach($items as $item)
                <tr>
                    <th>{{ $item->id }}</th>
                    <th>{{ $item->relationProduct->name }}</th>
                    <th>{{ $item->quantity }}</th>
                    <th>{{ $item->price }}</th>
                </tr>
            @endforeach
        </table>
        <hr>
        <div class="row">
            <div class="col-md-3">
                <span>исполнитель:</span>
            </div>
        </div>
    </body>
</html>
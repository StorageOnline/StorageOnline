<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Товары</title>
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
        }
        thead tr, thead th {
            color: white;
            border: 1px solid #000;
            background-color: rgb(54, 75, 90) !important;
        }
    </style>
</head>
    <body>
    <h1>Товары</h1>
    <hr>
        <table>
            <thead>
                <tr>
                    <th>№</th>
                    <th>Наименование</th>
                    <th>Цена, грн</th>
                    <th>Количество, шт</th>
                </tr>
            </thead>
            @foreach($items as $item)
                <tr>
                    <th>{{ $item->id }}</th>
                    <th>{{ $item->name }}</th>
                    <th>{{ $item->price }}</th>
                    <th>{{ $item->quantity }}</th>
                </tr>
            @endforeach
        </table>
    </body>
</html>
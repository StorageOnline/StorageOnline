@extends('layouts.app')

@section('game')
    <h1>Игра 1</h1>
    <div id="game">
        <div id="test">@{{ test1 }}</div>
    </div>
@endsection

<script>
    let test = new Vue({
        el: '#test',
        data: {
            test1: 'Тестовая игра',
        }
    });
</script>
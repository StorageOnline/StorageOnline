@extends('layouts.app')

@section('content')
<div class="container small-container">
    <div class="row">
        <div class="col-md-12 small-column">
            <div class="panel panel-default">
                {{--<div class="panel-heading">Storage.Online Система управления складом онлайн</div>--}}
                <div class="panel-heading">{{ trans('menu.main_title') }}</div>

                <div class="panel-body">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif

                    Вы вошли!
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

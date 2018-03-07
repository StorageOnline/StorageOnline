@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-4"></div>
        <div class="col-md-4 login-block">
            <div class="panel panel-default panel-auth">
                <div class="panel-heading login">Login</div>

                <div class="panel-body">
                    <form class="form-horizontal" method="POST" action="{{ route('login') }}">
                        {{ csrf_field() }}

                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                            <!-- <label for="email" class="col-md-4 control-label">E-Mail Address</label> -->

                            <div class="col-md-12">
                                <input id="email" type="email" class="form-control email" name="email" value="{{ old('email') }}" required autofocus>
                                <i class="fa fa-envelope-o"></i>
                                @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                            <!-- <label for="password" class="col-md-4 control-label ">Password</label> -->

                            <div class="col-md-12">
                                <input id="password" type="password" class="form-control password" name="password" required>
                                <i class="fa fa-lock"></i>

                                @if ($errors->has('password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-7">
                                <div class="material-switch">
                                    
                                        <input id="remember" type="checkbox" name="remember" class="checkbox" required=""{{ old('remember') ? 'checked' : '' }}> Remember Me&nbsp;&nbsp;
                                        <label for="remember" class="label-success"></label>
                                </div>
                            </div>
                        <div class="col-md-5 login-wrapper">
                                <button type="submit" class="btn btn-primary btn-login">
                                    Login
                                </button>
                            </div>
                        </div>
                        <div class="col-md-12 forgot">
                            <a class="btn btn-link" href="{{ route('password.request') }}">
                                    Forgot Your Password?
                                </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-md-4"></div>

    </div>
</div>
@endsection

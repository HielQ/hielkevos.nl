
@extends('master')

@section('title')
    Login
@stop

@section('content')
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <form action="" method="POST" class="form-horizontal" id="loginForm">
                {!! csrf_field() !!}

                <div class="form-group">
                    <label>Login</label>
                    <input type="text" name="username" class="form-control" id="inputUsername" placeholder="Username" value="{{ (Session::has('username') ? Session::get('username') : '') }}">
                </div>

                <br />

                <div class="form-group">
                    <label>Password</label>
                     <input type="password" name="password" class="form-control" id="inputPassword" placeholder="Password">
                </div>

                <br />
                <br />

                <button type="submit" class="btn btn-primary btn-block">Sign in</button>
            </form>
        </div>
    </div>
@stop

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
                    <label>{{trans('login.username')}}</label>
                    <input type="text" name="username" class="form-control" id="inputUsername" placeholder="{{trans('login.username_text')}}" value="{{ (Session::has('username') ? Session::get('username') : '') }}"  required >
                </div>

                <br />

                <div class="form-group">
                    <label>{{trans('login.password')}}</label>
                     <input type="password" name="password" class="form-control" id="inputPassword" placeholder="{{trans('login.password_text')}}" required >
                </div>

                <br />
                <br />

                <button type="submit" class="btn btn-primary btn-block">{{trans('login.signin')}}</button>
            </form>
        </div>
    </div>
@stop
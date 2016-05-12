
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
                    <label>{{trans('home.username')}}</label>
                    <input type="text" name="username" class="form-control" id="inputUsername" placeholder="{{trans('home.username_text')}}" value="{{ (Session::has('username') ? Session::get('username') : '') }}">
                </div>

                <br />

                <div class="form-group">
                    <label>{{trans('home.password')}}</label>
                     <input type="password" name="password" class="form-control" id="inputPassword" placeholder="{{trans('home.password_text')}}">
                </div>

                <br />
                <br />

                <button type="submit" class="btn btn-primary btn-block">{{trans('home.signin')}}</button>
            </form>
        </div>
    </div>
@stop
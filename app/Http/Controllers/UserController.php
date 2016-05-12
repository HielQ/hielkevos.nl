<?php namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Redirect;

use Input, Auth;

class UserController extends Controller
{
    public  function login(Request $request)
    {
        if($request->isMethod('get'))
            return view('home.login');
        elseif ($request->isMethod('post')) {
            if($request->has('username') && $request->has('password'))
            {
                if (auth()->attempt(
                    [
                        'username' => Input::get('username'),
                        'password' => Input::get('password')
                    ]
                )) return Redirect::intended('/');
                else
                    return Redirect::to('/login')->with(
                        [
                            'type' => 'danger',
                            'message' => trans('error.login'),
                            'glyphicon' => 'glyphicon glyphicon-exclamation-sign'
                        ]
                    );
            } else
                return Redirect::to('/login')
                    ->with(
                        [
                            'type' => 'danger' ,
                            'message' => trans('error.missing'),
                            'glyphicon' => 'glyphicon glyphicon-exclamation-sign'

                        ]
                    )
                    ->withInput(Input::except('password'));
        } else
            return Redirect::to('/');
    }

    public function logout()
    {
        if (Auth::check())
        {
            Auth::logout();
            return Redirect::intended('/')->with(
                [
                    'message' => 'Logout successfull' , 'type' => 'success'
                ]
            );
        } else
            return Redirect::back();
    }


}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class HomeController extends Controller
{
    public function index()
    {
        return view('home.index');
    }

    public function about()
    {
        return view('home.about');
    }

    public function music()
    {
        $dt = new \DateTime();

        return view ('home.music', ['month' => $dt->format('F')]);
    }

    public function games()
    {
        $ch=curl_init();

        curl_setopt($ch, CURLOPT_URL, '');
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 1);
        curl_setopt($ch, CURLOPT_USERAGENT, 'HielQ');

        $json = curl_exec($ch);

        // get the http code

        $code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);

        if($code === 200) {
            $battlenet = json_decode($json);
        } else {
            $battlenet = [];
        }

        return view('home.games' , ['battlenet' => $battlenet]);
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */

    public function projects()
    {
        $ch=curl_init();

        curl_setopt($ch, CURLOPT_URL, 'https://api.github.com/users/HielQ/repos?sort=pushed');
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 1);
        curl_setopt($ch, CURLOPT_USERAGENT, 'HielQ');

        $json = curl_exec($ch);

        // Get the http code

        $code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);

        if($code === 200) {
            $github_projects = json_decode($json);
        } else {
            $github_projects = [];
        }


        return view('home.projects' ,['github_projects' => $github_projects]);
    }

    public function licenses()
    {
        return view('home.licenses');
    }

    public function clock() {
        return view('home.clock');
    }

    public function contact() {
        return view('home.contact');
    }


}

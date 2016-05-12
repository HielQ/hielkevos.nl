<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

class SessionController extends Controller
{

    public function saveLocale($locale)
    {
        if (!in_array($locale, ['en', 'nl', 'de']) || $locale === "")
            $locale = 'en'; // Default to english

        session()->set('locale', $locale);

        // Prevent the app from showing a message in the previous locale
        app()->setLocale($locale);

        return back()->with([
            'type' => 'success',
            'message' => trans('message.changedlocale'),
            'glyphicon' => 'glyphicon glyphicon-ok'
        ]);
    }


}

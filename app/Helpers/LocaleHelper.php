<?php namespace App\Helpers;

class LocaleHelper {

    public static $locales = [
        'en' => 'English',
        'nl' => 'Nederlands',
        'de' => 'Deutsch',
    ];

    public static function localeToString($locale)
    {
        if (key_exists($locale, self::$locales))
            return self::$locales[$locale];
        else
            return "Unknown locale";
    }

}
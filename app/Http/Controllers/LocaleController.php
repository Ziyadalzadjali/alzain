<?php

namespace App\Http\Controllers;

use App\Http\Middleware\SetLocale;

class LocaleController extends Controller
{
    public function switch(string $locale)
    {
        if (in_array($locale, SetLocale::SUPPORTED, true)) {
            session(['locale' => $locale]);
        }

        return back();
    }
}

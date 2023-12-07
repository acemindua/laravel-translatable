<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

class LanguageController extends Controller
{
    //

    public function change($locale)
    {
        app()->setLocale($locale);
        session()->put('locale', $locale);

        $segments = str_replace(url('/'), '', url()->previous());
        $segments = array_filter(explode('/', $segments));
        array_shift($segments);
        array_unshift($segments, LaravelLocalization::setLocale());
        return redirect()->to(implode('/', $segments));
    }
}

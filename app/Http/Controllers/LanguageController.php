<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;

class LanguageController extends Controller
{
    public function switchLang($lang)
    {
        Session::put('locale', $lang);
        return redirect()->back();
    }
}
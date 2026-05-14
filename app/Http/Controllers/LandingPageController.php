<?php

namespace App\Http\Controllers;

class LandingPageController extends Controller
{
    //

    public function home()
    {
        return view('welcome');
    }
}

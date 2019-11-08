<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class StaticPagesController extends Controller
{
    public function index()
    {
        echo __FUNCTION__;exit;
        return view('');
    }

    public function home()
    {
        return view('static_pages.home');
    }

    public function about()
    {
        echo __FUNCTION__;
    }

    public function help()
    {
        echo __FUNCTION__;
    }

    public function policy()
    {
        echo __FUNCTION__;
    }

}

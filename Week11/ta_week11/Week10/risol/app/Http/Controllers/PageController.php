<?php

namespace App\Http\Controllers;

class PageController extends Controller
{
    public function index()
    {
        return view('index');
    }

    public function login()
    {
        return view('login');
    }

    public function manage()
    {
        return view('manage');
    }
}
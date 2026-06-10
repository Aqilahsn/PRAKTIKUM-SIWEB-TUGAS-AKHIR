<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class RisolController extends Controller
{
    public function index()
    {
        return view('index');
    }

    public function manage()
    {
        return view('manage');
    }

    public function tambah(Request $request)
    {
        return redirect('/manage');
    }
}
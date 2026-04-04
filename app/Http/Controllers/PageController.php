<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PageController extends Controller
{
    public function historia()
    {
        return view('historia');
    }

    public function mision()
    {
        return view('mision');
    }
}

<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\View\View;

class AdminController extends Controller
{
    /**
     * Muestra el dashboard del panel administrativo.
     */
    public function index(): View
    {
        return view('admin.dashboard');
    }
}

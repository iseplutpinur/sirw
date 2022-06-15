<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index1(Request $request)
    {
        return view('templates.frontend1.master');
    }

    public function index2(Request $request)
    {
        return view('templates.frontend.master');
    }
}

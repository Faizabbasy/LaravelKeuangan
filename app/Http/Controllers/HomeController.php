<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Target;

class HomeController extends Controller
{
    function index()
    {
        $targets = Target::all();
        return view('home', compact('targets'));
    }
}

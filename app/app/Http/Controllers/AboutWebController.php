<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AboutWebController extends Controller
{
    public function index(){
        return view('about', ['active' => 'about']);
    }
}

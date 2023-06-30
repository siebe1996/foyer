<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeWebController extends Controller
{
    public function index(){
        return view('home', ['active' => 'home']);
    }
}

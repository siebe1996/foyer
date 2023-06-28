<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MoodboardWebController extends Controller
{
    public function index(){
        return view('moodboard', []);
    }
}

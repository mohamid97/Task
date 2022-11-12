<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * index function return user to welcome page
     */

    public function index(){
        return view('welcome');
    }
}

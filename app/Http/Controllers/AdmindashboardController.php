<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdmindashboardController extends Controller
{
    public function index(){
        return view('backend.layout.dashboard');
    }
}

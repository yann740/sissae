<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function administration()
    {
        return view('statistiques.administration');
    }
}
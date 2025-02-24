<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HoTroController extends Controller
{
    public function index()
    {
        return view('ho_tro');
    }
}
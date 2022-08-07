<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FrontController extends Controller
{
    public function index()
    {
        $types = [
            'Php',
            'Laravel',
            'Spatie'
        ];

        return view('index', compact('types'));
    }

    public function requestsInfo()
    {

    }
}

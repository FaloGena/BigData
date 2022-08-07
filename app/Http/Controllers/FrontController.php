<?php

namespace App\Http\Controllers;

use App\Models\CustomUser;
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
        $savedRequests = \App\Models\Request::query()->orderByDesc('id')->paginate(15);

        return view('requests', compact('savedRequests'));
    }

    public function clearTable()
    {
        CustomUser::query()->delete();

        return response()->redirectTo('/');
    }
}

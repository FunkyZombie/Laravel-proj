<?php

namespace App\Http\Controllers;


class MainController extends Controller
{
    public function index(string $name = null)
    {
        return view('main.index', [
            'name' => $name
        ]);
    }
}
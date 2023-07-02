<?php

namespace App\Http\Controllers\News;

use App\Http\Controllers\Controller;
use Illuminate\Contracts\View\View as View;
use Illuminate\Http\Request;
use \Illuminate\Filesystem\Filesystem;

class OrderController extends Controller
{

    public function index(Request $request): View
    {
        return view('news.order');
    }

    public function store(Request $request)
    {
        $fileWriter = new Filesystem();

        if (file_exists('./file.json')) {
            $file = $fileWriter->json('./file.json');

        } else {
            $file = [];
        }

        $file[] = $request->only(['name', 'phone', 'email','description']);

        $fileWriter->replace('./file.json', json_encode($file));

        dd($fileWriter->json('./file.json'));
    }
}
<?php

declare(strict_types=1);

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Parser\Store;
use App\Jobs\NewsParsingJob;
use App\Services\Contracts\Parser;
use Illuminate\View\View;

class ParserController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function index(): View
    {
        return view('admin.parser.create');
    }

    public function store(Store $request, Parser $parser) 
    {
        $list = explode(',', $request->validated()['link_list']);

        foreach ($list as $url) {
            dispatch(new NewsParsingJob(trim($url)));
        }
    }
}

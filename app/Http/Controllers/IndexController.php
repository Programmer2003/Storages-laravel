<?php

namespace App\Http\Controllers;

use App\Models\Storage;

class IndexController extends Controller
{
    public function __invoke()
    {
        $storages = Storage::all();
        return view('index',compact('storages'));
    }
}

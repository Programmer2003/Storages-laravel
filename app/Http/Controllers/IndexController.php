<?php

namespace App\Http\Controllers;

use App\Models\Storage;
use Illuminate\Http\Request;

class IndexController extends Controller
{
    public function __invoke()
    {
        $storages = Storage::all();
        return view('index',compact('storages'));
    }
}

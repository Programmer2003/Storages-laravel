<?php

namespace App\Http\Controllers\Product;

use App\Http\Requests\Product\StoreRequest;
use App\Http\Resources\Product\Resource;
use Illuminate\Http\Request;

class ArrayController extends BaseController
{
    public function __invoke(Request $request)
    {
        $data = $request->input('array');
        dump($data);
        return $data;
    }
}

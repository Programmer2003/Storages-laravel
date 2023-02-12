<?php

namespace App\Http\Controllers\Product;

use App\Models\Product;

class ShowController extends BaseController
{
    public function __invoke(Product $product)
    {
        dump('show');
        dd($product);
        return view('storage.index', compact('storages'));
    }
}

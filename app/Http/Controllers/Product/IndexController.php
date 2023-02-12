<?php

namespace App\Http\Controllers\Product;

use App\Models\Storage;

class IndexController extends BaseController
{
    public function __invoke(Storage $storage)
    {
        $products = $storage->products;

        return view('product.index', compact('storage', 'products'));
    }
}

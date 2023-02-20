<?php

namespace App\Http\Controllers\Product;

use App\Http\Resources\Product\Resource;
use App\Models\Product;

class ShowController extends BaseController
{
    public function __invoke(Product $product)
    {
        return view('partials.product', ['product' => $product]);
    }
}

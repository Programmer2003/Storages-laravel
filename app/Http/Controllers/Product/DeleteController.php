<?php

namespace App\Http\Controllers\Product;

use App\Models\Product;

class DeleteController extends BaseController
{
    public function __invoke(Product $product)
    {
        $category = $product->category;
        return view('product.delete', compact('product','category'));
    }
}

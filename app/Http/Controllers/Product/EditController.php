<?php

namespace App\Http\Controllers\Product;

use App\Models\Product;
use App\Models\Storage;

class EditController extends BaseController
{
    public function __invoke(Storage $storage, Product $product)
    {
        $categories = $storage->lastCategories;
        return view('product.edit', compact('categories', 'product'));
    }
}

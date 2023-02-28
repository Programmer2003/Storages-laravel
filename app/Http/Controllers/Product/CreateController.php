<?php

namespace App\Http\Controllers\Product;

use App\Models\Storage;

class CreateController extends BaseController
{
    public function __invoke(Storage $storage)
    {
        $categories = $storage->lastCategories;
        return view('product.create', compact('categories'));
    }
}

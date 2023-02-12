<?php

namespace App\Http\Controllers\Product;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Storage;
use Illuminate\Http\Request;

class EditController extends BaseController
{
    public function __invoke(Storage $storage, Product $product)
    {
        $categories = $storage->categories;
        return view('product.edit', compact('categories', 'product'));
    }
}

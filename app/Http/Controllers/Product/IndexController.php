<?php

namespace App\Http\Controllers\Product;

use App\Models\Category;
use App\Models\Closure;
use App\Models\Storage;

class IndexController extends BaseController
{
    public function __invoke(Storage $storage)
    {
        $categories = Category::mainCategories($storage);
        return view('product.list', compact('categories'));

        $products = $storage->products;
        return view('product.index', compact('storage', 'products'));
    }
}

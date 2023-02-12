<?php

namespace App\Http\Controllers\Product;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use App\Models\Storage;
use Illuminate\Http\Request;

class IndexController extends BaseController
{
    public function __invoke(Storage $storage)
    {
        $products = $storage->products;

        return view('product.index', compact('storage', 'products'));
    }
}

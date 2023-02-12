<?php

namespace App\Http\Controllers\Product;

use App\Http\Controllers\Controller;
use App\Models\Storage;
use Illuminate\Http\Request;

class CreateController extends BaseController
{
    public function __invoke(Storage $storage)
    {
        $categories = $storage->categories;
        return view('product.create', compact('categories'));
    }
}

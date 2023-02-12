<?php

namespace App\Http\Controllers\Product;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Storage;
use Illuminate\Http\Request;

class DeleteController extends BaseController
{
    public function __invoke(Product $product)
    {
        dump('delete');
        dd($product);
        return view('storage.index', compact('storages'));
    }
}

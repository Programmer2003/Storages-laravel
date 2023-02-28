<?php

namespace App\Http\Controllers\Product;

use App\Models\Category;
use App\Models\Closure;
use App\Models\Income;
use App\Models\Product;
use App\Models\ProductsIncomes;
use App\Models\Storage;
use Illuminate\Http\Request;

class IncomeController extends BaseController
{
    public function index(Storage $storage)
    {
        $products = Product::all();
        $categories = Category::lastCategories($storage);
        $TTH = random_int(100000, 999999);
        return view('product.income', compact('categories', 'storage', 'TTH'));
    }

    public function store(Request $request)
    {
        $array = $request->input('array');
        $TTH = $request->input('TTH');
        $income = Income::Create([
            'TTH' => $TTH,
        ]);

        foreach ($array as $item) {
            $item['TTH'] = $income->TTH;
            ProductsIncomes::create(
                $item
            );
        }
    }

    public function getProductPrice(Request $request)
    {
        $id = $request->input('id');
        return ProductsIncomes::where('product_id', '=', $id)->latest()->first()->price;
    }
}

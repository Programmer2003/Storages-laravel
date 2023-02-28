<?php

namespace App\Http\Controllers\Product;

use App\Models\Category;
use App\Models\Closure;
use App\Models\Expense;
use App\Models\Product;
use App\Models\ProductsExpense;
use App\Models\Storage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ExpenseController extends BaseController
{
    public function index(Storage $storage)
    {
        $products = DB::table('products_incomes')
            ->join('products', 'products.id', '=', 'products_incomes.product_id')
            ->select(DB::raw('product_id as id'), 'products.name', DB::raw('sum(`products_incomes`.`count`) - ifnull((select sum(`products_expenses`.`count`) from `products_expenses` where `products_expenses`.`product_id` = `products_incomes`.`product_id`),0) as products_left'))
            ->groupBy('product_id', 'products.name')
            ->having('products_left', '>', '0')
            ->get();

        $categories = Category::lastCategories($storage);
        $TTH = random_int(100000, 999999);
        return view('product.expense', compact('products', 'categories', 'TTH'));
    }

    public function store(Request $request)
    {
        $array = $request->input('array');
        $TTH = $request->input('TTH');
        $income = Expense::Create([
            'TTH' => $TTH,
        ]);

        foreach ($array as $item) {
            $item['TTH'] = $income->TTH;
            ProductsExpense::create(
                $item
            );
        }
    }
}

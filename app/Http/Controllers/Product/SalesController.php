<?php

namespace App\Http\Controllers\Product;

use App\Models\Storage;
use Illuminate\Support\Facades\DB;

class SalesController extends BaseController
{
    public function __invoke(Storage $storage)
    {
        $products = DB::table('products_incomes')
            ->join('products', 'products.id', '=', 'products_incomes.product_id')
            ->select(
                'products.name'
                ,DB::raw('ifnull((select sum(products_expenses.count * products_expenses.price) from products_expenses where products_expenses.product_id = products_incomes.product_id),0) as sum')
                ,DB::raw('sum(`products_incomes`.`count`) - ifnull((select sum(`products_expenses`.`count`) from `products_expenses` where `products_expenses`.`product_id` = `products_incomes`.`product_id`),0) as products_left')
            )
            ->groupBy('product_id', 'products.name')
            ->get();

        return view('product.sales', compact('storage','products'));
    }
}

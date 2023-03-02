<?php

use App\Http\Controllers\PdfContoller;
use App\Http\Controllers\Product\ExpenseController;
use App\Http\Controllers\Product\IncomeController;
use App\Http\Controllers\Product\IndexController;
use App\Models\Category;
use App\Models\Product;
use App\Models\Storage;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


Route::get('/', 'IndexController')->name('index');

Route::group(['namespace' => 'Category'], function () {
    Route::get('/category', 'ProductsController')->name('category.products');
});

Route::group(['namespace' => 'Product'], function () {
    Route::post('/getProduct', [IncomeController::class, 'getProductPrice'])->name('product.getPrice');

    Route::get('/{storage}/products/', 'IndexController')->name('product.index');
    Route::get('/{storage}/products/create', 'CreateController')->name('product.create');
    Route::post('/products', 'StoreController')->name('product.store');
    Route::post('/products/{product}', 'ShowController')->name('product.show');
    Route::get('/{storage}/products/{product}/edit', 'EditController')->name('product.edit');
    Route::patch('/products/{product}', 'UpdateController')->name('product.update');
    Route::get('/products/{product}/delete', 'DeleteController')->name('product.delete');
    Route::delete('/products/{product}', 'DestroyController')->name('product.destroy');
    Route::get('/{storage}/income/', [IncomeController::class, 'index'])->name('product.income');
    Route::get('/{storage}/expense/', [ExpenseController::class, 'index'])->name('product.expense');
    Route::get('/{storage}/sales/', 'SalesController')->name('product.sales');

    Route::post('/income', [IncomeController::class, 'store'])->name('product.income_store');
});

Route::get('/{storage}/pdf', [PdfContoller::class, 'createPDF'])->name('product.pdf');
Route::get('/pdfView', [PdfContoller::class, 'pdfView'])->name('product.pdfView');


Route::get('/pdf2', function (Storage $storage) {
    $storage = Storage::first();
    $categories = Category::mainCategories($storage);
    $array = array();
    foreach ($categories as $category) {
        $closure = DB::table('closures')
            ->where('ancestor', '=', $category->id)
            ->pluck('descendant')->toArray();
        $products = DB::table('incomes')
            ->join('products_incomes', 'products_incomes.TTH', '=', 'incomes.TTH')
            ->join('products', 'products.id', '=', 'products_incomes.product_id')
            ->join('closures', 'closures.descendant', '=', 'products.category_id')
            ->whereIn('closures.ancestor', $closure)
            ->select(
                'incomes.created_at',
                'products.name',
                'count',
                'price',
                DB::raw('price*count as sum'),
                DB::raw('sum(`count`) - ifnull(
                    (select sum(`products_expenses`.`count`) 
                         from `products_expenses` where `products_expenses`.`product_id` = `products_incomes`.`product_id`)
                    ,0) as products_left '),
            )
            ->groupBy('products.id')
            ->having('products_left','>','0')
            ->orderByDesc('products_left')
            ->get();
        if (count($products)) {
            $array[$category->name] = $products;
        }
    }

    return view('pdf.products', compact('array'));
});

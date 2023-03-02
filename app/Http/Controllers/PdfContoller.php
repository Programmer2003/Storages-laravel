<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Storage;
use Illuminate\Support\Facades\DB;
use PDF;

class PdfContoller extends Controller
{
    // public function showEmployees()
    // {
    //     $storage = Storage::first();
    //     $incomes = $this->getIncomeArray($storage);
    //     $expenses = $this->getExpenseArray($storage);
    //     return view('pdf.invoice', compact('incomes', 'expenses'));
    // }

    public  function pdfView(Storage $storage)
    {
        $storage = Storage::Find(2);
        $incomes = $this->getIncomeArray($storage);
        $expenses = $this->getExpenseArray($storage);
        $balance = $this->getBalanceArray($storage);
        return view('pdf.invoice', compact('incomes', 'expenses', 'balance'));
    }
    public function createPDF(Storage $storage)
    {
        $incomes = $this->getIncomeArray($storage);
        $expenses = $this->getExpenseArray($storage);
        $balance = $this->getBalanceArray($storage);
        $pdf = PDF::loadView('pdf.invoice', [
            'incomes' => $incomes,
            'expenses' => $expenses,
            'balance' => $balance
        ]);
        // download PDF file with download method
        return $pdf->download('pdf_file.pdf');
    }

    public function getIncomeArray(Storage $storage)
    {
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
                ->select('incomes.created_at', 'incomes.TTH', 'products.name', 'count', 'price', DB::raw('price*count as sum'))
                ->get();
            if (count($products)) {
                $array[$category->name] = $products;
            }
        }

        return $array;
    }

    public function getExpenseArray(Storage $storage)
    {
        $categories = Category::mainCategories($storage);
        $array = array();
        foreach ($categories as $category) {
            $closure = DB::table('closures')
                ->where('ancestor', '=', $category->id)
                ->pluck('descendant')->toArray();
            $products = DB::table('expenses')
                ->join('products_expenses', 'products_expenses.TTH', '=', 'expenses.TTH')
                ->join('products', 'products.id', '=', 'products_expenses.product_id')
                ->join('closures', 'closures.descendant', '=', 'products.category_id')
                ->whereIn('closures.ancestor', $closure)
                ->select('expenses.created_at', 'expenses.TTH', 'products.name', 'count', 'price', DB::raw('price*count as sum'))
                ->get();
            if (count($products)) {
                $array[$category->name] = $products;
            }
        }

        return $array;
    }

    public function getBalanceArray(Storage $storage)
    {
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
                ->having('products_left', '>', '0')
                ->orderByDesc('products_left')
                ->get();
            if (count($products)) {
                $array[$category->name] = $products;
            }
        }

        return $array;
    }
}

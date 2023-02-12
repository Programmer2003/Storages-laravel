<?php

namespace App\Services\Product;

use App\Models\Product;

class Service
{
    public function store($data)
    {
        return Product::create($data);
    }

    public function update($product, $data)
    {
        $product->update($data);
        return $product->fresh();
    }

    public function destroy($product)
    {
        $product->delete();
    }
}

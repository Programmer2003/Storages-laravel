<?php

namespace App\Http\Controllers\Product;

use App\Http\Resources\Product\Resource;
use App\Models\Product;

class DestroyController extends BaseController
{
    public function __invoke(Product $product)
    {
        $this->service->destroy($product);

        return new Resource($product);
    }
}

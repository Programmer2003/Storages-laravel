<?php

namespace App\Http\Controllers\Product;

use App\Http\Requests\Product\UpdateRequest;
use App\Http\Resources\Product\Resource;
use App\Models\Product;

class UpdateController extends BaseController
{
    public function __invoke(UpdateRequest $request, Product $product)
    {
        $data = $request->validated();

        $updated = $this->service->update($product, $data);

        return new Resource($updated);
    }
}

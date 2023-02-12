<?php

namespace App\Http\Controllers\Product;

use App\Http\Controllers\Controller;
use App\Http\Requests\Product\UpdateRequest;
use App\Http\Resources\Product\Resource;
use App\Models\Product;
use Illuminate\Http\Request;

class UpdateController extends BaseController
{
    public function __invoke(UpdateRequest $request, Product $product)
    {
        return 1;
        $data = $request->validated();

        $updated = $this->service->update($product, $data);

        return new Resource($updated);
    }
}

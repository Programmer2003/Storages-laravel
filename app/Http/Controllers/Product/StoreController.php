<?php

namespace App\Http\Controllers\Product;

use App\Http\Controllers\Controller;
use App\Http\Requests\Product\StoreRequest;
use App\Http\Resources\Product\Resource;
use App\Models\Product;
use App\Models\Storage;
use Illuminate\Http\Request;

class StoreController extends BaseController
{
    public function __invoke(StoreRequest $request)
    {
        $data = $request->validated();
        
        $product = $this->service->store($data);

        return new Resource($product);
    }
}

<?php

namespace App\Http\Controllers\api;

use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\ProductResource;
use App\Http\Controllers\BaseController;

class ProductController extends BaseController
{
    public function product(){
        $products = Product::all();
        return $this->sendResponse(ProductResource::collection($products), 'products recived');
    }
}

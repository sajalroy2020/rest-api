<?php

namespace App\Http\Controllers\api;

use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\ProductResource;
use App\Http\Controllers\BaseController;
use Validator;

class ProductController extends BaseController
{
    public function product(){
        $products = Product::all();
        return $this->sendResponse(ProductResource::collection($products), 'products recived');
    }

    public function productStore(Request $request){
        $validation = Validator::make($request->all(),[
            'title' => 'required|string',
            'description' => 'required',
        ]);

        if ($validation->fails()) {
            return $this->sendError('something went rong !..', $validation->errors());
        }
        $product = Product::create($request->all());
        return $this->sendResponse(new ProductResource($product), 'product created successfully');
    }

    public function productEdit($id){
        $editProduct = Product::find($id);
        if (is_null($editProduct)) {
            return $this->sendError('Product not found !..');
        }
        return $this->sendResponse(new ProductResource($editProduct), 'Edit product');
    }

}

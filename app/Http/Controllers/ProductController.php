<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     *商品詳細
     */
    public function show(Product $product){
        return view('products.show',[
            'product'=> $product
        ]);
    }
}

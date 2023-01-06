<?php

namespace App\Http\Controllers;

use App\Filters\ProductFilter;
use Illuminate\Http\Request;

use App\Models\Product;

class ProductController extends Controller
{
    public function get(ProductFilter $req) {

        $products = Product::filter($req)->get();

        return $products;
    }
}

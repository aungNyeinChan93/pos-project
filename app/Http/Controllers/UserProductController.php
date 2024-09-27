<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class UserProductController extends Controller
{
    //product detail page
    public function detail(Product $product)
    {
        $product = Product::select("products.id", "products.name", "products.description", "products.photo", "products.price", "products.stock", "categories.name as categoryName", )
            ->leftJoin("categories", "categories.id", "products.category_id")
            ->where("products.id", $product->id)
            ->first();

        $relativeProducts = Product::select("products.id", "products.name", "products.description", "products.photo", "products.price", "products.stock", "categories.name as categoryName", )
            ->leftJoin("categories", "categories.id", "products.category_id")
            ->where("categories.name", $product->categoryName)
            ->where("products.id","!=",$product->id)
            ->get();

        // dd($relativeProducts->toArray());

        return view("user.product.detail", compact('product',"relativeProducts"));
    }
}

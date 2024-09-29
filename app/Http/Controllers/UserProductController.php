<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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

    // add to cart
    public function addCart(Request $request){
        // dd($request->all());
        $cart= Cart::create([
            "user_id"=>$request->user_id,
            "product_id"=>$request->product_id,
            "Qty"=>$request->qty,
        ]);
        return to_route("userHome")->with("addCart","Products added to cart");
    }

    // cart page
    public function cartPage(){
        $products = Product::select("products.name","carts.Qty","products.photo","products.price","products.id","carts.id as cart_id")
                ->rightJoin("carts","carts.product_id","products.id")
                ->where("carts.user_id",Auth::user()->id)
                ->get();
        $total = 0;
        foreach($products as $product){
            $total += $product->price * $product->Qty;
        }
        // dd($total);
        return view("user.product.cart",compact("products","total"));
    }

    // payment order
}

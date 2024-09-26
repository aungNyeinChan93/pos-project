<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

class UserController extends Controller
{
    public function index()
    {

        $categories = Category::all();
        $products = Product::select("products.name", "products.price", "products.description", "products.photo", "products.stock", "categories.name as categoryName")
            ->leftJoin("categories", "categories.id", "=", "products.category_id")
            ->when(request()->categoryId != null, function ($query) {
                $query->where("products.category_id", "=", request()->categoryId);
            })
            ->when(request()->searchKey, function ($query) {
                $query->whereAny(["products.name", "products.description", "products.stock", "categories.name"], "like", "%" . request()->searchKey . "%");
            })
            ->when(request()->min != null && request()->max == "", function ($query) { //true -false
                $query->where("products.price",">=", request()->min);
            })
            ->when(request()->min == "" && request()->max != null, function ($query) { //false -true
                $query->where("products.price","<=", request()->max);
            })
            ->when(request()->min != null && request()->max != null, function ($query) { //true -true
                $query = $query->whereBetween("products.price", [request()->min, request()->max]);
            })
            ->when(request()->filter,function($query){
                $filter = explode(",",request()->filter);
                $filter_field = $filter[0];
                $filter_rule = $filter[1];
                $query->orderBy("products.".$filter_field,$filter_rule);
            })
            ->get();
            // dd($categories);
            // dd($filter_field,$filter_rule);
            // dd(explode(",", request()->filter));

        return view("user.home.list", compact("products", "categories"));

    }
}

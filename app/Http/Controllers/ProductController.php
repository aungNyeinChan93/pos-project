<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class ProductController extends Controller
{
    // createPage product
    public function createPage(){
        $categories = Category::all();
        return view("admin.product.create",compact("categories"));
    }

    // create product
    public function create(Request $request){

        $this->productValidation($request ,"create");

        $productData = $this->productData($request);

        if(request()->hasFile("photo")){
            $fileName = uniqid(). request()->file("photo")->getClientOriginalName();
            $request->file("photo")->move(public_path()."/products/",$fileName);
            $productData["photo"]= $fileName;
        }

        $products = Product::create($productData);
        Alert::alert('Product Create', 'Product Create Successful!!!' );
        return back();

    }

    // Product listPage
    public function listPage($amount ="default"){

        $products = Product::select("products.name","products.id","products.description","products.photo","products.price","products.stock","products.category_id","categories.name as categoryName")
                    ->leftJoin("categories","categories.id","=","products.category_id")
                    ->when(request()->searchKey,function($query){
                        $query->whereAny(["products.name","products.description","categories.name"],"like","%".request()->searchKey."%");
                    })
                    ->when($amount == "highStock",function($query){
                        $query->where("products.stock",">=",10);
                    });
        // dd($products->get()->toArray());

        if($amount == "lowStock"){
            $products= $products->where("stock","<=",3);
        }

        $products= $products->orderBy("products.created_at","desc")->get();

        return view("admin.product.listPage",compact("products"));
    }

    // detail product
    public function detail(Product $product){
        // dd($product->toArray());
        return view("admin.product.detail",compact("product"));
    }

    // edit product
    public function edit(Product $product){
        // dd($product);
        $categories = Category::all();
        return view("admin.product.edit",compact(["product","categories"]));
    }

    // update product
    public function update(Request $request, Product $product){
        // dd($product->photo);
        $this->productValidation($request ,"update");
        $updateData = $this->productData($request);
        if($request->file("photo")){
            if(file_exists(public_path("/products/".$product->photo))){
                unlink(public_path("/products/".$product->photo));
            }
            $fileName = uniqid(). request()->file("photo")->getClientOriginalName();
            $request->file("photo")->move(public_path()."/products/",$fileName);
            $updateData["photo"]= $fileName;
        }else{
            $updateData["photo"]= $product->photo;
        }
        $product->update($updateData);

        Alert::alert('Product update', 'Product update Successful!!!' );

        return to_route("product#listPage");

    }

    // delete product
    public function delete(Product $product){
        $product->delete();
        Alert::alert('Product delete', 'Product delete Successful!!!' );
        return to_route("product#listPage");
    }


    #######  Function  #######

    // productValidation
    private function productValidation($request , $action){
        $rules= [
            "name"=>"required|min:1|max:50|unique:products,name,".$request->product_id,
            "category_id"=>"required",
            "price"=>"required",
            "stock"=>"required",
            "description"=>"required",

        ];
        $rules["photo"]= $action =="update" ? "mimes:jpeg,jpg,png,gif":"required|mimes:jpeg,jpg,png,gif,";
        $messages= [];
        $request->validate($rules,$messages);
    }

    // productData
    private function productData($request){
        return [
            "name"=>$request->name,
            "price"=>$request->price,
            "stock"=>$request->stock,
            "category_id"=>$request->category_id,
            "description"=>$request->description,
        ];
    }

}

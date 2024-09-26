<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Mail\CategoryMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use RealRashid\SweetAlert\Facades\Alert;

class CategoryController extends Controller
{
    //category list
    public function list(){
        $categories = Category::orderBy("id","asc")->paginate(5);
        return view("admin.category.list",compact("categories"));
    }

    // create category
    public function create(Request $request){
        $valitaded = $request->validate([
            "name" =>"required",
        ],[
            "name.required"=> "Category name is required!",
        ]);
        $category = Category::create($valitaded);
        Alert::alert('Category create', 'Create Success!' );

        defer(function() use($category){
            Mail::to(Auth::user()->email)->send(new CategoryMail($category));
        });

        return back();
    }

    // edit category
    public function edit(Category $category){
        return view("admin.category.edit",compact("category"));
    }

    // update category
    public function update(Request $request , Category $category){
        $validated = $request->validate([
            "name"=>"required",
        ]);
        $category->update($validated);
        Alert::alert('Category update', 'Update Success!' );
        return to_route("category#list");
    }

    // delete category
    public function delete(Category $category){
        $category->delete();
        Alert::alert('Category delete', 'Delete Success!' );
        return back();
    }

}

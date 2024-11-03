<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index(){
        $categories =Category::all();
        return view('category.categorylist',compact('categories'));
    }

    public function addcategory(){
        return view('category.addcategory');
    }
    public function create(Request $req){
      $category=new Category();

      $category->category_name = $req->name;
      $category->save();
      return redirect('/category-list');
    }

    public function editcategory($id){
        $category =Category::find($id);
        return view('category.editcategory',compact('category')); 
    }

    public function updatecategory(Request $req, $id){
      $category=Category::find($id);
      $category->category_name =$req->name;
      $category->update();
      return redirect('/category-list');
    }

    public function categorydelete($id){
      $category=Category::find($id);
      $category->delete();
      return redirect('/category-list');
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Items;
use App\Models\Category;
use Illuminate\Http\Request;

class ItemsController extends Controller
{
    public function index(){
        $items =Items::all();
        return view('items.item',compact('items'));
    }
    public function additem(){
        $categories = Category::all();
        return view('items.addItem',compact('categories'));
    }

    public function createitem(Request $req){
        $item=new Items();
        $item->art_code = $req->aname;
        $item->lead_category = $req->lead_category;
        $item->composition = $req->composition;
        $item->width = $req->width;
        $item->grmt = $req->grmt;
        $item->price = $req->price;
        $item->save();
        \Jeybin\Toastr\Toastr::success('Item saved Successfully')->toast();
        return redirect('/items-list');

    }

    public function edititem($id){

      $item=Items::find($id);
       $categories = Category::all();
       return view('items.edititem',compact('item','categories'));
    }

    public function updateitem(Request $req,$id){
      $item=Items::find($id);

      $item->art_code = $req->aname;
      $item->lead_category = $req->lead_category;
      $item->composition = $req->composition;
      $item->width = $req->width;
      $item->grmt = $req->grmt;
      $item->price = $req->price;
      $item->update();
       \Jeybin\Toastr\Toastr::success('Item Updated Successfully')->toast();
      return redirect('/items-list');

    }

    public function deleteitem($id){
        $item=Items::find($id);
        $item->delete();
        \Jeybin\Toastr\Toastr::success('Item Deleted Successfully')->toast();
        return redirect('/items-list');

    }
}

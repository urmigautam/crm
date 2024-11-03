<?php

namespace App\Http\Controllers;

use App\Models\Company;
use App\Models\PlaceOfBusiness;
use Illuminate\Http\Request;

class PlaceOfBusinessController extends Controller
{
    public function index(){
     
        $bussiness = PlaceOfBusiness::with('company')->get();
      
        return view('business_place.list',compact('bussiness'));

    }
    public function addnew(){
        $allcompanies = Company::all();
        return view('business_place.addBusiness',compact('allcompanies'));
    }
    public function create(Request $req){
      
       $business =new PlaceOfBusiness();
       $business->place_name =$req->name;
       $business->company_id =$req->company;
       $business->save();
       return redirect('/place-of-bussiness');

    }

    public function edit($id){
    //  $business =PlaceOfBusiness::find((int)$id);
     $business =PlaceOfBusiness::find((int)$id);

     $allcompanies = Company::all();
     return view('business_place.editBusiness',compact('business','allcompanies'));
    }

    public function update(Request $req,$id){
        $business =PlaceOfBusiness::find((int)$id);
        $business->place_name =$req->name;
        $business->company_id =$req->company;
        $business->update();
        return redirect('/place-of-bussiness');
    }
    public function deleteedit($id){
        $business =PlaceOfBusiness::find((int)$id);
        $business->delete();
        return redirect('/place-of-bussiness');
    }
}

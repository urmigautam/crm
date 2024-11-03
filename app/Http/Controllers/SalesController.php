<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\FollowUp;
use App\Models\Lead;
use App\Models\PlaceOfBusiness;
use App\Models\Refrence;
use Illuminate\Http\Request;

class SalesController extends Controller
{
    public function index(){
       
        $allCustomers= Lead::where("status","Customer")->get();
       
        return view('sales.customers',compact('allCustomers'));
    }
    public function edit($id){
        
        $category =Category::all();
        $referedby=Refrence::all();
        $place_of_business =PlaceOfBusiness::all();
      $customer = Lead::find($id);
      $customerid=$customer->company_name[0] .'-'. $customer->place_of_bussiness==null ? "N":"$customer->place_of_bussiness[0]".'-'.$customer->id;
        
    //   $follows = FollowUp::where("company_id",$id)->first();
      $allfollowups =FollowUp::where("company_id",$id)->get();
    
      return view('sales.editcustomer',compact('customer','category','referedby','place_of_business','customerid','allfollowups'));
    }
}

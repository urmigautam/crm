<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Lead;
use App\Models\PlaceOfBusiness;
use App\Models\Refrence;
use Illuminate\Http\Request;

class OnboardingController extends Controller
{
    public function index(){
        $allOnboarding = Lead::where("status","Qualify")->get();
        return view('onboarding.listOfonboarded',compact('allOnboarding'));
    }
    public function editOnboarding($id){
        
        $category =Category::all();
        $referedby=Refrence::all();
        $place_of_business =PlaceOfBusiness::all();
        $Onboarding = Lead::where("status","Qualify")->where("id",$id)->first();
        $customerid=$Onboarding->company_name[0] .'-'. $Onboarding->place_of_bussiness==null ? "N":"$Onboarding->place_of_bussiness[0]".'-'.$Onboarding->id;
        
        return view('onboarding.editOnboarding',compact('Onboarding','category','referedby','place_of_business','customerid'));
    }

    public function updateOnboarding(Request $req,$id){
       $onboard =Lead::find($id);
       $onboard->vat_gst = $req->gst;
       $onboard->shipping_address = $req->shippingadd;
       $onboard->status = 'Customer';
       $onboard->update();

       return redirect('/on-boarding');
    }
}

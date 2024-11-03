<?php

namespace App\Http\Controllers;

use App\Models\Contries;
use App\Models\PlaceOfBusiness;
use App\Models\States;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Lead;
use App\Http\Requests\StoreLeadRequest;
use App\Http\Requests\UpdateLeadRequest;
use App\Models\Refrence;
use Auth;

class LeadController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
        // $alllead =Lead::where('status','Generate')->get();
        $alllead =Lead::all();

        return view('Lead.leads',compact('alllead'));
    }

    public function createLead()
    {
        $countries = Contries::all();
        $category =Category::all();
        $referedby=Refrence::all();
        return view('Lead.addlead',compact('referedby','category','countries'));
    }

    public function addnewlead(Request $req){
        
        $country_name = Contries::where('id',$req->country)->first();
        $country_code = $country_name->code;
        $inputString = $req->cname;

       $length = strlen($inputString);
       if ($length > 0) {
       $firstCharacter = substr($inputString, 0, 1);
       $middleCharacter = substr($inputString, floor($length / 2), 1);
       $lastCharacter = substr($inputString, -1);
       $newString = $firstCharacter . $lastCharacter . $middleCharacter;
       }
        $state = States::where('id',$req->state)->first();
        $inputString =$state->name;
       
        $firstThreeCharacters = substr($inputString, 0, 3);

       
        $leadname = $newString. "-" .$country_code. "-" .$firstThreeCharacters;
        $lead=new Lead();
        $lead->company_name =$req->cname;
        $lead->address =$req->caddress;
        $lead->phone =$req->phone;
        $lead->email =$req->email;
        $lead->refered_by =$req->referedby;
        $lead->lead_name =$leadname;
        $lead->status ="Generate";
        $lead->contactperson1 =$req->contactperson1;
        $lead->contactemail1 =$req->contactemail1;
        $lead->contactmobile1 =$req->contactmobile1;
        $lead->contactperson2 =$req->contactperson2;
        $lead->contactemail2 =$req->contactemail2;
        $lead->contactmobile2 =$req->contactmobile2;

        $lead->save();
        \Jeybin\Toastr\Toastr::success('Lead Created Sucessfully')->toast();
        return redirect('/leads');

        
    }

    public function editlead($id){
        $countries = Contries::all();
        $category =Category::all();
        $referedby=Refrence::all();
        $lead=Lead::find($id);
         return view('Lead.editlead',compact('lead','referedby','category','countries'));
    }

    public function updatelead(Request $req,$id){


        $country_name = Contries::where('id',$req->country)->first();
        $country_code = $country_name->code;
        $inputString = $req->cname;

       $length = strlen($inputString);
       if ($length > 0) {
       $firstCharacter = substr($inputString, 0, 1);
       $middleCharacter = substr($inputString, floor($length / 2), 1);
       $lastCharacter = substr($inputString, -1);
       $newString = $firstCharacter . $lastCharacter . $middleCharacter;
       }
        $state = States::where('id',$req->state)->first();
        $inputString =$state->name;
       
        $firstThreeCharacters = substr($inputString, 0, 3);

       
        $leadname = $newString. "-" .$country_code. "-" .$firstThreeCharacters;

        $lead=Lead::find((int)$id);
        
        $lead->company_name =$req->cname;
        $lead->address =$req->caddress;
        $lead->phone =$req->phone;
        $lead->email =$req->email;
        $lead->lead_name =$leadname;
        $lead->refered_by =$req->referedby;
        $lead->contactperson1 =$req->contactperson1;
        $lead->contactemail1 =$req->contactemail1;
        $lead->contactmobile1 =$req->contactmobile1;
        $lead->contactperson2 =$req->contactperson2;
        $lead->contactemail2 =$req->contactemail2;
        $lead->company_id =Auth::guard('admin')->user()->company_id;

        $lead->update();
         \Jeybin\Toastr\Toastr::success('Lead Updated Sucessfully')->toast();
        return redirect('/leads');
    }

    public function qualifiedleads(){
        $status=['Generate'];
        $leads=Lead::whereIn('status',$status)->get();
        return view('Lead.qualifiedleads',compact('leads'));
    }

    public function editqualifiedleads($id){
       
        $place_of_business = PlaceOfBusiness::all();
        $lead=Lead::find((int)$id);
        $customerid=$lead->company_name[0] .'-'. $lead->place_of_bussiness==null ? "N":"$lead->place_of_bussiness[0]".'-'.$lead->id;
        return view('Lead.edit-qualified-lead',compact('lead','place_of_business','customerid'));
    }

    public function updatequalifiedlead(Request $req, $id){
       
        
        $lead =Lead::find($id);
        $lead->status='Qualify';
        $lead->place_of_bussiness=$req->pob;
        $lead->payment_type=$req->paymentType;
        $lead->business_type=$req->businessType;
        $lead->status=$req->qualify == 'yes'? "Qualify":"Rejected";

        $lead->update();
         \Jeybin\Toastr\Toastr::success('Qualified-Lead Updated Sucessfully')->toast();
        return redirect('/lead-qualified');
        
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreLeadRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreLeadRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Lead  $lead
     * @return \Illuminate\Http\Response
     */
    public function show(Lead $lead)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Lead  $lead
     * @return \Illuminate\Http\Response
     */
    public function edit(Lead $lead)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateLeadRequest  $request
     * @param  \App\Models\Lead  $lead
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateLeadRequest $request, Lead $lead)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Lead  $lead
     * @return \Illuminate\Http\Response
     */
    public function destroy(Lead $lead)
    {
        //
    }
}

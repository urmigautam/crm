<?php

namespace App\Http\Controllers;

use App\Models\Company;
use App\Models\FollowUp;
use App\Models\Items;
use App\Models\Admin;
use App\Models\Lead;
use App\Models\Orders;
use App\Models\purposal;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\SendMail;

class FollowUpController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
        $users = Admin::all();
        return view('sales.addFollow',compact('id','users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $req ,$id)
    {
    //    dd($req->all());
       $followup = new FollowUp();
       $followup->company_id = (int)$id;
       $followup->entery_description = $req->desc;
       $followup->actual_followup =$req->follow;
       $followup->next_followup = $req->actual_follow_up;
       $followup->next_followup_by = "admin";
       $followup->upload =$req->attachment;
       $followup->new_lead_status = $req->new_lead_status;
    
       $followup->save();
       \Jeybin\Toastr\Toastr::success('FollowUp  Created Sucessfully')->toast();
       return redirect('/sales');
    }
    public function edit($id){
      
      $followup = FollowUp::find($id);
      return view('sales.editFollow',compact('followup'));
    }

    public function update(Request $req,$id){
      
        $followup = FollowUp::find($id);
        $followup->entery_description = $req->desc;
        $followup->actual_followup =$req->follow;
        $followup->next_followup = $req->actual_follow_up;
        $followup->next_followup_by = "admin";
        $followup->upload =$req->attachment;
        $followup->new_lead_status = $req->new_lead_status;
        $followup->update();
        \Jeybin\Toastr\Toastr::success('FollowUp  updated Sucessfully')->toast();
       return redirect('/sales');
    }

     public function createproposal($id){

      
        $company = Lead::where('id',$id)->get();
        $allitems =Items::all();
        return view('sales.createpurposal',compact('id','allitems','company'));
    }


    public function itemDetail(Request $req){
        $itemDetail = Items::where('id',$req->id)->get();
        return $itemDetail;
    }
  public function createpurposal(Request $req){


        $data = $req->data;
        $newarray = array();
        $totalPriceSum = 0;
        foreach ($data as  $value) {
            $totalPriceSum += $value['newprice'] * $value['qty'];
            $item = Items::where('id',(int)$value['item_id'])->first();
            array_push($newarray,$item);
        }

 

        $purposal = new purposal();
        $purposal->purposal_desc = $req->desc;
        $purposal->company_id = $req->company_id;
        $purposal->amount = $totalPriceSum;
        $purposal->items_detail = json_encode($req->data);
        // \Jeybin\Toastr\Toastr::success('Purposal created Sucessfully')->toast();
        $purposal->save();
      
        $purposalId = $purposal->id; 
        $url = 'https://crm.verdin.in/order/'.$purposalId;
        
       
       
        $companyName = Company::where('id',$req->company_id)->select('name')->get();
         
        $emailid = Lead::where('company_id',$req->company_id)->pluck('email')->first();

       
      
             $data = [
                'url' =>  $url,
                'itemsDetail' =>$newarray,
                 'amount'=>$totalPriceSum,
                 'company_name'=>$companyName,
            ];
         
        
        // Mail::to($emailid)->send(new SendMail($data));
         Mail::to($req->lead_email)->send(new SendMail($data));
        \Jeybin\Toastr\Toastr::success('Purposal Created Successfully')->toast();
        return "purposal created successfully";
    }

     public function placeorder($id){
       
   
        // $check = Orders::where('purposalId',$id)->pluck('status')->first();
      
       
            $purposal = new purposal();
            $purposal->status = "Placed";
            $purposal->update();
            $purposal_detail =purposal::where('id',$id)->first();
            $desc=$purposal_detail->purposal_desc;
            $amount =$purposal_detail->amount;
            $company_id=$purposal_detail->company_id;
            $data = json_decode($purposal_detail->items_detail);
            $newarray = array();
              foreach($data as $d){
                  $item = Items::where('id',(int)$d->item_id)->first();
                  $d = (array)$d;
                  $d['itemdetail']=$item;
                  array_push($newarray,$d);
              }

            
              $companyName = Company::find($purposal_detail->company_id)->pluck('name')->first();
           
              return view('mail.order',compact('desc','amount','companyName','company_id','newarray'));
           
            //   return view('mail.thankyou');
     
          
       
        // $data = [
            
        //     'itemsDetail' =>$newarray,
        // ];
      

        // Mail::to('ukdeveloper1993@gmail.com')->send(new SendMail($data));
        // return view('mail.thankyou');

    }



   

   
    

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\FollowUp  $followUp
     * @return \Illuminate\Http\Response
     */
    public function show(FollowUp $followUp)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\FollowUp  $followUp
     * @return \Illuminate\Http\Response
     */
   

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\FollowUp  $followUp
     * @return \Illuminate\Http\Response
     */
    

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\FollowUp  $followUp
     * @return \Illuminate\Http\Response
     */
    public function destroy(FollowUp $followUp)
    {
        //
    }

    // public function searchItem(Request $req){
     
        // if($req->ajax()){
            // $searchResult = Items::where('art_code','LIKE',$req->name.'%')->get();
            // $searchResult = Items::all();
           
            // $output ='';
    
            // if(count($searchResult)>0){
            //    $output='<ul class="list-group" style="display:block; position:relative;z-index:1;">';
            //    $output.='</ul>';
            //    foreach($searchResult as $result){
            //     $output.='<li id='."name".' value='."{$result->id}".' class="list-group-item">'.$result->art_code.'</li>';
            //    }
              
            //  }else{
            //     $output ='<li class="list-group-item">No Data Found</li>';
            // }
            // return  $searchResult;
        //   }

        
     
    // }
}

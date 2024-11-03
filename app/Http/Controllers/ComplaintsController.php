<?php

namespace App\Http\Controllers;

use App\Models\Complaints;
use App\Models\Lead;
use App\Models\Refrence;
use Illuminate\Http\Request;

class ComplaintsController extends Controller
{
    public function index(){

        $complaints = Complaints::all();
        
        // $on= Complaints::where("status","ongoing")->get();
        // $pn= Complaints::where("status","pending")->get();
        // $res= Complaints::where("status","resolved")->get();
        // $un= Complaints::where("status","underreview")->get();
        return view('complaints.complaint',compact('complaints'));

    }

    public function create()

    {

        $status=['Customer'];
        $allCustomers= Lead::where("status","Customer")->get();
        $referedby=Refrence::all();

        return view('complaints.create',compact('referedby','allCustomers'));
    }
    
    public function edit($id){
        $complaint= Complaints::find($id);
        $referedby=Refrence::all();
        return view('complaints.update',compact('complaint','referedby'));
    }


    public function store(Request $request)
    {
       
        $complaint = new Complaints;
        $complaint->complaint_number = $request->complaint_number;
        $complaint->customer_id = $request->customer_name;
        $complaint->order_no = $request->order_no;
        $complaint->complaint_desc = $request->complaint_desc;
        $complaint->photo = $request->photo;
        $complaint->status = $request->status;
        $complaint->save();

        return redirect('/complaints/dash');
    }
    public function updateComp(Request $req, $id){
        $complaint = Complaints::find($id);
        $complaint->remark =$req->remark;
        $complaint->status =$req->complaintStatus;
        $complaint->update();
        return redirect('/complaints/dash');
       
    }
}

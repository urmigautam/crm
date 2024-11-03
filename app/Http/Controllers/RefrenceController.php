<?php

namespace App\Http\Controllers;

use App\Models\Company;
use App\Models\Refrence;
use Illuminate\Http\Request;
use App\Http\Requests\StoreRefrenceRequest;
use App\Http\Requests\UpdateRefrenceRequest;

class RefrenceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $allRefrences=Refrence::with('company')->get();
       
        return view('refrence.allrefrence',compact('allRefrences'));
    }
    public function addRefrence(){
        $allcompanies = Company::all();
        return view('refrence.addrefrence',compact('allcompanies'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function createRefence(Request $req)
    {
        $ref=new Refrence();

        $ref->name =$req->name;
        $ref->email =$req->email;
        $ref->mobile =$req->contact;
        $ref->gst_vat =$req->gst;
        $ref->company_id =$req->company;

        $ref->save();
        return redirect('refrences');
    }

    public function refrenceEdit($id){
        $allcompanies = Company::all();
    $refrence = Refrence::find($id);
    return view('refrence.editrefrence',compact('refrence','allcompanies'));
    }

    public function refrenceUpdate(Request $req,$id){
      
     $updateRef =Refrence::find((int)$id);
     $updateRef->name = $req->name;
     $updateRef->email = $req->email;
     $updateRef->mobile = $req->contact;
     $updateRef->gst_vat= $req->gst;
     $updateRef->company_id = $req->company;
     $updateRef->update();
     return redirect('/refrences');
    }

    public function delete($id){
      
        $updateRef = Refrence::find((int)$id);
        $updateRef->delete();
        return redirect('/refrences');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreRefrenceRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreRefrenceRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Refrence  $refrence
     * @return \Illuminate\Http\Response
     */
    public function show(Refrence $refrence)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Refrence  $refrence
     * @return \Illuminate\Http\Response
     */
    public function edit(Refrence $refrence)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateRefrenceRequest  $request
     * @param  \App\Models\Refrence  $refrence
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateRefrenceRequest $request, Refrence $refrence)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Refrence  $refrence
     * @return \Illuminate\Http\Response
     */
    public function destroy(Refrence $refrence)
    {
        //
    }
}

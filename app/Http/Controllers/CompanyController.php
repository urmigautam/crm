<?php

namespace App\Http\Controllers;

use App\Models\Company;
use Illuminate\Http\Request;
use File;


class CompanyController extends Controller
{

   public function dashboard(){
    
    return view('admin.dashboard');
   }
    public function index(){
        return view('admin.createCompany');
    }
    public function create(Request $req){

     
        $company=new Company();
        $filename="";
        if($req->hasfile('logo')){
 
         $file = $req->file('logo');
         $filename =time().'.'.$file->getClientOriginalExtension();
         $file->move('uploads/company',$filename);
         
         $company->logo =$filename;
    }
 
 
        $company->name =$req->name;
        $company->active =1;
        $company->address =$req->address;
        $company->vat_gst =$req->gst;
     //    $company->logo =$req->logo;
        $company->logo_path =$filename;
        $company->created_by ='1';
 
        $company->save();
        return redirect('/company-list');
 
    }
    public function companylist(){
        $companys = Company::all();
        return view('admin.companyList',compact('companys'));
    }

    public function blockcompany($id){

        
        $company=Company::find((int)$id);
      
        if($company->active == 0){
         
           $company->active=1;
           $company->save();
           return redirect('/company-list');
        }
        if($company->active == 1){
           $company->active=0;
           $company->save();
           return redirect('/company-list');
        }

       
   }
    public function companyedit($id){
       
        $company=Company::find((int)$id);
      
        return view('admin.companyEdit',['company'=>$company]);
       
    }

    public function updatecompany(Request $request,$id){
        // $data = $request->validated();
       
        $company = Company::find($id);
        $company ->name = $request->name;
        $company->address =$request->address;
       
        if($request->hasfile('logo')){
            $destination = 'uploads/company/'.$company->logo;
          
            if(File::exists($destination)){
               File::delete($destination);
            }
             $file = $request->file('logo');
             $filename =time().'.'.$file->getClientOriginalExtension();
             $file->move('uploads/company/',$filename);
             $company->logo=$filename;
        }
       
        $company->update();
        return redirect('company-list');

    }
}

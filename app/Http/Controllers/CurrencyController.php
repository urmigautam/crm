<?php

namespace App\Http\Controllers;

use App\Models\Currency;
use Illuminate\Http\Request;

class CurrencyController extends Controller
{
public function index(){
    $currency =Currency::all();
    return view('currency.currency',compact('currency'));
}
public function addcurrency(){
   
    return view('currency.addCurrency');
}

public function createCurrency(Request $req){
   $currency =new Currency();
   $currency->c_name =$req->c_name;
   $currency->c_code =$req->name;
   $currency->c_symbol =$req->c_symbol;
   $currency->save();
   return redirect('/currency-list');
}

public function editCurrency($id){
  $currency =Currency::find($id);
  return view('currency.editCurrency',compact('currency'));
}
public function updateCurrency(Request $req,$id){
    $currency =Currency::find($id);
    $currency->c_name =$req->c_name;
    $currency->c_code =$req->name;
    $currency->c_symbol =$req->c_symbol;
    $currency->update();
    return redirect('/currency-list');
}
}

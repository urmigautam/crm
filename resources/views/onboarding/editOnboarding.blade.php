@extends('layouts.apps')

@section('title','Add Lead')
@section('content')

<div class="container-fluid px-4">

<div class="col-md-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title"style="float:left;" href="#">Edit Onboarding</h4>
                        <a class="btn btn-success" style="float:right;" href="{{url('/lead-qualified')}}">View Lead</a>
                    </div>
                  <div class="card-body">
                 
                  
                    <form action="{{url('/update-qualified-lead-onboarding/'.$Onboarding->id)}}" method="post" class="forms-sample">
                      @csrf 
                      @method('put')
                    <div class="form-group">
                         <label for="cname">Company Name</label>
                        <input type="text" class="form-control" id="cname" disabled value="{{$Onboarding->company_name}}" name="cname" placeholder="company name">
                      </div>
                     <div class="form-group">
                         <label for="id">Company Id</label>
                        <input type="email" class="form-control" disabled id="id" value="{{$Onboarding->id}}" name="id" placeholder="email">
                      </div>
                      <div class="form-group">
                         <label for="pob">Place Of Business</label>
                         <select name="pob" disabled class="form-control" id="pob">
                          @foreach ($place_of_business as $place)
                          <option value="{{$place->place_name}}" {{$place->place_name == $Onboarding->place_of_bussiness ? "selected":""}}>{{$place->place_name}}</option>
                          @endforeach
                         </select>
                      </div>
                      <div class="form-group">
                         <label for="paymentType">Payment Type</label>
                         <select name="paymentType" disabled class="form-control" id="paymentType">
                         <option value="cash" {{$Onboarding->payment_type =='cash'?"selected":""}}>Cash</option>
                          <option value="cradit" {{$Onboarding->payment_type =='cradit'?"selected":""}}>Credit</option>
                          <option value="both" {{$Onboarding->payment_type =='both'?"selected":""}}>Cash&Credit</option>
                         </select>
                         <div class="form-group">
                         <label for="businessType">Business Type</label>
                         <select name="businessType" disabled class="form-control" id="businessType">
                         <option value="wholesaler" {{$Onboarding->business_type =='wholesaler'?"selected":""}}>Wholesaler</option>
                          <option value="distributer" {{$Onboarding->business_type =='distributer'?"selected":""}}>Distributer</option>
                         
                         </select>

                         <div class="form-group">
                         <label for="qualify">Qualify Status</label>
                         <select name="qualify" disabled class="form-control" id="qualify">
                          <option value="yes" {{$Onboarding->status =='yes'?"selected":""}}>Yes</option>
                          <option value="no" {{$Onboarding->status =='no'?"selected":""}}>No</option>
                          </select>
                        </div>
                        <div class="form-group">
                         <label for="customerid">Customer Id</label>
                        <input type="text" class="form-control" disabled id="customerid" name value="{{$customerid}}">
                      </div>
                        <div class="form-group">
                         <label for="gst">GST/VAT</label>
                         <input type="text" class="form-control" value="{{$Onboarding->vat_gst}}" required id="gst" name="gst" placeholder="gst">
                           @error('gst')
                                <span class="text-danger">{{ $message }}</span>
                          @enderror
                      </div>
                      <div class="form-group">
                         <label for="shippingAdd">Shipping Address</label>
                        <input type="text" class="form-control"  id="shippingAdd"required value="{{$Onboarding->shipping_address}}" name="shippingAdd" placeholder="shipping Address">
                         @error('shippingAdd')
                                <span class="text-danger">{{ $message }}</span>
                        @enderror
                      </div>
                      <button type="submit" class="btn btn-primary me-2">Update</button>
                    </form>
                  </div>
                </div>
              </div>
</div>


@endsection

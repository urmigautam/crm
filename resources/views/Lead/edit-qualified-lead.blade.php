@extends('layouts.apps')

@section('title','Add Lead')
@section('content')

<div class="container-fluid px-4">

<div class="col-md-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title"style="float:left;" href="#">Edit Qualified Leads</h4>
                        <a class="btn btn-success" style="float:right;" href="{{url('/lead-qualified')}}">View Lead</a>
                    </div>
                  <div class="card-body">
                 
                    <form action="{{url('/update-qualified-lead/'.$lead->id)}}" method="post" class="forms-sample">
                      @csrf 
                      @method('put')
                    <div class="form-group">
                         <label for="cname">Company Name</label>
                        <input type="text" class="form-control" id="cname" disabled value="{{$lead->company_name}}" name="cname" placeholder="company name">
                      </div>
                     <div class="form-group">
                         <label for="id">Company Id</label>
                        <input type="email" class="form-control" disabled id="id" value="{{$lead->id}}" name="id" placeholder="email">
                      </div>
                      <div class="form-group">
                         <label for="pob">Place Of Business</label>
                         <select name="pob" class="form-control" id="pob">
                          @foreach ($place_of_business as $place)
                          <option value="{{$place->place_name}}" {{$place->place_name == $lead->place_of_bussiness ? "selected":""}}>{{$place->place_name}}</option>
                          @endforeach
                         </select>
                      </div>
                      <div class="form-group">
                         <label for="paymentType">Payment Type</label>
                         <select name="paymentType" class="form-control" id="paymentType">
                         <option value="cash" {{$lead->payment_type =='cash'?"selected":""}}>Cash</option>
                          <option value="cradit" {{$lead->payment_type =='cradit'?"selected":""}}>Credit</option>
                          <option value="both" {{$lead->payment_type =='both'?"selected":""}}>Cash&Credit</option>
                         </select>
                         <div class="form-group">
                         <label for="businessType">Business Type</label>
                         <select name="businessType" class="form-control" id="businessType">
                         <option value="wholesaler" {{$lead->business_type =='wholesaler'?"selected":""}}>Wholesaler</option>
                          <option value="distributer" {{$lead->business_type =='distributer'?"selected":""}}>Distributer</option>
                         
                         </select>

                         <div class="form-group">
                         <label for="qualify">Qualify Status</label>
                         <select name="qualify" class="form-control" id="qualify">
                          <option value="yes" {{$lead->status =='yes'?"selected":""}}>Yes</option>
                          <option value="no" {{$lead->status =='no'?"selected":""}}>No</option>
                          </select>
                         <div class="form-group">
                         <label for="id">Customer Id</label>
                        <input type="email" class="form-control" disabled id="id" value="{{$customerid}}" name="id" placeholder="email">
                      </div>
                      <button type="submit" class="btn btn-primary me-2">Submit</button>
                    </form>
                  </div>
                </div>
              </div>
</div>


@endsection

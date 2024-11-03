@extends('layouts.apps')

@section('title','Add Lead')
@section('content')

<div class="container-fluid px-4">

<div class="col-md-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title"style="float:left;" href="#">Edit Refrence</h4>
                        <a class="btn btn-success" style="float:right;" href="{{url('/refrences')}}">View Refrences</a>
                    </div>
                  <div class="card-body">
                    
                    <form action="{{url('/update-refrence/'.$refrence->id)}}" method="post" class="forms-sample">
                      @csrf 
                      @method('PUT')
                    <div class="form-group">
                         <label for="name">Name</label>
                        <input type="text" class="form-control" id="name" required value="{{$refrence->name}}" name="name" placeholder="Username">
                        @error('name')
                                <span class="text-danger">{{ $message }}</span>
                        @enderror
                      </div>
                      <div class="form-group">
                        <label for="email">Email address</label>
                        <input type="email" class="form-control" id="email" required value="{{$refrence->email}}" name="email" placeholder="Email">
                        @error('email')
                                <span class="text-danger">{{ $message }}</span>
                        @enderror
                      </div>
                      <div class="form-group">
                        <label for="contact">Contact No</label>
                        <input type="text" class="form-control" id="contact" required value="{{$refrence->mobile}}" name="contact" placeholder="contact number">
                        @error('contact')
                                <span class="text-danger">{{ $message }}</span>
                        @enderror
                      </div>
                      <div class="form-group">
                        <label for="gst">VAT</label>
                        <input type="text" class="form-control" id="gst" name="gst" required value="{{$refrence->gst_vat}}" placeholder="gst number">
                        @error('gst')
                                <span class="text-danger">{{ $message }}</span>
                        @enderror
                      </div>
                     
                      <div class="form-group">
                        <label for="contact">Select Company</label>
                        <select class="form-control" required name="company" id="company">
                          @foreach ($allcompanies as $comp)
                          <option value="{{$comp->id}}" {{$refrence->company_id == $comp->id ? 'selected' : '' }}>{{$comp->name}}</option>
                          @endforeach
                      </select>
                      </div>
                      <button type="submit" class="btn btn-primary me-2">Submit</button>
                   
                    </form>
                  </div>
                </div>
              </div>
</div>


@endsection

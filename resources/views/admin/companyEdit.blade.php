@extends('layouts.apps')

@section('title','Add Lead')
@section('content')

<div class="container-fluid px-4">

<div class="col-md-12 grid-margin stretch-card">
                <div class="card">
                   
                  <div class="card-body">
                    <h4 class="card-title">Add Company Infomation</h4>
                    <form  enctype="multipart/form-data" action="{{ url('/update-company/'.$company->id) }}" method="post" class="forms-sample">
                    @csrf
                    @method('PUT')
                    <div class="form-group">
                        <label for="name">Company Name</label>
                        <input type="text" class="form-control" name="name"id="name" required value="{{$company->name}}" placeholder="company name">
                        @error('name')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror
                      </div>
                      <div class="form-group">
                        <label for="address">Company address</label>
                        <input type="text" class="form-control" value="{{$company->address }}" required name="address"id="address" placeholder="company address">
                        @error('address')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror
                      </div>
                      <div class="form-group">
                        <label for="gst">VAT</label>
                        <input type="text" class="form-control" value="{{$company->vat_gst }}" required name="gst" id="gst" placeholder="gst">
                        @error('gst')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror
                      </div>
                     
                      <div class="form-group">
                        <label for="logo">Logo Image</label>
                        <input type="file" class="form-control" name="logo" id="logo">
                      </div>
                      
                      <button type="submit" class="btn btn-primary me-2">Submit</button>
                      
                    </form>
                  </div>
                </div>
              </div>
</div>


@endsection

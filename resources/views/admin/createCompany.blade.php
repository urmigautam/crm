@extends('layouts.apps')

@section('title','Add Lead')
@section('content')

<div class="container-fluid px-4">

<div class="col-md-12 grid-margin stretch-card">
                <div class="card">
                  <div class="card-body">
                    <h4 class="card-title">Add Company Infomation</h4>
                    <form  enctype="multipart/form-data" action="{{url('/add-company')}}" method="post" class="forms-sample">
                    @csrf
                    <div class="form-group">
                        <label for="name">Company Name</label>
                        <input type="text" class="form-control" name="name"id="name" required placeholder="company name">
                        @error('name')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror
                      </div>
                      <div class="form-group">
                        <label for="address">Company address</label>
                        <input type="text" class="form-control" name="address"id="address" required placeholder="company address">
                        @error('address')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror
                      </div>
                      <div class="form-group">
                        <label for="gst">VAT</label>
                        <input type="text" class="form-control" name="gst" required id="gst" placeholder="gst">
                        @error('gst')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror
                      </div>
                     
                      <div class="form-group">
                        <label for="logo">Document</label>
                        <input type="file" class="form-control" name="logo" id="file">
                        @error('name')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror
                      </div>
                      
                      <button type="submit" class="btn btn-primary me-2">Submit</button>
                      
                    </form>
                  </div>
                </div>
              </div>
</div>


@endsection

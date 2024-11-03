@extends('layouts.apps')

@section('title','Add Lead')
@section('content')

<div class="container-fluid px-4">

<div class="col-md-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title"style="float:left;" href="#">Add New Refrence</h4>
                        <a class="btn btn-success" style="float:right;" href="{{url('/users')}}">View Users</a>
                    </div>
                  <div class="card-body">
                    
                    <form action="{{url('/add-refrence')}}" method="post" class="forms-sample">
                      @csrf 
                    <div class="form-group">
                         <label for="name">Name</label>
                        <input type="text" class="form-control" id="name" required name="name" placeholder="Username">
                        @error('name')
                                <span class="text-danger">{{ $message }}</span>
                        @enderror
                      </div>
                      <div class="form-group">
                        <label for="email">Email address</label>
                        <input type="email" class="form-control" id="email" required name="email" placeholder="Email">
                        @error('email')
                                <span class="text-danger">{{ $message }}</span>
                        @enderror
                      </div>
                      <div class="form-group">
                        <label for="contact">Contact No</label>
                        <input type="text" class="form-control" id="contact" required name="contact" placeholder="contact number">
                        @error('contact')
                                <span class="text-danger">{{ $message }}</span>
                        @enderror
                      </div>
                      <div class="form-group">
                        <label for="gst">VAT</label>
                        <input type="text" class="form-control" id="gst" required name="gst" placeholder="gst number">
                        @error('gst')
                                <span class="text-danger">{{ $message }}</span>
                        @enderror
                      </div>
                      <div class="form-group">
                        <label for="contact">Select Company</label>
                        <select class="form-control"  required name="company" id="">
                          @foreach ($allcompanies as  $com)
                          
                         
                        <option value="{{$com->id}}">{{$com->name}}</option>
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

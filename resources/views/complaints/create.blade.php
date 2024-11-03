@extends('layouts.apps')

@section('content')

<div class="container-fluid px-4">
<div class="col-lg-12 grid-margin stretch-card">
<div class="card">
                    <div class="card-header">
                        <h4 class="card-title"style="float:left;" href="#">Add New Complaint</h4>
                        <a href="{{url('/complaints/dash')}}" style="float:right" class="btn btn-success">View Complaints</a>
                  
                           </div>
                         
                   
                  <div class="card-body">

<!-- <form action="/complaints" method="POST"> -->
<form action="{{url('/complaints')}}" method="POST">
    @csrf
  
    <div class="form-group">
        <label for="complaint_number">Complaint Number</label>
        <input type="text" class="form-control" name="complaint_number" id="complaint_number" value="{{ random_int(1, 10000000000) }}">
    </div>
    
                      <div class="form-group">
                         <label for="referedby">Customer Name</label>
                       <select class="form-control" name="customer_name" id="customer_name">
                        @foreach ($allCustomers as $ref)
                        <option value="{{$ref->company_name}}">{{$ref->company_name}}</option>
                        @endforeach
                      
                       </select>
                      </div>
    <div class="form-group">
        <label for="order_no">Order No</label>
        <input type="text" class="form-control" name="order_no" id="order_no">
    </div>
    <div class="form-group">
        <label for="complaint_desc">Complaint Description</label>
        <textarea class="form-control" name="complaint_desc" id="complaint_desc"></textarea>
    </div>
    <div class="form-group">
        <label for="photo">Photo</label>
        <input type="file" class="form-control" name="photo" id="photo">
    </div>
    <div class="form-group">
        <label for="status">Status</label>
        <select class="form-control" name="status" id="status">
            <option value="pending">Pending</option>
            <option value="ongoing">Ongoing</option>
            <option value="resolved">Resolved</option>
            <option value="undereview">Under Review</option>
        </select>
    </div>
    <button type="submit" class="btn btn-primary">Submit</button>
</form>
<div>
</div>
</div>
</div>
@endsection



@extends('layouts.apps')

@section('content')
<div class="container-fluid px-4">
<div class="col-lg-12 grid-margin stretch-card">
<div class="card">
                    <div class="card-header">
                        <h4 class="card-title"style="float:left;" href="#">Update Complaint Status</h4>
                           </div>
                  <div class="card-body">

<form class="container"  action="{{url('/update-complaint/'.$complaint->id)}}" method="post" class="forms-sample">
@csrf
@method('PUT')
  <div class="form-group">
    <label for="order-number">Order Number:</label>
    <input type="text" class="form-control" value="{{$complaint->complaint_number}}" id="order-number" placeholder="Enter order number">
  </div>
  <div class="form-group">
    <label for="complaint-status">Complaint Status:</label>
    <select class="form-control" id="complaintStatus" name="complaintStatus">
      <option value="pending" {{$complaint->status =="pending"?"selected":""}}>Pending</option>
      <option value="ongoing" {{$complaint->status =="ongoing"?"selected":""}}>Ongoing</option>
      <option value="resolved" {{$complaint->status =="resolved"?"selected":""}}>Resolved</option>
      <option value="underReview" {{$complaint->status =="underReview"?"selected":""}}>Under Review</option>
    </select>
  </div>
  <div class="form-group">
    <label for="remarks">Remarks:</label>
    <textarea class="form-control" id="remarks" rows="3" name="remark"placeholder="Write any additional remarks">{{$complaint->remark}}</textarea>
  </div>
  <button type="submit" class="btn btn-primary">Update Status</button>
</form>
<div>
</div>
</div>
</div>
@endsection
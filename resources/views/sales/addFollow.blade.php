@extends('layouts.apps')

@section('title','Add Lead')
@section('content')

<div class="container-fluid px-4">



<div class="col-md-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title"style="float:left;" href="#">Add New Follow Up</h4>
                        <!-- <a class="btn btn-success" style="float:right;" href="{{url('/leads')}}">View Lead</a> -->
                    </div>
                  <div class="card-body">
                    
                    <form action="{{url('/create-folow-up/'.$id)}}" method="post" class="forms-sample">
                      @csrf 
                    <div class="form-group">
                         <label for="desc">Purposal Description</label>
                       <textarea name="desc" id="desc" required cols="106" rows="5"></textarea>
                       @error('desc')
                                    <span class="text-danger">{{ $message }}</span>
                        @enderror
                      </div>
                     
                      <div class="form-group">
                         <label for="follow">Next Follow-Up</label>
                        <input type="date" class="form-control" required id="follow"  name="follow" >
                        @error('follow')
                                    <span class="text-danger">{{ $message }}</span>
                        @enderror
                      </div>
                      <div class="form-group">
                         <label for="followby">Next Follow-Up By</label>
                         
                          <select name="actual_follow_up_by" class="form-control" id="actual_follow_up_by">
                          @foreach ($users as $user)
                          <option value="{{$user->id}}">{{$user->name}}</option>
                          @endforeach
                         </select>
                         
                         <!--<input type="text" class="form-control" required  value="{{Auth::guard('admin')->user()->id}}" name="actual_follow_up_by" id="followby" >-->
                         @error('actual_follow_up_by')
                                    <span class="text-danger">{{ $message }}</span>
                        @enderror
                      </div>
                      <div class="form-group">
                         <label for="actual_follow_up">Actual Follow-Up</label>
                        <input type="date" class="form-control" required id="actual_follow_up" name="actual_follow_up" >
                        @error('actual_follow_up')
                                    <span class="text-danger">{{ $message }}</span>
                        @enderror
                      </div>
                      <div class="form-group">
                         <label for="new_lead_status">New Lead Status</label>
                       <select name="new_lead_status" required class="form-control" id="new_lead_status">
                        <option value="contacted">Contacted</option>
                        <option value="proposal_send">Proposal Send</option>
                        <option value="meeting_schedule">Meeting Scheduled</option>
                        <option value="negotiation">Negotiation</option>
                        <option value="follow_up">Follow Up</option>
                        <option value="closed_won">Closed Won</option>
                        <option value="closed_lost">Closed Lost</option>
                        <option value="unresponsive">Unresponsive</option>
                        <option value="on_leave">On Leave</option>
                      </select>
                      @error('new_lead_status')
                                    <span class="text-danger">{{ $message }}</span>
                        @enderror
                      </div>

                      <div class="form-group">
                         <label for="attachment">Upload Attachment</label>
                        <input type="file" class="form-control" id="attachment" name="attachment" >
                      </div>
                     
                      
                     
                     
                     
                      <button type="submit" class="btn btn-primary me-2">Submit</button>
                   
                    </form>
                  </div>
                </div>
              </div>
</div>


@endsection

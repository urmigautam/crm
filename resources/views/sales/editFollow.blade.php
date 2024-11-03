@extends('layouts.apps')

@section('title','Add Lead')
@section('content')

<div class="container-fluid px-4">

<div class="col-md-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title"style="float:left;" href="#">Add New Lead</h4>
                        <a class="btn btn-success" style="float:right;" href="{{url('/leads')}}">View Lead</a>
                    </div>
                  <div class="card-body">
                
                    <form action="{{url('/update-follow-up/'.$followup->id)}}" method="post" class="forms-sample">
                      @csrf 
                      @method('put')
                    <div class="form-group">
                         <label for="desc">Purposal Description</label>
                       <textarea name="desc" id="desc" cols="106" rows="5">{{$followup->entery_description}}</textarea>
                      </div>
                     
                      <div class="form-group">
                         <label for="follow">Next Follow-Up</label>
                        <input type="date" class="form-control" id="follow" value="{{$followup->actual_followup}}" name="follow" >
                      </div>
                      <div class="form-group">
                         <label for="followby">Next Follow-Up By</label>
                         <select class="form-control" name="actual_follow_up_by" value="{{$followup->next_followup_by}}" id="followby">
                            <option value=""></option>
                         </select>
                      </div>
                      <div class="form-group">
                         <label for="actual_follow_up">Actual Follow-Up</label>
                        <input type="date" class="form-control" value="{{$followup->next_followup}}" id="actual_follow_up" name="actual_follow_up" >
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
                      </div>

                      <div class="form-group">
                         <label for="attachment">Upload Attachment</label>
                        <input type="file" class="form-control" id="attachment" name="attachment" >
                      </div>
                     
                      
                     
                     
                     
                      <button type="submit" class="btn btn-primary me-2">Update</button>
                   
                    </form>
                  </div>
                </div>
              </div>
</div>


@endsection

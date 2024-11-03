@extends('layouts.apps')

@section('title','Add Lead')
@section('content')

<div class="container-fluid px-4">

<div class="col-md-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title"style="float:left;" href="#">Sales Proceses</h4>
                          <a href="/sales" class="btn btn-success" style="float: inline-end;">View Sales</a>
                       
                    </div>
                  <div class="card-body">
                 
                  
                    <form action="{{url('/update-qualified-lead/'.$customer->id)}}" method="post" class="forms-sample">
                      @csrf 
                      @method('put')
                    <div class="form-group">
                         <label for="cname">Company Name</label>
                        <input type="text" class="form-control" id="cname" disabled value="{{$customer->company_name}}" name="cname" placeholder="company name">
                      </div>
                     <div class="form-group">
                         <label for="id">Company Id</label>
                        <input type="email" class="form-control" disabled id="id" value="{{$customer->id}}" name="id" placeholder="email">
                      </div>
                    
                    </form>
                  </div>
                </div>

             
              </div>
              <div class="card">
                <div class="card-header">
                  
                <a href="{{url('/add-follow-up/'.$customer->id)}}"><div class="btn btn-success">  Follow Up</div></a>
              <a href="{{url('/add-new-proposal/'.$customer->id)}}"> <div class="btn btn-success" style="float:right"> Proposals/Offers</div></a> 
                </div>
                    <div class="card-body">
                    <div class="table-responsive">
                      <table class="table table-striped">
                        <thead>
                          <tr>
                            <th> Id </th>
                            <th> Description </th>
                            <th> Actual FollowUp </th>
                            <th> Next FollowUp </th>
                            <th> Next FollowUp By </th>
                            <th>Uploaded Attachment</th>
                            <th>New Lead Status</th>
                            <th>Action</th>
                          </tr>
                        </thead>
                        <tbody>
                         
                          @foreach ($allfollowups as $com)
                          <tr>
                            <td> {{$com->id}}</td>
                             <td> {{$com->entery_description}}</td>
                             <td> {{$com->actual_followup}}</td>
                             
                             <td> {{$com->next_followup}}</td>
                             <td> {{$com->next_followup_by}}</td>
                             <td> {{$com->upload}}</td>
                             <td> {{$com->new_lead_status}}</td>
                             <td> {{$com->created_at}}</td>
                            <td> 
                                <a class="btn btn-success" href="{{url('/edit-follow-up/'.$com->id)}}">Edit</a>
                               
                            </td>
                          </tr>
                          @endforeach
                         
                        </tbody>
                      </table>
                    </div>
                    </div>
                </div>
</div>



@endsection

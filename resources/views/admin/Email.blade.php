@extends('layouts.apps')

@section('title','Add Lead')
@section('content')

<div class="container-fluid px-4">

<div class="col-md-12 grid-margin stretch-card">
                <div class="card">
                  <div class="card-body">
                    <h4 class="card-title">Add Email Setting</h4>
                    <form  enctype="multipart/form-data" action="{{url('/add-email')}}" method="post" class="forms-sample">
                    @csrf
                    <div class="form-group">
                        <label for="sname">Server Name</label>
                        <input type="text" class="form-control" name="sname"id="sname" placeholder="server name">
                      </div>
                      <div class="form-group">
                        <label for="saddress">SMTP Address</label>
                        <input type="text" class="form-control" name="saddress"id="saddress" placeholder="sever address">
                      </div>
                      <div class="form-group">
                        <label for="user">User</label>
                        <input type="text" class="form-control" name="user"id="user" placeholder="user">
                  
                      </div>
                      <div class="form-group">
                        <label for="pwd">Password</label>
                        <input type="password" class="form-control" name="pwd"id="pwd" placeholder="password">
                      </div>
                     
                      <div class="form-group">
                        <label for="gst">TLS/SSL Required</label>
                        <select class="form-control"name="tls" id="">
                            <option value="yes">Yes</option>
                            <option value="no">No</option>
                        </select>
                      </div>
                      <div class="form-group">
                        <label for="gst">Is Default</label>
                        <select class="form-control"name="isdefault" id="">
                            <option value="yes">Yes</option>
                            <option value="no">No</option>
                        </select>
                      </div>
                      <div class="form-group">
                        <label for="gst">Is Active:</label>
                        <select class="form-control"name="isactive" id="">
                            <option value="yes">Yes</option>
                            <option value="no">No</option>
                        </select>
                      </div>
                      <div class="form-group">
                        <label for="port">Port</label>
                        <input type="text" class="form-control" name="port" id="port" placeholder="port number">
                      </div>
                     
                     
                      
                      <button type="submit" class="btn btn-primary me-2">Submit</button>
                      
                    </form>
                  </div>
                </div>
              </div>
</div>


@endsection

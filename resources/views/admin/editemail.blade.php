@extends('layouts.apps')

@section('title','Add Lead')
@section('content')

<div class="container-fluid px-4">

<div class="col-md-12 grid-margin stretch-card">
                <div class="card">
                   
                  <div class="card-body">
                    <h4 class="card-title">View Email Setting</h4>
                    <form  action="{{url('/server-update/'.$mail->id)}}" method="post" class="forms-sample">
                    @csrf
                    @method('PUT')
                    <div class="form-group">
                        <label for="sname">Server Name</label>
                        <input type="text" class="form-control" name="sname"id="sname" required value="{{$mail->servername}}" placeholder="server name">
                        @error('sname')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror
                      </div>
                      <div class="form-group">
                        <label for="saddress">SMTP Address</label>
                        <input type="text" class="form-control" name="saddress"id="saddress" required value="{{$mail->smtpaddress}}" placeholder="sever address">
                        @error('saddress')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror
                      </div>
                      <div class="form-group">
                        <label for="user">User</label>
                        <input type="text" class="form-control" name="user"id="user" required value="{{$mail->username}}" placeholder="user">
                        @error('user')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror
                      </div>
                      <div class="form-group">
                        <label for="pwd">Password</label>
                        <input type="password" class="form-control" value="{{$mail->password}}" required name="pwd"id="pwd" placeholder="password">
                        @error('pwd')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror
                      </div>
                      <div class="form-group">
                        <label for="gst">TLS/SSL Required</label>
                        <select class="form-control"name="tls" required id="">
                            <option value="yes">Yes</option>
                            <option value="no">No</option>
                        </select>
                      </div>
                      <div class="form-group">
                        <label for="gst">Is Default</label>
                        <select class="form-control"name="isdefault" required id="">
                            <option value="yes">Yes</option>
                            <option value="no">No</option>
                        </select>
                      </div>
                      <div class="form-group">
                        <label for="gst">Is Active:</label>
                        <select class="form-control"name="isactive" required id="">
                            <option value="yes">Yes</option>
                            <option value="no">No</option>
                        </select>
                      </div>
                      <div class="form-group">
                        <label for="port">Port</label>
                        <input type="text" class="form-control"value="{{$mail->port}}" required name="port" id="port" placeholder="port number">
                        @error('port')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror
                      </div>
                     
                     
                      
                      <button type="submit" class="btn btn-primary me-2">Update</button>
                      
                    </form>
                  </div>
                </div>
              </div>
</div>


@endsection

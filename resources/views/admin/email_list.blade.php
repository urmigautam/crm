@extends('layouts.apps')

@section('title','Manage Mastr')
@section('content')

<div class="container-fluid px-4"></div>
<div class="col-lg-12 grid-margin stretch-card">
                <div class="card">
                  
                  <div class="card-body">
                  <h4 class="card-title">Edit Email Setting</h4>
                   
                    </p>
                    <div class="table-responsive">
                      <table class="table table-striped">
                        <thead>
                          <tr>
                            <th> Id </th>
                            <th> Server Name </th>
                            <th> Server Address </th>
                            <th> User </th>
                            <th> Port </th>
                            <th>Action</th>
                          </tr>
                        </thead>
                        <tbody>
                         
                          @foreach ($mails as $com)
                          <tr>
                            <td> {{$com->id}}</td>
                            <td> {{$com->servername}}</td>
                            <td> {{$com->smtpaddress}}</td>
                            <td> {{$com->username}}</td>
                            <td> {{$com->port}}</td>
                            <td> 
                                <a class="btn btn-success" href="{{url('/server-edit/'.$com->id)}}"><i class="fa-solid fa-pen-to-square"></i></a>
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
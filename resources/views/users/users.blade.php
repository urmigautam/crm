@extends('layouts.apps')

@section('title','Manage Mastr')
@section('content')

<div class="container-fluid px-4"></div>
<div class="col-lg-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-header">
                    <a href="{{url('/add-new-user')}}" class="btn btn-success">Add New User</a>
                    </div>
                  
                  <div class="card-body">
                  
                   
                    </p>
                    <div class="table-responsive">
                      <table class="table table-striped">
                        <thead>
                          <tr>
                            <th> Id </th>
                            <th> Profile </th>
                            <th> Name </th>
                            <th> Email</th>
                            <th> Contact </th>
                            <th> Address </th>
                            <th> role </th>
                            <th> Date Of Joining </th>
                            <th> Company </th>
                            <th>Action</th>
                          </tr>
                        </thead>
                        <tbody>
                         
                          @foreach ($users as $com)
                          <tr>
                           
                            <td> {{$com->id}}</td>
                            <td> <img class="py-1" src="{{asset('uploads/user/'.$com->profile)}}" height="200" width="200" alt="image"></td>
                            <td> {{$com->name}}</td>
                            <td> {{$com->email}}</td>
                            <td> {{$com->mobile}}</td>
                            <td> {{$com->address}}</td>
                            <!--<td> {{@$com->roles[0]['name']}}</td>-->
                            <td> {{@$com->role == 1 ? "Admin":"User"}}</td>
                            <td> {{$com->posting_date}}</td>
                            <td> {{@$com->company->name}}</td>
                            <td> 
                                <a class="btn btn-success" href="{{url('/user-edit/'.$com->id)}}"><i class="fa-solid fa-pen-to-square"></i></a>
                                <a class="btn btn-danger" href="{{url('/user-block/'.$com->id)}}">{{$com->status =='1'?"block":"unblock"}}</a>
                               
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
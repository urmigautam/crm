@extends('layouts.apps')

@section('title','Manage Mastr')
@section('content')

<div class="container-fluid px-4"></div>
<div class="col-lg-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-header">
                    <a href="{{url('/add-lead')}}" class="btn btn-success">Add New Lead</a>
                    </div>
                  
                  <div class="card-body">
                  
                   
                    </p>
                    <div class="table-responsive">
                      <table class="table table-striped">
                        <thead>
                          <tr>
                            <th> Id </th>
                            <th> Name </th>
                            <th> Address </th>
                            <th> Contact Number </th>
                            <th> Contact Email </th>
                            <th>Created At</th>
                            <th>Action</th>
                          </tr>
                        </thead>
                        <tbody>
                         
                          @foreach ($alllead as $com)
                          <tr>
                            <td> {{$com->id}}</td>
                             <td> {{$com->company_name}}</td>
                             <td> {{$com->address}}</td>
                             <td> {{$com->phone}}</td>
                             <td> {{$com->email}}</td>
                             <td> {{$com->created_at}}</td>
                            <td> 
                                <a class="btn btn-success" href="{{url('/lead-edit/'.$com->id)}}"><i class="fa-solid fa-pen-to-square"></i></a>
                               
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
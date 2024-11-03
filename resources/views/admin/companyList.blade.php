@extends('layouts.apps')

@section('title','Manage Mastr')
@section('content')

<div class="container-fluid px-4"></div>
<div class="col-lg-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-header">
                        <a  href="{{url('/add-company')}}" class="btn btn-primary m-3"> Add New Company</a>
                    </div>
                  <div class="card-body">
                    <h4 class="card-title">View Company List</h4>
                   
                    </p>
                    <div class="table-responsive">
                      <table class="table table-striped">
                        <thead>
                          <tr>
                            <th> Id </th>
                            <th> Logo </th>
                            <th> Company Name </th>
                            <th> Company Address </th>
                            <th>Action</th>
                          </tr>
                        </thead>
                        <tbody>
                         
                          @foreach ($companys as $com)
                          <tr>
                            <td> {{$com->id}}</td>
                           
                            <td> <img class="py-1" src="{{asset('uploads/company/'.$com->logo)}}" height="200" width="200" alt="image">
           </td>
                            <td> {{$com->name}}</td>
                            <td> {{$com->address}}</td>
                            <td> 
                                <a class="btn btn-success" href="{{url('/company-edit/'.$com->id)}}"><i class="fa-solid fa-pen-to-square"></i></a>
                                <a class="btn btn-danger" href="{{url('/company-block/'.$com->id)}}"  >{{$com->active ==0 ?"Block":"Unblock"}}</a>
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
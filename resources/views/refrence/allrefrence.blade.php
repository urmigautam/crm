@extends('layouts.apps')

@section('title','Manage Mastr')
@section('content')

<div class="container-fluid px-4"></div>
<div class="col-lg-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-header">
                    <a href="{{url('/add-new-refrence')}}" class="btn btn-success">Add New Refrence</a>
                    </div>
                  
                  <div class="card-body">
                  
                   
                    </p>
                    <div class="table-responsive">
                      <table class="table table-striped">
                        <thead>
                          <tr>
                            <th> Id </th>
                            <th> Name </th>
                            <th> Email</th>
                            <th> Contact </th>
                            <th> Company </th>
                            <th>Action</th>
                          </tr>
                        </thead>
                        <tbody>
                          @foreach ($allRefrences as $com)
                          <tr>
                            <td> {{$com->id}}</td>
                             <td> {{$com->name}}</td>
                            <td> {{$com->email}}</td>
                            <td> {{$com->mobile}}</td>
                            <td>{{$com->company->name}}</td>
                         
                            <td> 
                                <a class="btn btn-success" href="{{url('/refrence-edit/'.$com->id)}}"><i class="fa-solid fa-pen-to-square"></i></a>
                                <a class="btn btn-danger" href="{{url('/refrence-delete/'.$com->id)}}"><i class="fa-solid fa-trash"></i></a>
                               
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
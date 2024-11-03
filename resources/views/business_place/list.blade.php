@extends('layouts.apps')

@section('title','Manage Mastr')
@section('content')

<div class="container-fluid px-4"></div>
<div class="col-lg-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-header">
                    <a href="{{url('/business-place-add')}}" class="btn btn-success">Add New Business Place</a>
                    </div>
                  
                  <div class="card-body">
                  
                   
                    </p>
                    <div class="table-responsive">
                      <table class="table table-striped">
                        <thead>
                          <tr>
                            <th> Id </th>
                            <th> Name </th>
                            <th> Company Name </th>
                            <th>Created At</th>
                            <th>Action</th>
                          </tr>
                        </thead>
                        <tbody>
                      
                          @foreach (@$bussiness as $com)
                         
                          <tr>
                            <td> {{$com->id}}</td>
                             <td> {{$com->place_name}}</td>
                             <td> {{@$com->company->name}}</td>
                             <td> {{$com->created_at}}</td>
                            <td> 
                                <a class="btn btn-success" href="{{url('/edit-place-of-business/'.$com->id)}}"><i class="fa-solid fa-pen-to-square"></i></a>
                                <a class="btn btn-danger" href="{{url('/delete-place-of-business/'.$com->id)}}"><i class="fa-solid fa-trash"></i></a>
                               
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
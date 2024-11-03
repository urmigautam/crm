@extends('layouts.apps')

@section('title','Manage Mastr')
@section('content')

<div class="container-fluid px-4"></div>
<div class="col-lg-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-header">
                    <a href="{{url('/add-item')}}" class="btn btn-success">Add New Item</a>
                    </div>
                  
                  <div class="card-body">
                  
                   
                    </p>
                    <div class="table-responsive">
                      <table class="table table-striped">
                        <thead>
                          <tr>
                            <th> Id </th>
                            <th> Name </th>
                            <th> Category </th>
                            <th> Price </th>
                            <th>Created At</th>
                            <th>Action</th>
                          </tr>
                        </thead>
                        <tbody>
                         
                          @foreach ($items as $com)
                          <tr>
                            <td> {{$com->id}}</td>
                             <td> {{$com->art_code}}</td>
                             <td> {{$com->lead_category}}</td>
                             <td> {{$com->price}}</td>
                             <td> {{$com->created_at}}</td>
                            <td> 
                                <a class="btn btn-success" href="{{url('/item-edit/'.$com->id)}}"><i class="fa-solid fa-pen-to-square"></i></a>
                                <a class="btn btn-danger" href="{{url('/item-delete/'.$com->id)}}"><i class="fa-solid fa-trash"></i></a>
                               
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
@extends('layouts.apps')

@section('title','Manage Mastr')
@section('content')

<div class="container-fluid px-4"></div>
<div class="col-lg-12 grid-margin stretch-card">
                <div class="card">
                  <div class="card-body">
                  <h4 class="card-title">Permissions List</h4>
                   <a href="{{url('/add-permission')}}" class="btn btn-success">Add New Permission</a>
                    </p>
                    <div class="table-responsive">
                      <table class="table table-striped">
                        <thead>
                          <tr>
                            <th> S.No </th>
                            <th> Permission Name  </th>
                            <th> Permission Url</th>
                            <th>Action</th>
                          </tr>
                        </thead>
                        <tbody>
                          @foreach ($allPermissions as $permission)
                          <tr>
                            <td> {{$permission->id}}</td>
                            <td> {{$permission->name}}</td>
                            <td> {{$permission->url}}</td>
                            <td> 
                                <a class="btn btn-success" href="{{url('/edit-permission/'.$permission->id)}}">Edit</a>
                                <a class="btn btn-danger" href="{{url('/delete-permission/'.$permission->id)}}">Delete</a>
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
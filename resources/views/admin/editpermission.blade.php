@extends('layouts.apps')

@section('title','Add Lead')
@section('content')

<div class="container-fluid px-4">

<div class="col-md-12 grid-margin stretch-card">
                <div class="card">
                  <div class="card-body">
                    <h4 class="card-title">Create New Permission</h4>
                    <form  action="{{url('/update-permission/'.$permission->id)}}" method="post" class="forms-sample">
                    @csrf
                    @method('PUT')
                    <div class="form-group">
                        <label for="name">Permision Name</label>
                        <input type="text" class="form-control" value="{{$permission->name}}" required name="permission"id="permission" placeholder="permission name">
                        @error('permission')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror
                      </div>
                      <div class="form-group">
                        <label for="name">Url</label>
                        <input type="text" class="form-control" value="{{$permission->url}}" required name="pageurl"id="pageurl" placeholder="url">
                        @error('pageurl')
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

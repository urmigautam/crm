@extends('layouts.apps')

@section('title','Add Lead')
@section('content')

<div class="container-fluid px-4">

<div class="col-md-12 grid-margin stretch-card">
                <div class="card">
                  <div class="card-body">
                    <h4 class="card-title">Create New Permission</h4>
                    <form  action="{{url('/store-permission')}}" method="post" class="forms-sample">
                    @csrf
                    <div class="form-group">
                        <label for="name">Permision Name</label>
                        <input type="text" class="form-control" name="permission"id="permission" required placeholder="permission name">
                        @error('permission')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror
                      </div>
                      <div class="form-group">
                        <label for="name">Url</label>
                        <input type="text" class="form-control" required name="pageurl"id="pageurl" placeholder="url">
                        @error('pageurl')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror
                      </div>
                      <button type="submit" class="btn btn-primary me-2">Submit</button>
                      
                    </form>
                    
                  </div>
                </div>
              </div>
</div>


@endsection

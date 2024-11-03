@extends('layouts.apps')

@section('title','Category')
@section('content')

<div class="container-fluid px-4">

<div class="col-md-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title"style="float:left;" href="#">Edit Category</h4>
                        <a class="btn btn-success" style="float:right;" href="{{url('/category-list')}}">View Category</a>
                    </div>
                  <div class="card-body">
                    
                    <form action="{{url('/category-update/'.$category->id)}}" method="post" class="forms-sample">
                      @csrf 
                      @method('put')
                    <div class="form-group">
                         <label for="name">Name</label>
                        <input type="text" class="form-control" id="name" required value="{{$category->category_name}}" name="name" placeholder="Category Name">
                         @error('name')
                                <span class="text-danger">{{ $message }}</span>
                        @enderror
                      </div>
                      <button type="submit" class="btn btn-primary me-2">Update</button>
                   
                    </form>
                  </div>
                </div>
              </div>
</div>


@endsection

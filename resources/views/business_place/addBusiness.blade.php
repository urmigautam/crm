@extends('layouts.apps')

@section('title','Add Lead')
@section('content')

<div class="container-fluid px-4">

<div class="col-md-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title"style="float:left;" href="{{url('/business-place-add')}}">Add New Business Place</h4>
                        <a class="btn btn-success" style="float:right;" href="{{url('/place-of-bussiness')}}">View Business Places</a>
                    </div>
                  <div class="card-body">
                    
                    <form action="{{url('/business-place-create')}}" method="post" class="forms-sample">
                      @csrf 
                    <div class="form-group">
                         <label for="name">Name</label>
                        <input type="text" class="form-control" required id="name" name="name" placeholder="Business Place">
                        @error('name')
                                <span class="text-danger">{{ $message }}</span>
                        @enderror
                      </div>

                      <div class="form-group">
                        <label for="contact">Select Company</label>
                        <select class="form-control" name="company" id="">
                          @foreach ($allcompanies as $com)
                          <option value="{{$com->id}}">{{$com->name}}</option>
                          @endforeach
                      </select>
                      </div>
                      <button type="submit" class="btn btn-primary me-2">Submit</button>
                   
                    </form>
                  </div>
                </div>
              </div>
</div>


@endsection

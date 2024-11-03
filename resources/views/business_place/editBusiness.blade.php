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
                    
                    <form action="{{url('/business-place-update/'.$business->id,)}}" method="post" class="forms-sample">
                      @csrf 
                      @method('put')
                    <div class="form-group">
                         <label for="name">Name</label>
                        <input type="text" class="form-control" id="name" required name="name" value="{{$business->place_name}}" placeholder="Business Place">
                        @error('name')
                                <span class="text-danger">{{ $message }}</span>
                        @enderror
                      </div>

                      <div class="form-group">
                        <label for="contact">Select Company</label>
                        <select class="form-control" name="company" id="">
                          @foreach ($allcompanies as $com)
                          <option value="{{$com->id}}" {{$business->company_id == $com->id ? 'selected' : '' }}>{{$com->name}}</option>
                          @endforeach
                       </select>
                      </div>
                      <button type="submit" class="btn btn-primary me-2">Update</button>
                   
                    </form>
                  </div>
                </div>
              </div>
</div>


@endsection

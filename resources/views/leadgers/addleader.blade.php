
@extends('layouts.apps')

@section('title','Add Lead')
@section('content')

<div class="container-fluid px-4">

<div class="col-md-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title"style="float:left;" href="#">Add New Ledgers</h4>
                        <a class="btn btn-success" style="float:right;" href="{{url('/get-tally-ledgers')}}">View Ledgers</a>
                    </div>
                  <div class="card-body">
                    
                    <form action="{{url('/add-new-leadger')}}" method="post" class="forms-sample">
                      @csrf 
                      <div class="row">

                      <div class="col-md-12"> 
                        <!-- <div class="form-group"> -->
                         <!-- <label for="plname">Select Ledger Category</label>
                        <input type="text" class="form-control" id="plname" name="plname" required placeholder="leadger Parents name">
                    
                        @error('lname')
                              <span class="text-danger">{{ $message }}</span>
                          @enderror
                        </div> -->
                         <div class="form-group">
                         <label for="lname">Ledger Name</label>
                        <input type="text" class="form-control" id="lname" name="lname" required placeholder="leadger name">
                    
                        @error('lname')
                              <span class="text-danger">{{ $message }}</span>
                          @enderror
                        </div>
                      <button type="submit" class="btn btn-primary me-2">Add</button>
                   
                    </form>
                  </div>
                </div>
              </div>
</div>

@endsection

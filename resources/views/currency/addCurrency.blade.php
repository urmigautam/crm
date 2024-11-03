@extends('layouts.apps')

@section('title','Add Lead')
@section('content')

<div class="container-fluid px-4">

<div class="col-md-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title"style="float:left;" href="#">Add New Category</h4>
                        <a class="btn btn-success" style="float:right;" href="{{url('/category-list')}}">View Category</a>
                    </div>
                  <div class="card-body">
                    
                    <form action="{{url('/create-currency')}}" method="post" class="forms-sample">
                      @csrf 
                    <div class="form-group">
                         <label for="c_name">Currency Code</label>
                          <select name="c_name" class="form-control" id="c_name">
                            <option value="INR">INR</option>
                            <option value="YEN">YEN</option>
                            <option value="GBP">GBP</option>
                            <option value="USD">USD</option>
                            <option value="EUR">EUR</option>
                          </select>
                      </div>
                     <div class="form-group">
                         <label for="name">Currency Name</label>
                        <input type="text" class="form-control" id="name" required name="name" placeholder="Currency Name">
                        @error('name')
                                <span class="text-danger">{{ $message }}</span>
                        @enderror
                      </div>
                      <div class="form-group">
                         <label for="c_symbol">Currency Symbol</label>
                         <select name="c_symbol"class="form-control" id="c_symbol">
                            <option value="¥">(¥)</option>
                            <option value="₹">(₹)</option>
                            <option value="£">(£)</option>
                            <option value="$">($)</option>
                            <option value="€">(€)</option>
                          </select>
                      </div>
                      <button type="submit" class="btn btn-primary me-2">Submit</button>
                   
                    </form>
                  </div>
                </div>
              </div>
</div>


@endsection

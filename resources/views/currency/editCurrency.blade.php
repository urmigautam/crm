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
                    
                    <form action="{{url('/update-currency/'.$currency->id)}}" method="post" class="forms-sample">
                      @csrf 
                      @method('put')
                    <div class="form-group">
                         <label for="c_name">Currency Code</label>
                          <select name="c_name" class="form-control" id="c_name">
                            <option value="INR" {{$currency->c_name == "INR" ? "selected":""}}>INR</option>
                            <option value="YEN" {{$currency->c_name == "YEN" ? "selected":""}}>YEN</option>
                            <option value="GBP" {{$currency->c_name == "GBP" ? "selected":""}}>GBP</option>
                            <option value="USD"{{$currency->c_name == "USD" ? "selected":""}}>USD</option>
                            <option value="EUR"{{$currency->c_name == "EUR" ? "selected":""}}>EUR</option>
                          </select>
                      </div>
                      <div class="form-group">
                         <label for="name">Currency Name</label>
                        <input type="text" class="form-control" id="name" value="{{$currency->c_name}}" required name="name" placeholder="Currency Name">
                         @error('name')
                                <span class="text-danger">{{ $message }}</span>
                        @enderror
                      </div>
                      <div class="form-group">
                         <label for="c_symbol">Currency Symbol</label>
                         <select name="c_symbol"class="form-control" id="c_symbol">
                            <option value="¥" {{$currency->c_symbol == "(¥)" ? "selected":""}}>(¥)</option>
                            <option value="₹" {{$currency->c_symbol == "(₹)" ? "selected":""}}>(₹)</option>
                            <option value="£"{{$currency->c_symbol == "(£)" ? "selected":""}}>(£)</option>
                            <option value="$"{{$currency->c_symbol == "($)" ? "selected":""}}>($)</option>
                            <option value="€"{{$currency->c_symbol == "(€)" ? "selected":""}}>(€)</option>
                          </select>
                      </div>
                      <button type="submit" class="btn btn-primary me-2">Submit</button>
                   
                    </form>
                  </div>
                </div>
              </div>
</div>


@endsection

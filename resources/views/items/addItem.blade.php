@extends('layouts.apps')

@section('title','Add Lead')
@section('content')

<div class="container-fluid px-4">

<div class="col-md-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title"style="float:left;" href="#">Add New Item</h4>
                        <a class="btn btn-success" style="float:right;" href="{{url('/category-list')}}">View Category</a>
                    </div>
                  <div class="card-body">
                    
                    <form action="{{url('/additem')}}" method="post" class="forms-sample">
                      @csrf 
                    <div class="form-group">
                         <label for="aname">Art Name</label>
                        <input type="text" class="form-control" id="aname" required name="aname" placeholder="art name">
                        @error('aname')
                                <span class="text-danger">{{ $message }}</span>
                        @enderror
                      </div>
                      <div class="form-group">
                         <label for="lead_category">Art Category</label>
                         <select name="lead_category"class="form-control" id="lead_category">
                             @foreach ($categories as $c)
                             <option value="{{$c->id}}">{{$c->category_name}}</option>
                            @endforeach
                          </select>
                      </div>
                      <div class="form-group">
                         <label for="composition">Composition</label>
                        <input type="text" class="form-control" id="composition" required name="composition" placeholder="Composition">
                      </div>
                      @error('composition')
                                <span class="text-danger">{{ $message }}</span>
                        @enderror
                      <div class="form-group">
                         <label for="width">Width</label>
                        <input type="text" class="form-control" id="width" required name="width" placeholder="width">
                        @error('width')
                                <span class="text-danger">{{ $message }}</span>
                        @enderror
                      </div>
                      <div class="form-group">
                         <label for="grmt">GR/MT</label>
                        <input type="text" class="form-control" id="grmt" required name="grmt" placeholder="grmt">
                        @error('grmt')
                                <span class="text-danger">{{ $message }}</span>
                        @enderror
                      </div>
                      <div class="form-group">
                         <label for="price">Price</label>
                        <input type="text" class="form-control" id="price" required name="price" placeholder="price">
                        @error('price')
                                <span class="text-danger">{{ $message }}</span>
                        @enderror
                      </div>
                      <button type="submit" class="btn btn-primary me-2">Submit</button>
                   
                    </form>
                  </div>
                </div>
              </div>
</div>


@endsection

@extends('layouts.apps')

@section('title','Add Lead')
@section('content')

<div class="container-fluid px-4">

<div class="col-md-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title"style="float:left;" href="#">Add New Item</h4>
                        <a class="btn btn-success" style="float:right;" href="{{url('/items-list')}}">View Items</a>
                    </div>
                  <div class="card-body">
                    
                    <form action="{{url('/update-item/'.$item->id)}}" method="post" class="forms-sample">
                      @csrf 
                      @method('put')
                    <div class="form-group">
                         <label for="aname">Art Name</label>
                        <input type="text" class="form-control" required value="{{$item->art_code}}" id="aname" name="aname" placeholder="art name">
                        @error('aname')
                                <span class="text-danger">{{ $message }}</span>
                        @enderror
                      </div>
                        <div class="form-group">
                         <label for="lead_category">Art Category</label>
                         <select name="lead_category"class="form-control" id="lead_category">
                             @foreach ($categories as $c)
                             <option value="{{$c->id}}" {{ $item->art_code == $c->id ? "selected":""}}>{{$c->category_name}}</option>
                            @endforeach
                          </select>
                      </div>
                      <div class="form-group">
                         <label for="composition">Composition</label>
                        <input type="text" class="form-control" id="composition" required value="{{$item->composition}}" name="composition" placeholder="Username">
                        @error('composition')
                                <span class="text-danger">{{ $message }}</span>
                        @enderror
                      </div>
                      <div class="form-group">
                         <label for="width">Width</label>
                        <input type="text" class="form-control" id="width" required name="width" value="{{$item->width}}" placeholder="width">
                        @error('width')
                                <span class="text-danger">{{ $message }}</span>
                        @enderror
                      </div>
                      <div class="form-group">
                         <label for="grmt">GR/MT</label>
                        <input type="text" class="form-control" id="grmt" required name="grmt" value="{{$item->grmt}}" placeholder="grmt">
                        @error('grmt')
                                <span class="text-danger">{{ $message }}</span>
                        @enderror
                      </div>
                      <div class="form-group">
                         <label for="price">Price</label>
                        <input type="text" class="form-control" id="price" required name="price" value="{{$item->price}}" placeholder="price">
                        @error('price')
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

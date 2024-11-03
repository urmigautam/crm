@extends('layouts.apps')

@section('title','Manage Mastr')
@section('content')

<div class="container-fluid px-4"></div>
<div class="col-lg-12 grid-margin stretch-card">
                <div class="card">
                <div class="card-header">
                    <a href="{{url('/orders-data')}}" class="btn btn-success">Orders</a>
                    </div>
                 <div class="card-body">
                  </p>
                    <div class="table-responsive">
                      <table class="table table-striped">
                        <thead>
                          <tr>
                            <th>S.No</th>
                            <th>Purposal Id</th>
                            <th>Item Id</th>
                            <th>Item Name</th>
                            <th>Category</th>
                            <th>Composition</th>
                            <th>Quentity</th>
                            <th>Item Price</th>
                            <!-- <th>Action</th> -->
                          </tr>
                        </thead>
                        <tbody>
                       
                        @php($count=1)
                          @foreach ($orders as $com)
                          
                          <tr>
                             <td> {{$count}}</td>
                             <td> {{$purposalid}}</td>
                             <td> {{$com->id}}</td>
                             <td> {{$com->art_code}}</td>
                             <td> {{$com->lead_category}}</td>
                             <td> {{$com->composition}}</td>
                             <td> {{$com->qty}}</td>
                             
                             <td>
                                @if (isset($com->totalPrice) && $com->totalPrice != "")
                                    {{ $com->totalPrice }}
                                @elseif (isset($com->amount) && $com->amount != "")
                                    {{ $com->amount }}
                                @else
                                    <!-- Handle case where neither totalPrice nor amount is available -->
                                @endif
                            </td>
                          </tr>
                         
                          @php($count++)
                          @endforeach
                         
                        </tbody>
                      </table>
                    </div>
                  </div>
                </div>
              </div>
              @endsection


              

             
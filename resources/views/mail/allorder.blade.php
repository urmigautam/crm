@extends('layouts.apps')

@section('title','Manage Mastr')
@section('content')

<div class="container-fluid px-4"></div>
<div class="col-lg-12 grid-margin stretch-card">
                <div class="card">
                  <div class="card-header">
                    <form action="{{url('/import-orders')}}" method="post" enctype="multipart/form-data" class="form-inline my-2 my-lg-0" style="float: left;">
                      @csrf
                     
                       <select name="customer_name" id="customer_name" style="height: 38px; border: 1px; border-radius: 5px;">
                         <option value="">Select Customer</option>
                           @foreach ($customers as $c)
                         <option value="{{$c->id}}">{{$c->company_name}}</option>
                    @endforeach
               </select>

               <select name="proposals_id" id="proposals_id" style="height: 38px; border: 1px; border-radius: 5px;">
                <option value="">Select Proposal</option>
               </select>

               <input type="file" style="width: 231px;" name="upload" id="upload"> 

                <button class="btn btn-success">Upload</button>
                    </form>
                  <form action="" method="get" class="form-inline my-2 my-lg-0" style="float: right;">
                   
                  <!-- <select name="company_id" id="company_id" style="height: 38px; border: 1px; border-radius: 5px;">
                    @foreach ($companies as $c)
                    <option value="{{$c->id}}" @if($c->id == request()->input('company_id')) selected @endif>{{$c->name}}</option>
                    @endforeach

                </select> -->
                  <!-- <button class="btn btn-success">Filter</button> -->
                 </form>
                  </div>
                 <div class="card-body">
                 
                    <div class="table-responsive">
                      <table class="table table-striped">
                        <thead>
                          <tr>
                            <th>S.No</th>
                            <th>Purposal Number</th>
                            <th>Orde No</th>
                            <th>Total Price</th>
                            <th>Status</th>
                            <th>Customer Name</th>
                            <th>Action</th>
                          </tr>
                        </thead>
                        <tbody>
                         
                        @php($count=1)
                          @foreach ($orders as $com)
                         
                          <tr>
                          <input type="hidden" class="order_id" value="{{ $com->id }}">
                            <th scope="row"> {{$count}}</th>
                            <td>  {{$com->purposalId}}</td>
                             <td> {{$com->id}}</td>
                             <td> {{$com->amount}}</td>
                             <td> 
                             <select style="font-size: 15px;border-radius: 5px;" name="status" id="status" class="status-dropdown">
                                <option value="inprocess" {{$com->status =="inprocess" ? "selected":""}}>Inprocess</option>
                                <option value="canceled" {{$com->status =="canceled" ? "selected":""}}>Cancel</option>
                                <option value="completed" {{$com->status =="completed" ? "selected":""}}>Completed</option>
                            </select>
                             </td>
                             <td> {{@$com->customer_name}}</td>
                             <td>  <a href="{{url('/order-detail/'.$com->id)}}" class="btn btn-success"><i class="fa-solid fa-eye"></i></a></td>
                            
                          </tr>
                          @php($count++)
                          @endforeach
                         
                        </tbody>
                      </table>
                    </div>
                  </div>
                </div>
              </div>
              <script>
       
$(document).ready(function() {
 
    $('#customer_name').change(function(){
        var customer_id = $(this).val();
        // alert(customer_id);
        $.ajax({
            url: "{{url('/count-purposals')}}",
            type: "GET",
            data: {"customer_id":customer_id },
            success: function(datas) {
                console.log("output", datas);
                // Clear existing options
                $('#proposals_id').empty();
                // Append new options
                $.each(datas, function(index, data) {
                    $('#proposals_id').append($('<option>', {
                        value: data.id,
                        text: data.id // Change 'name' to the appropriate property
                    }));
                });
            },
            error: function(xhr, status, error) {
                console.error("Error fetching proposals:", error);
            }
        });
    });

    // Function to handle status change
    $('select[name="status"]').change(function() {
        var status = $(this).val();
        var orderId = $(this).closest('tr').find('.order_id').val();
        console.log("Order ID:", orderId);
        console.log("Status:", status);
        $.ajax({
            url: "{{ url('update-status') }}",
            type: "GET",
            data: { "order_id": orderId, "status": status },
            success: function(response) {
            
                if (response == "done") {
                    console.log("response",response);
                    // Display the Toastr message
                    toastr.success("status updated successfully");
                }
            },
            error: function(xhr, status, error) {
                console.error("Error updating status:", error);
            }
        });
    });
});

</script>
              @endsection

              


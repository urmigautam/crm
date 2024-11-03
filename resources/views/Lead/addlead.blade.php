@extends('layouts.apps')

@section('title','Add Lead')
@section('content')

<div class="container-fluid px-4">

<div class="col-md-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title"style="float:left;" href="#">Add New Lead</h4>
                        <a class="btn btn-success" style="float:right;" href="{{url('/leads')}}">View Lead</a>
                    </div>
                  <div class="card-body">
                    
                    <form action="{{url('/add-new-lead')}}" method="post" class="forms-sample">
                      @csrf 
                      <div class="row">
                        <div class="col-md-6"> <div class="form-group">
                         <label for="cname">Lead Name</label>
                        <input type="text" class="form-control" id="cname" name="cname" required placeholder="company name">
                    
                        @error('cname')
                              <span class="text-danger">{{ $message }}</span>
                          @enderror
                        </div>
                     <div class="form-group">
                        <label for="cname">Select Country </label>
                       
                        <select name="country" class="form-control" id="country">
                          @foreach ($countries as $con)
                          <option value="{{$con->id}}">{{$con->name}}</option>
                          @endforeach
                         
                        </select>
                        @error('country')
                              <span class="text-danger">{{ $message }}</span>
                          @enderror
                        </div>
                        <div class="form-group">
                        <label for="state">Select State </label>
                       
                        <select name="state" class="form-control" id="state">
                         
                        </select>
                        @error('state')
                              <span class="text-danger">{{ $message }}</span>
                          @enderror
                      </div>

                      <!-- <div class="form-group">
                        <label for="state">Select city </label>
                       
                        <select name="city" class="form-control" id="city">
                         
                        </select>
                        @error('city')
                              <span class="text-danger">{{ $message }}</span>
                          @enderror
                      </div> -->

                      <div class="form-group">
                         <label for="caddress">Address</label>
                        <input type="text" class="form-control" id="caddress" required name="caddress" placeholder="address">
                        @error('caddress')
                              <span class="text-danger">{{ $message }}</span>
                          @enderror
                      </div>
                      <div class="form-group">
                         <label for="phone">Phone</label>
                        <input type="text" class="form-control" id="phone" required name="phone" placeholder="contact">
                        @error('phone')
                              <span class="text-danger">{{ $message }}</span>
                          @enderror
                      </div>
                      <div class="form-group">
                         <label for="email">Email</label>
                        <input type="email" class="form-control" id="email" required name="email" placeholder="email">
                        @error('email')
                              <span class="text-danger">{{ $message }}</span>
                          @enderror
                      </div>
                      
                     
                     </div>
                        <div class="col-md-6">
                        <div class="form-group">
                         <label for="referedby">Referred By</label>
                       <select class="form-control" required name="referedby" id="referedby">
                        @foreach ($referedby as $ref)
                        <option value="{{$ref->name}}">{{$ref->name}}</option>
                        @endforeach
                      
                       </select>
                       @error('referedby')
                              <span class="text-danger">{{ $message }}</span>
                          @enderror
                      </div>
                      <div class="form-group">
                         <label for="category">Category</label>
                       <select class="form-control" required name="category" id="category">
                        @foreach ($category as $cat)
                        <option value="{{$cat->category_name}}">{{$cat->category_name}}</option>
                        @endforeach
                      
                       </select>
                       @error('referedby')
                              <span class="text-danger">{{ $message }}</span>
                          @enderror
                      </div>
                     
                        <div class="form-group">
                         <label for="contactmobile2">Contact Mobile 2</label>
                        <input type="text" class="form-control" id="contactmobile2" required name="contactmobile2" placeholder="contact mobile 2">
                        @error('contactmobile2')
                              <span class="text-danger">{{ $message }}</span>
                          @enderror
                      </div>
                      
                      <div class="form-group">
                         <label for="contactperson1">Contact Person 1</label>
                        <input type="text" class="form-control" id="contactperson1" required name="contactperson1" placeholder="contact person 1">
                        @error('contactperson1')
                              <span class="text-danger">{{ $message }}</span>
                          @enderror
                      </div>
                      <div class="form-group">
                         <label for="contactemail1">Contact Email 1</label>
                        <input type="email" class="form-control" id="contactemail1" name="contactemail1" required placeholder="contact email 1">
                        @error('contactemail1')
                              <span class="text-danger">{{ $message }}</span>
                          @enderror
                      </div>
                      <div class="form-group">
                         <label for="contactmobile1">Contact Mobile 1</label>
                        <input type="text" class="form-control" id="contactmobile1" name="contactmobile1" required placeholder="contact mobile 1">
                        @error('contactmobile1')
                              <span class="text-danger">{{ $message }}</span>
                          @enderror
                      </div>
                      <div class="form-group">
                         <label for="contactperson2">Contact Person 2</label>
                        <input type="text" class="form-control" id="contactperson2" required name="contactperson2" placeholder="contact person 2">
                        @error('contactperson2')
                              <span class="text-danger">{{ $message }}</span>
                          @enderror
                      </div>
                      <div class="form-group">
                         <label for="contactemail2">Contact Email 2</label>
                        <input type="email" class="form-control" id="contactemail2" required name="contactemail2" placeholder="contact Email 2">
                        @error('contactemail2')
                              <span class="text-danger">{{ $message }}</span>
                          @enderror
                      </div>
                     
                        </div>
                      </div>
                  
                      <button type="submit" class="btn btn-primary me-2">Submit</button>
                   
                    </form>
                  </div>
                </div>
              </div>
</div>

<script>
       
       $(document).ready(function() {
        
          //  $('#customer_name').change(function(){
          //      var customer_id = $(this).val();
          //      // alert(customer_id);
          //      $.ajax({
          //          url: "{{url('/count-purposals')}}",
          //          type: "GET",
          //          data: {"customer_id":customer_id },
          //          success: function(datas) {
          //              console.log("output", datas);
          //              // Clear existing options
          //              $('#proposals_id').empty();
          //              // Append new options
          //              $.each(datas, function(index, data) {
          //                  $('#proposals_id').append($('<option>', {
          //                      value: data.id,
          //                      text: data.id // Change 'name' to the appropriate property
          //                  }));
          //              });
          //          },
          //          error: function(xhr, status, error) {
          //              console.error("Error fetching proposals:", error);
          //          }
          //      });
          //  });
       
           // Function to handle status change
           $('select[name="country"]').change(function() {
               var country = $(this).val();
              //  var orderId = $(this).closest('tr').find('.order_id').val();
              //  console.log("Order ID:", orderId);
              //  console.log("Status:", status);
               $.ajax({
                   url: "{{ url('/get-state') }}",
                   type: "GET",
                   data: { "state": country },
                   success: function(response) {
                   
                      //  if (response == "done") {
                           console.log("response",response);
                           $('#state').empty();
          //              // Append new options
                       $.each(response, function(index, data) {
                           $('#state').append($('<option>', {
                               value: data.id,
                               text: data.name // Change 'name' to the appropriate property
                           }));
                       });
                           // Display the Toastr message
                      //      toastr.success("status updated successfully");
                      //  }
                   },
                   error: function(xhr, status, error) {
                       console.error("Error updating status:", error);
                   }
               });
           });
       });
       
       </script>
@endsection

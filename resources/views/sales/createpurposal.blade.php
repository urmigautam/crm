@extends('layouts.apps')
@section('title','Add Lead')
@section('content')
<div class="container-fluid px-4">
<div class="col-md-12 grid-margin stretch-card">
    <div class="card">
        <div class="card-header">
            <h4 class="card-title"style="float:left;" href="#">Add New Proposal</h4>
            <!-- <a class="btn btn-success" style="float:right;" href="{{url('/leads')}}">View Lead</a> -->
        </div>
      <div class="card-body">
        
        <form class="forms-sample">
          @csrf 
          
          <div class="form-group">
    <label for="desc">Proposal Description</label>
    <textarea name="desc" id="desc" cols="106" rows="5" required></textarea>
    @error('desc')
        <div class="text-danger">{{ $message }}</div>
    @enderror
</div>


         
          <input type="hidden" name="id" id="company_id"  value="{{$company[0]->company_id}}">
          <input type="hidden" name="lead_email" id="lead_email"  value="{{$company[0]->email}}">
          </form>
          <div class="input-group">
          <select class="select-option"  name="select-option"  id="select-option">
            <option value="">Select Item</option>
              @foreach ($allitems as $item)
              <option value="{{$item->id}}{{$item->art_code}}"  >{{$item->art_code}}</option>
              @endforeach
            </select>
            <input type="hidden"  class="test-css" id="id" name="id" placeholder="id">
            <input type="text" disabled class="test-css" id="category" name="category" placeholder="category">
            <input type="text" disabled class="test-css" id="width" name="width" placeholder="width">
            <input type="text" disabled class="test-css"id="composition" name="composition" placeholder="composition">
            <input type="text" disabled class="test-css"  id="gst"  name="grmt" placeholder="vat gst">
            <input type="text" disabled class="test-css"  id="price"  name="price" placeholder="price">

            <input type="text"  class="test-css"name="newprice" id="newprice" placeholder="unit price">
            <input type="text"  class="test-css"name="qty" id="qty" placeholder="quantity">
            <input type="text"  class="test-css"name="totalprice" id="totalprice" placeholder="total price">
            <button class="btn btn-success" id="add">Add</button>
        </div>
          <div class="table-responsive">
            
        <p id="msg" mt-5 ></p>
          <table class="table table-striped">
          <thead>
            <tr>
              <th>S.No</th>
              <th>Art Name</th>
              <th>Art Category</th>
              <th>Composition</th>
              <th>Width</th>
              <th>GRMT</th>
              <th>Price/unit</th>
              <th>qty</th>
              <th>Total Price</th>
              
            </tr>
          </thead>
          <tbody>
          
            
          </tbody>
          </table>
          </div>
          <div class="form-group">
          <button type="submit" id="submitpurposal" class="btn btn-primary me-2 mt-4">Send Proposal</button>
          </div>
      </div>
    </div>
  </div>
</div>

<script>
  $(document).ready(
   
   function(){
    let array =[];

      $('#select-option').on('change', function() {
        var value = $(this).val();
        console.log("val",value);
         $.ajax({
        url:"{{route('itemDetail')}}",
       type:"GET",
       data:{"id": value},
       success:function(data){
        console.log(data[0].composition);
         $('#composition').val(data[0].composition);
         $('#width').val(data[0].width);
         $('#category').val(data[0].lead_category);
         $('#gst').val(data[0].grmt);
         $('#price').val(data[0].price);
         $('#totalprice').val(0);
         $('#id').val(data[0].id);
     
       }
      });
        }); 

        $('#newprice,#qty').on('keyup', function() {
          
          var qty = $('#qty').val();
          var newprice = $('#newprice').val();
            var pricetotal=qty*newprice;

            $('#totalprice').val(pricetotal);
        });

        $('#add').on('click', function() {

          $data={
              item_id:$('#id').val(),
              qty: $('#qty').val(),
              newprice: $('#newprice').val(),
            
            };
            array.push($data);
            console.log("array===>",array);
            var qty = $('#qty').val();
            var newprice = $('#newprice').val();
            var pricetotal=qty*newprice;
            $('#totalprice').val(pricetotal);
             var selectedArtCode = $('#select-option').val();
             $('tbody').append('<tr><td>'+$('#id').val()+'</td> <td >'+selectedArtCode.substring(1)+'</td> <td >'+$('#category').val()+'</td> <td >'+$('#composition').val()+'</td> <td >'+$('#width').val()+'</td> <td >'+$('#gst').val()+'</td> <td >'+$('#price').val()+'</td> <td >'+$('#qty').val()+'</td> <td >'+$('#totalprice').val()+'</td></tr>');
         
        
        });

        $('#submitpurposal').on('click',function(){
         
         
          var company_id = $('#company_id').val();
          var lead_email = $('#lead_email').val();
          var qty = $('#qty').val();
          var newprice = $('#newprice').val();
          var desc = $('#desc').val();
          var pricetotal=qty*newprice;
          
           
          $.ajax({
            url:"{{route('createpurposal')}}",
            type:"GET",
            data:{"data": array,"desc":desc, "company_id":company_id,"lead_email":lead_email},
            success:function(data){
              console.log(JSON.stringify(data));
              $('#msg').text(data); 
        //  $('#items-list').html(data);
         }
          })
        })

      // $("#search").on('keyup',function(){
      //  var value = $(this).val();
      // $.ajax({
      //  url:"{{route('search')}}",
      //  type:"GET",
      //  data:{"name": value},
      //  success:function(data){
      //    $('#items-list').html(data);
      //  }
      // });
      // });
      // $(document).on('click','li',function(){
        // var name = $(this).text();
        // $('#row-list').append('<td>name</td>');
        // $('#items-list').html("");
    // });
    });
</script>

@endsection

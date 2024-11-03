<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
</head>
<body>
    <div  style="text-align:center;">
        <div class="card">
            <div class="card-header">
                <h6>Place Order</h6>
               
                <div>{{$companyName}}</div>
                <div>{{$desc}}</div>
                <input type="hidden" value="{{$company_id}}" name="company_id" id="company_id">
            </div>
            <div id="msg"></div>
            <div class="card-body">
              
                <table class="table">
                    <thead>
                        <tr>
                            <th>S.No</th>
                            <th>Art Name</th>
                            <th>Art Category</th>
                            <th>Composition</th>
                            <th>Width</th>
                            <th>GRMT</th>
                            <th>Price/unit</th>
                            <th>unit Price</th>
                            <th>qty</th>
                            <th>Total Price</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php($count=1)
                        @foreach ($newarray as $index => $d)

                    
                        
                        <tr key="{{$d['itemdetail']->id}}">
                        <th>{{$count}}</th>
                           <input type="hidden" id="purposalid" name="purposalid" value="{{$d['itemdetail']->id }}"> 
                           <td contenteditable="true" class="editable" data-row="{{ $index }}">{{ $d['itemdetail']->art_code }}</td>
                            <td contenteditable="true" class="editable" data-row="{{ $index }}">{{ $d['itemdetail']->art_code }}</td>
                            <td contenteditable="true" class="editable" data-row="{{ $index }}">{{ $d['itemdetail']->lead_category }}</td>
                            <td contenteditable="true" class="editable" data-row="{{ $index }}">{{ $d['itemdetail']->composition }}</td>
                            <th contenteditable="true" class="editable" data-row="{{ $index }}">{{ $d['itemdetail']->width }}</th>
                            <td contenteditable="true" class="editable" data-row="{{ $index }}">{{ $d['itemdetail']->grmt }}</td>
                            <td contenteditable="true" class="editable newprice" data-row="{{ $index }}"><input value="{{ $d['newprice'] }}" disabled type="text"></td>
                            <td contenteditable="true" class="editable qty" data-row="{{ $index }}"><input type="text" name="qty"></td>
                            <td contenteditable="true" class="editable totalprice" data-row="{{ $index }}"><input type="text" name="totalprice" disabled></td>
                           
                        </tr>
                        @php($count++)
                        @endforeach
                       
                    </tbody>
                </table>
                <button type="submit" id="submitOrder" class="btn btn-success">Place Order</button>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.1.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.3/dist/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
    <script>
    $(document).ready(function() {
        // Array to store row data
        let rowDataArray = [];

        // Function to update total price
        function updateTotalPrice(row) {
            const qty = row.find('.qty input').val() || 0;
            const newprice = row.find('.newprice input').val() || 0;
            const totalprice = qty * newprice;
            row.find('.totalprice input').val(totalprice);
            // $('#totalpriceout').val(totalprice);
        }

        // Event listener for quantity input
        $('.qty input').on('keyup', function() {
            const row = $(this).closest('tr');
            updateTotalPrice(row);
            updateRowData(row);
        });

        // Function to update row data in the array
        function updateRowData(row) {
            const rowIndex = row.index();
            const rowData = {
                
                    id: row.find('input[name="purposalid"]').val(),
                    artName: row.find('.editable:nth-child(2)').text().trim(),
                    artCategory: row.find('.editable:nth-child(3)').text().trim(),
                    composition: row.find('.editable:nth-child(4)').text().trim(),
                    width: row.find('.editable:nth-child(5)').text().trim(),
                    grmt: row.find('.editable:nth-child(7)').text().trim(),
                    art: row.find('.editable:nth-child(8)').text().trim(),
                    price: row.find('.newprice input').val() || 0,
                    qty: row.find('.qty input').val() || 0,
                    totalPrice: row.find('.totalprice input').val() || 0,

            };
            rowDataArray[rowIndex] = rowData;
             
            console.log(rowDataArray);
        }

        // Button click event
        $('#submitOrder').on('click', function() {
            const com_id= $('#company_id').val()
            $.ajax({
                url: "{{route('placeOrder')}}",
                type: "GET",
                data: {
                    "data": rowDataArray,
                    "purposalId":"{{ request()->id }}",
                    "company_id": com_id,
                },
                success: function(data) {
                    console.log(data);
                    // Redirect if needed
                    if(data === "done") {
                        window.location.href = "{{ route('thankyou') }}";
                    }
                }
            });
        });
    });
</script>
    <!-- <script>
        $(document).ready(function() {
            // Array to store row data
            let rowDataArray = [];

            // Function to update total price
            function updateTotalPrice(row) {
                const qty = row.find('.qty input').val() || 0;
                const newprice = row.find('.newprice input').val() || 0;
                const totalprice = qty * newprice;
                row.find('.totalprice input').val(totalprice);
            }

            // Event listener for quantity input
            $('.qty input').on('keyup', function() {
                const row = $(this).closest('tr');
                updateTotalPrice(row);
                updateRowData(row);
            });

            // Function to update row data in the array
            function updateRowData(row) {
                const rowIndex = row.index();
                const rowData = {
                    artName: row.find('.editable:nth-child(2)').text().trim(),
                    artCategory: row.find('.editable:nth-child(3)').text().trim(),
                    composition: row.find('.editable:nth-child(4)').text().trim(),
                    width: row.find('.editable:nth-child(5)').text().trim(),
                    grmt: row.find('.editable:nth-child(6)').text().trim(),
                    price: row.find('.newprice input').val() || 0,
                    qty: row.find('.qty input').val() || 0,
                    totalPrice: row.find('.totalprice input').val() || 0
                };
                rowDataArray[rowIndex] = rowData;
                console.log(rowDataArray);
            }

            // Button click event
            $('#submitOrder').on('click', function() {
                
                var purposalid = $('#purposalid').val();
                $.ajax({
            url:"{{route('placeOrder')}}",
            type:"GET",
            data:{"data": rowDataArray ,"purposalid":purposalid},
            success:function(data){
                console.log(data);
        //    if(data="done"){
            
        //     window.location.href = "{{ route('thankyou') }}";
        //    }
        
         }
          })
            });
        });
    </script> -->
</body>
</html>


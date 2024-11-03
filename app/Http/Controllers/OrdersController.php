<?php

namespace App\Http\Controllers;


use App\Models\Company;
use App\Models\Items;
use App\Models\Lead;
use App\Models\ledgers;
use App\Models\Orders;
use App\Models\purposal;
use Illuminate\Support\Facades\Http;
use App\Models\States;
use Illuminate\Http\Request;
use App\Http\Requests\StoreOrdersRequest;
use App\Http\Requests\UpdateOrdersRequest;
use App\Imports\ImportOrders;
use App\Exports\OrdersExport;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\UploadedFile;
use Excel;


class OrdersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getState(Request $req){
        $states = States::where('country_id',$req->state)->get();
        return $states;
    }
   
    
public function importOrders(Request $request)
{
   
    if($request->method() == 'POST'){
   
    try {
        $file = $request->file('upload');

        // Check if file exists
        if (!$file) {
            return redirect()->back()->with('error', 'No file uploaded.');
        }

        $collection = Excel::toCollection(new ImportOrders, $file);
        $data = $collection->first()->toArray();

        $totalprice =0;
        
        $modifiedData = [];
        foreach ($data as $row) {
            $artCode = $row[0];
            $items = Items::where('art_code', $artCode)->get();

            $totalprice = $totalprice+(int)$row[2];
            
            foreach ($items as $item) {
                $item->qty = $row[1]; 
                $item->amount = $row[2];
            }
            // Only add the first item from the $items collection
            // assuming there's only one item per art code
            $modifiedData[] = $items->first();
        }

        $purposaldata = purposal::where('id',(int)$request->proposals_id)->get();
        
        // Construct modified data array
        $modifiedDataArray = [
            "purposalId"=>$request->proposals_id,
            "confirmed_order" => json_encode($modifiedData),
            "amount" => $totalprice,
            "status" => "Placed",
            "company_id" => $purposaldata[0]->company_id,
            "customer_id" => $purposaldata[0]->customer_id,

        ]; 

      
  // creating downloading data
    $export = new OrdersExport($modifiedDataArray);
   
    $data= Excel::store($export, 'public/orders/orders.xlsx');
   
    $filePath = Storage::url('public/orders/orders.xlsx');
        Excel::import(new ImportOrders, 'public/orders/orders.xlsx');

        // Get orders and companies
        $customers = Lead::where('status','Customer')->get();
        // $orders = Orders::with('company')->get();
        $companies = Company::all();

        $orders = Orders::with('company')->get();
        foreach($orders as $order){
            // $customername = Lead::where('customer_id',(int)$order->customer_id)->get();
            $customername = Lead::where('id', (int) $order->customer_id)
            ->select('company_name')
            ->first();
            if ($customername) {
                $order->customer_name = $customername->company_name;
            } else {
                $order->customer_name = null; // Set to null or handle as needed if no customer name found
            }
          

        }
        
 

        return view('mail.allorder', compact('orders', 'companies','customers'));
    } catch (\Exception $e) {
        // Handle any exceptions
        return redirect()->back()->with('error', 'Error importing orders: ' . $e->getMessage());
    
}
    }else{
        return redirect()->back();
    }
}
    // public function importOrders(Request $req){

    //     $file = $req->file('upload');

    //     $collection = Excel::toCollection(new ImportOrders, $file);
    //     $data = $collection->first()->toArray();
    //     $modifiedData = [];
    //     foreach ($data as $row) {
    //         $artCode = $row[1];
    //         $items = Items::where('art_code', $artCode)->get();
    //         if ($items->isNotEmpty()) {
    //             $row[1] = json_encode($items);
    //         }
    //         $modifiedData[] = $row;
    //     }

       

    // // creating downloading data
    // $export = new OrdersExport($modifiedData);
    // Excel::store($export, 'public/orders/orders.xlsx');
    // $filePath = Storage::url('public/orders/orders.xlsx');
  
    // Excel::import(new ImportOrders,'public/orders/orders.xlsx');
    // $orders = Orders::with('company')->get();
    // $companies = Company::all();
    // return view('mail.allorder', compact('orders', 'companies'));
  
   
   
    // }
    public function submitOrder(Request $req){
        // return $req->all();
        $data =$req->data;
        $totalPriceSum = 0;
        $totals = [];
        foreach ($data as $key => $value) {
            
            $totalPriceSum += $value['totalPrice'];
            $item =Items::find($value['id']);
            $item->qty = $value['qty'];
            $item->totalPrice = $value['totalPrice'];
            $totals[] =  $item;
          }
        //   $totalPricesJson = json_encode($totalPrices);
       
        $order =new Orders();
        $order->purposalId = $req->purposalId;
        $order->company_id = $req->company_id;
        $order->customer_id = $req->customer_id;
        $order->amount = $totalPriceSum;
        $order->confirmed_order = json_encode($totals);
        $order->status = "Placed";
        $order->save();
        return "done";
        }
        public function thankyou(){
            return view("mail.thankyou");
        }

        public function allOrders(Request $req){

            $customers = Lead::where('status','Customer')->get();
            $companies = Company::all();
            if (!empty($req->company_id)) {
                $orders = Orders::where('company_id',$req->company_id)->with('company')->get();
                foreach($orders as $order){
                   
                    // $customername = Lead::where('customer_id',(int)$order->customer_id)->get();
                    $customername = Lead::where('id', (int) $order->customer_id)
                    ->select('company_name')
                    ->first();
                    if ($customername) {
                        $order->customer_name = $customername->company_name;
                    } else {
                        $order->customer_name = null; // Set to null or handle as needed if no customer name found
                    }
                    
                }
               
                return view('mail.allorder', compact('orders', 'customers','companies'));
               
            } else {
                $orders = Orders::with('company')->get();
                foreach($orders as $order){
                    // $customername = Lead::where('customer_id',(int)$order->customer_id)->get();
                    $customername = Lead::where('id', (int) $order->customer_id)
                    ->select('company_name')
                    ->first();
                    if ($customername) {
                        $order->customer_name = $customername->company_name;
                    } else {
                        $order->customer_name = null; // Set to null or handle as needed if no customer name found
                    }
                  

                }
                
                return view('mail.allorder', compact('orders', 'customers','companies'));
            }
            
        }

        public function orderDetail($id){
            $orders = Orders::where('id',$id)->get();
            $purposalid = $orders[0]->purposalId;
            $orders = json_decode($orders[0]->confirmed_order);
           
            return view('mail.OrderDetail',compact('orders','purposalid'));
        }

        public function updateorder(Request $req){
        // return $req->order_id;
        $order = Orders::find($req->order_id);
        $order->status = $req->status;
        $order->update();
        return "done";
        }

        public function proposalsCount(Request $req){
             
            $purposal = purposal::where('customer_id',$req->customer_id)->get();
            return $purposal;
        }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

     public function pushToTally()
     {
        $requestXML = '<ENVELOPE>'.
        '<HEADER>'.
        '<TALLYREQUEST>Export Data</TALLYREQUEST>'.
        '</HEADER>'.
        '<BODY>'.
        '<EXPORTDATA>'.
        '<REQUESTDESC>'.
        '<REPORTNAME>Daybook</REPORTNAME>'.
        '<STATICVARIABLES>'.
        '<SVEXPORTFORMAT>$$SysName:XML</SVEXPORTFORMAT>'.
        '</STATICVARIABLES>'.
        '</REQUESTDESC>'.
        '</EXPORTDATA>'.
        '</BODY>'.
        '</ENVELOPE>';

$server = 'http://localhost:9000';
$headers = array( "Content-type: text/xml","Content-length:".strlen($requestXML) ,"Connection: close");
$ch = curl_init(); 
curl_setopt($ch, CURLOPT_URL, $server);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_TIMEOUT, 100);
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, $requestXML);
curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
$data = curl_exec($ch);



if(curl_errno($ch)){
    print curl_error($ch);
    echo "  something went wrong..... try later";
}else{
echo " request accepted";
    print $data;
    curl_close($ch);
}
         // Example dummy data (replace with your actual data formatting)
        //  $formattedData = [
        //      'invoice_number' => 'INV-001',
        //      'amount' => 1000,
        //      'customer_name' => 'John Doe',
        //      // Add more fields as per your Tally Prime integration requirements
        //  ];
 
         // Simulate sending data to Tally Prime's API endpoint
        //  $response = Http::post('http://tally-prime-api-url.com/data-endpoint', [
        //      'data' => $formattedData,
        //  ]);
 
         // Check the response from Tally Prime's API (this is just an example, handle according to your actual implementation)
        //  if ($response->successful()) {
        //      return response()->json(['message' => 'Data pushed to Tally Prime']);
        //  } else {
        //      return response()->json(['error' => 'Failed to push data to Tally Prime'], $response->status());
        //  }
     }
 
     public function getTallyVouchers(){
        $requestXML = '<ENVELOPE>'.
        '<HEADER>'.
        '<VERSION>1</VERSION>'.
        '<TALLYREQUEST>Export</TALLYREQUEST>'.
        '<TYPE>Data</TYPE>'.
        '<ID>Trial Balance</ID>'.
        '</HEADER>'.
        '<BODY>'.
        '<DESC>'.
        '<STATICVARIABLES>'.
        '<EXPLODEFLAG>Yes</EXPLODEFLAG>'.
        '<SVEXPORTFORMAT>$$SysName:XML</SVEXPORTFORMAT>'.
        '</STATICVARIABLES>'.
        '</DESC>'.
        '</BODY>'.
        '</ENVELOPE>';

        $server = 'http://localhost:9000';
        $headers = array( "Content-type: text/xml","Content-length:".strlen($requestXML) ,"Connection: close");
        $ch = curl_init(); 
        curl_setopt($ch, CURLOPT_URL, $server);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_TIMEOUT, 100);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $requestXML);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        $data = curl_exec($ch);
        if(curl_errno($ch)){
            print curl_error($ch);
            echo "  something went wrong..... try later";
        }else{
        // echo " request accepted";
            // print_r($data);
            // $string = $data;
            // Remove extra spaces and trim the string
            // $string = trim($string);

            // Explode the string by spaces
            // $parts = explode(" ", $string);

            $response = simplexml_load_string($data);

            // Convert the XML data into an array of objects
            $jsonData = json_encode($response); // Convert SimpleXMLElement to JSON string
            $dataArray = json_decode($jsonData, true); // Convert JSON string to associative array

            // Now $dataArray should contain your data as an array of objects
            print_r($dataArray);

            // Output the array
            // print_r($parts);
            curl_close($ch);
        }
     }

     public function getTallyledgers(){
        $requestXML = '<ENVELOPE>'.
        '<HEADER>'.
        '<VERSION>1</VERSION>'.
        '<TALLYREQUEST>Export</TALLYREQUEST>'.
        '<TYPE>COLLECTION</TYPE>'.
        '<ID>List of Ledgers</ID>'.
        '</HEADER>'.
        '<BODY>'.
        '<DESC>'.
        '<STATICVARIABLES>'.
        '<EXPLODEFLAG>Yes</EXPLODEFLAG>'.
        '<SVEXPORTFORMAT>$$SysName:XML</SVEXPORTFORMAT>'.
        '</STATICVARIABLES>'.
        '</DESC>'.
        '</BODY>'.
        '</ENVELOPE>';

        $server = 'http://localhost:9000';
        $headers = array( "Content-type: text/xml","Content-length:".strlen($requestXML) ,"Connection: close");
        $ch = curl_init(); 
        curl_setopt($ch, CURLOPT_URL, $server);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_TIMEOUT, 100);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $requestXML);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        $data = curl_exec($ch);
        if(curl_errno($ch)){
            print curl_error($ch);
            echo "  something went wrong..... try later";
        }else{

            $response = simplexml_load_string($data);

            // Convert the XML data into an array of objects
            $jsonData = json_encode($response); // Convert SimpleXMLElement to JSON string
            $dataArray = json_decode($jsonData, true); // Convert JSON string to associative array

            // Now $dataArray should contain your data as an array of objects
            $allledgers = $dataArray['BODY']['DATA']['COLLECTION']['LEDGER'];
            $names = [];
            foreach ($allledgers as $key => $value) {
                $name = $value['@attributes']['NAME'];
                $names[] = $name;
            }

            return view('mail.ledgers',compact('names'));
     
        }
     }
 
     public function getTallyitems(){

      
        $requestXML = '<ENVELOPE>'.
        '<HEADER>'.
        '<VERSION>1</VERSION>'.
        '<TALLYREQUEST>Export</TALLYREQUEST>'.
        '<TYPE>Collection</TYPE>'.
        '<ID>Custom List of StockItems</ID>'.
        '</HEADER>'.
        '<BODY>'.
        '<DESC>'.
        '<STATICVARIABLES />'.
        '<TDL>'.
            '<TDLMESSAGE>'.
                '<COLLECTION ISMODIFY="No" ISFIXED="No" ISINITIALIZE="Yes" ISOPTION="No" ISINTERNAL="No" NAME="Custom List of StockItems">'.
                    '<TYPE>StockItem</TYPE>'.
                    '<NATIVEMETHOD>MasterID</NATIVEMETHOD>'.
                    '<NATIVEMETHOD>OpeningBalance</NATIVEMETHOD>'.
                    '<Compute>OpeningBalance_NUmber:$OpeningBalance:PrimaryUnits</Compute>'.
                '</COLLECTION>'.
            '</TDLMESSAGE>'.
        '</TDL>'.
        '</DESC>'.
        '</BODY>'.
        '</ENVELOPE>';

        $server = 'http://localhost:9000';
        $headers = array( "Content-type: text/xml","Content-length:".strlen($requestXML) ,"Connection: close");
        $ch = curl_init(); 
        curl_setopt($ch, CURLOPT_URL, $server);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_TIMEOUT, 100);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $requestXML);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        $data = curl_exec($ch);
        if(curl_errno($ch)){
            print curl_error($ch);
            echo "  something went wrong..... try later";
        }else{

            $response = simplexml_load_string($data);
           // Assuming $xml is your SimpleXMLElement object containing the data

$namesWithOpeningBalance = [];

foreach ($response->BODY->DATA->COLLECTION->STOCKITEM as $item) {
    $name = (string) $item['NAME'];
    $openingBalance = isset($item->OPENINGBALANCE) ? (string) $item->OPENINGBALANCE : "";

    // Add name and opening balance to the array
    $itemData[] = [
        'name' => $name,
        'opening_balance' => $openingBalance,
    ];
}
 return view('tallyitems.tallyItems',compact('itemData'));
// Now $namesWithOpeningBalance contains an array of arrays with 'name' and 'opening_balance'
// dd($namesWithOpeningBalance);

        }
     }

     public function addItem(Request $req){
        $requestXML = $req->all();
        $requestXML = $requestXML['Item_Details'];
        $server = 'http://localhost:9000';
        $headers = array( "Content-type: text/xml" ,"Content-length: ".count($requestXML) ,"Connection: close" );

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $server);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_TIMEOUT, 100);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $requestXML);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        $data = curl_exec($ch);

        if(curl_errno($ch))
        {
            print curl_error($ch);
            echo "  something went wrong..... try later";
        }
        else
        {
            echo " request accepted";
            print  $data;
            curl_close($ch);
        }
     }

     public function addledgers(){
        return view('leadgers.addleader');
     }
     public function addNewledgers(Request $req)
     {
         $requestXML = '<ENVELOPE>'.
             '<HEADER>'.
                 '<TALLYREQUEST>Import Data</TALLYREQUEST>'.
             '</HEADER>'.
             '<BODY>'.
                 '<IMPORTDATA>'.
                     '<REQUESTDESC>'.
                         '<REPORTNAME>All Masters</REPORTNAME>'.
                     '</REQUESTDESC>'.
                     '<REQUESTDATA>'.
                         '<TALLYMESSAGE xmlns:UDF="TallyUDF">'.
                             '<LEDGER Action="Create">'.
                                 '<NAME>'.$req->lname.'</NAME>'.
                                 '<PARENT>Sundry Debtors</PARENT>'.
                             '</LEDGER>'.
                         '</TALLYMESSAGE>'. // Moved the closing tag to align correctly
                     '</REQUESTDATA>'. // Moved the closing tag to align correctly
                 '</IMPORTDATA>'.
             '</BODY>'.
         '</ENVELOPE>';
     
         $server = 'http://localhost:9000';
         $headers = array(
             "Content-type: text/xml",
             "Content-length: " . strlen($requestXML),
             "Connection: close"
         );
     
         $ch = curl_init(); 
         curl_setopt($ch, CURLOPT_URL, $server);
         curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
         curl_setopt($ch, CURLOPT_TIMEOUT, 100);
         curl_setopt($ch, CURLOPT_POST, true);
         curl_setopt($ch, CURLOPT_POSTFIELDS, $requestXML);
         curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
     
         $data = curl_exec($ch);
        //  dd($data);
     
         if(curl_errno($ch)) {
             echo "Curl error: " . curl_error($ch);
             echo "Something went wrong, try again later.";
         } else {
             $response = simplexml_load_string($data);
             return redirect('/get-tally-ledgers');
         }
     
         curl_close($ch);
     }

     public function editNewledgers($ledger){

        return view('leadgers.editledgers',compact('ledger'));
      
    //     $requestXML = '<ENVELOPE>'.
    //     '<HEADER>'.
    //         '<TALLYREQUEST>Import Data</TALLYREQUEST>'.
    //     '</HEADER>'.
    //     '<BODY>'.
    //         '<IMPORTDATA>'.
    //             '<REQUESTDESC>'.
    //                 '<REPORTNAME>All Masters</REPORTNAME>'.
    //             '</REQUESTDESC>'.
    //             '<REQUESTDATA>'.
    //                 '<TALLYMESSAGE xmlns:UDF="TallyUDF">'.
    //                     '<LEDGER   Name="'.$ledger.'" Action="alter">'.
    //                         // '<NAME>'.$ledger.'</NAME>'.
    //                         '<PARENT>'."Sundry Debtors".'</PARENT>'.
    //                     '</LEDGER>'.
    //                 '</TALLYMESSAGE>'. // Moved the closing tag to align correctly
    //             '</REQUESTDATA>'. // Moved the closing tag to align correctly
    //         '</IMPORTDATA>'.
    //     '</BODY>'.
    // '</ENVELOPE>';

    // $server = 'http://localhost:9000';
    // $headers = array(
    //     "Content-type: text/xml",
    //     "Content-length: " . strlen($requestXML),
    //     "Connection: close"
    // );

    // $ch = curl_init(); 
    // curl_setopt($ch, CURLOPT_URL, $server);
    // curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    // curl_setopt($ch, CURLOPT_TIMEOUT, 100);
    // curl_setopt($ch, CURLOPT_POST, true);
    // curl_setopt($ch, CURLOPT_POSTFIELDS, $requestXML);
    // curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

    // $data = curl_exec($ch);

    // if(curl_errno($ch)) {
    //     echo "Curl error: " . curl_error($ch);
    //     echo "Something went wrong, try again later.";
    // } else {
    //     $response = simplexml_load_string($data);
    //     return redirect('/get-tally-ledgers');
    // }

    // curl_close($ch);
     }

     public function updateledgers(Request $req){
      
        $requestXML = '<ENVELOPE>'.
            '<HEADER>'.
                '<TALLYREQUEST>Import Data</TALLYREQUEST>'.
            '</HEADER>'.
            '<BODY>'.
                '<IMPORTDATA>'.
                    '<REQUESTDESC>'.
                        '<REPORTNAME>All Masters</REPORTNAME>'.
                    '</REQUESTDESC>'.
                    '<REQUESTDATA>'.
                        '<TALLYMESSAGE xmlns:UDF="TallyUDF">'.
                            '<LEDGER Name="'.$req->olname.'" Action="alter">'.
                                '<NAME>'.$req->lname.'</NAME>'.
                                '<PARENT>Sundry Debtors</PARENT>'.
                            '</LEDGER>'.
                        '</TALLYMESSAGE>'.
                    '</REQUESTDATA>'.
                '</IMPORTDATA>'.
            '</BODY>'.
        '</ENVELOPE>';

        $server = 'http://localhost:9000';
        $headers = array(
            "Content-type: text/xml",
            "Content-length: " . strlen($requestXML),
            "Connection: close"
        );
    
        $ch = curl_init(); 
        curl_setopt($ch, CURLOPT_URL, $server);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_TIMEOUT, 100);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $requestXML);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    
        $data = curl_exec($ch);
        // dd($data);
    
        if(curl_errno($ch)) {
            echo "Curl error: " . curl_error($ch);
            echo "Something went wrong, try again later.";
        } else {
            $response = simplexml_load_string($data);
            return redirect('/get-tally-ledgers');
        }
    
     }

   
     public function deleteLedgers($ledger)
     {
        $requestXML = '<ENVELOPE>'.
        '<HEADER>'.
            '<TALLYREQUEST>Import Data</TALLYREQUEST>'.
        '</HEADER>'.
        '<BODY>'.
            '<IMPORTDATA>'.
                '<REQUESTDESC>'.
                    '<REPORTNAME>All Masters</REPORTNAME>'.
                '</REQUESTDESC>'.
                '<REQUESTDATA>'.
                    '<TALLYMESSAGE xmlns:UDF="TallyUDF">'.
                        '<LEDGER Name="'.$ledger.'" Action="Delete">'.
                            '<NAME>'.$ledger.'</NAME>'.
                            '<PARENT>Sundry Debtors</PARENT>'.
                        '</LEDGER>'.
                    '</TALLYMESSAGE>'.
                '</REQUESTDATA>'.
            '</IMPORTDATA>'.
        '</BODY>'.
    '</ENVELOPE>';

    $server = 'http://localhost:9000';
    $headers = array(
        "Content-type: text/xml",
        "Content-length: " . strlen($requestXML),
        "Connection: close"
    );

    $ch = curl_init(); 
    curl_setopt($ch, CURLOPT_URL, $server);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_TIMEOUT, 100);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $requestXML);
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

    $data = curl_exec($ch);

    if(curl_errno($ch)) {
        echo "Curl error: " . curl_error($ch);
        echo "Something went wrong, try again later.";
    } else {
        // Debug the response to see if the deletion was successful
        
        $response = simplexml_load_string($data);
        // dd($response);
        // Assuming redirect is a valid function in your framework
        return redirect('/get-tally-ledgers');
    }

    curl_close($ch);
     }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreOrdersRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreOrdersRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Orders  $orders
     * @return \Illuminate\Http\Response
     */
    public function show(Orders $orders)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Orders  $orders
     * @return \Illuminate\Http\Response
     */
    public function edit(Orders $orders)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateOrdersRequest  $request
     * @param  \App\Models\Orders  $orders
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateOrdersRequest $request, Orders $orders)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Orders  $orders
     * @return \Illuminate\Http\Response
     */
    public function destroy(Orders $orders)
    {
        //
    }
}





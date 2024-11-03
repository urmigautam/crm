<?php

namespace App\Imports;

use App\Models\Orders;
use App\Models\Items;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\ToModel;

class ImportOrders implements ToModel 
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    
    public function model(array $row)
    {
       
      
        if (empty(array_filter($row))) {
            return null;
        }
        return new Orders([
              
            "purposalId" =>$row[0]?? '',
            "confirmed_order"=> $row[1]?? '',
            "amount"=>$row[2]?? '',
            "status" =>$row[3]?? '',
            "company_id" =>$row[4]?? '',
            "customer_id" =>$row[5]?? '',
            
        ]);
    }
}

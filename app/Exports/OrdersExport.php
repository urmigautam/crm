<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;

class OrdersExport implements FromCollection
{
    protected $data;

    public function __construct($data)
    {
        $this->data = $data;
    }

    public function collection()
    {
        return collect([$this->data]);
    }

    public function toArray()
    {
        return $this->data;
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ledgers extends Model
{
    use HasFactory;
    protected $connection = 'odbc';
    protected $table = 'StockItems'; // Adjust table name as per Tally 
}

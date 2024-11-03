<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Orders extends Model
{
    use HasFactory;

    protected $fillable = [
        'purposalId',
        'confirmed_order',
        'amount',
        'status',
        'company_id',
        'customer_id',

    ];
    public function company(){
        return $this->belongsTo(Company::class,'company_id','id');
    }
}

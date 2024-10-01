<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class TransactionDetail extends Model
{
    use HasFactory;
    // protected $table = "pengadaan";
    protected $fillable = ['kd_product','id_transaction','quantity','weight','unit_price','unit_price','sub_total'];

}



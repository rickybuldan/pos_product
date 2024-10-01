<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    // protected $table = "obat";
    protected $fillable = ['product_name','price','file_path','stock','desc','weight','stock_minimum','stock_maximum','prod_code'];
}

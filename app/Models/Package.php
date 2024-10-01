<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Package extends Model
{
    use HasFactory;
    // protected $table = "obat";
    protected $fillable = ['package_name','price','category','file_path','desc'];
}

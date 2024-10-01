<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Transaction extends Model
{
    use HasFactory;
    // protected $table = "pengadaan";
    protected $fillable = ['no_transaction','transaction_start_date','transaction_end_date','transaction_type','status','created_by','price_total','customer_name','phone','email','address','description','payment_amount','exchange'];

    public static function generateNoTransaction($paramDate)
    {
        $prefix = 'TR';
        $paramx=Carbon::createFromFormat('Y-m-d H:i:s', $paramDate)->format('dmY');
        $date=$paramx;

        $lastBooking = Transaction::selectRaw("*, DATE_FORMAT(created_at, '%d%m%Y') AS formatted_booking_date")
        ->whereRaw("DATE_FORMAT(created_at, '%d%m%Y') = ?", [Carbon::parse($paramDate)->format('dmY')])
        ->orderBy('no_transaction', 'desc')
        ->first();
     
        if ($lastBooking) {
                $lastNumber = explode('/', $lastBooking->no_transaction);
                $lastSerial = (int)end($lastNumber);
                $newSerial = $lastSerial + 1;
          
        } else {
            $newSerial = 1;
        }
    
        $no_transaction = $prefix . '/' . $date . '/' . str_pad($newSerial, 5, '0', STR_PAD_LEFT);
    
        return $no_transaction;
    }

}



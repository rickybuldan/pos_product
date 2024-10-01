<?php

namespace App\Http\Controllers;

use App\Helpers\Master;
use App\Models\Pengadaan;
use App\Models\Transaction;
use App\Models\TransactionDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
class JobController extends Controller
{

    public function setStatusDone(Request $request)
    {

        $MasterClass = new Master();


        try {
            $saved = Transaction::where('transaction_start_date', '<=', now()->addHour())
                ->where('status', 30)
                ->update(['status' => 10]); 
                // auto done

            $saved = Transaction::where('transaction_start_date', '<=', now()->addHour())
                ->whereIn('status', [40, 20])
                ->update(['status' => 50]);
                // unpaid to canceled
               // booked to canceled

            if($saved){
                $results = [
                    'code' => '0',
                    'info' => $saved." Changed to done",
                ];
            }else{
                $results = [
                    'code' => '1',
                    'info' => "Not found or failed",
                ];
            }


        } catch (\Exception $e) {
            // Roll back the transaction in case of an exception
            $results = [
                'code' => '102',
                'info' => $e->getMessage(),
            ];

        }



        return $MasterClass->Results($results);

    }

    public function setStatusCancel(Request $request)
    {

        $MasterClass = new Master();


        try {
            $now=Carbon::now()->format('Y-m-d');
            $saved = Transaction::where('transaction_end_date', '<=', $now)
            ->whereNotIn('status', [10,30,50])
            ->update(['status' => 50]);
 
            if($saved){
                $results = [
                    'code' => '0',
                    'info' => $saved->no_transaction." Changed to cancel",
                ];
            }else{
                $results = [
                    'code' => '1',
                    'info' => "Not found or failed",
                ];
            }


        } catch (\Exception $e) {
            // Roll back the transaction in case of an exception
            $results = [
                'code' => '102',
                'info' => $e->getMessage(),
            ];

        }



        return $MasterClass->Results($results);

    }





}




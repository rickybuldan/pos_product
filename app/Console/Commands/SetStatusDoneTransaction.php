<?php

namespace App\Console\Commands;

use App\Models\Transaction;
use Illuminate\Console\Command;

class SetStatusDoneTransaction extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'donetransaction:cron';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Done Transaction';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        //
        Transaction::where('transaction_end_date', '>', now())
        ->where('status', 30)
        ->update(['status' => 10]);
    }
}

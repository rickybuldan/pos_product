<?php

namespace App\Console\Commands;

use App\Models\Transaction;
use Illuminate\Console\Command;

class SetStatusCanceledTransaction extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'canceltransaction:cron';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Cancel Transaction';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        //
        Transaction::where('transaction_end_date', '>', now())
        ->whereNotIn('status', [10,30,50])
        ->update(['status' => 50]);
    }
}

<?php

namespace App\Console\Commands;

use App\Http\Controllers\TransactionController;
use Illuminate\Console\Command;

class UserShowTransactions extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'user:transactions';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {

        $userId = $this->ask('Choose user id');

        if(!$userId){
            $this->error('Something went wrong!');
            return;
        }

        TransactionController::showTransactions($userId)->each(function ($transaction) {
            $this->line('id: ' . $transaction->id . ' | type: ' . $transaction->type->name . ' | amount: ' . $transaction->amount);
        });
    }
}

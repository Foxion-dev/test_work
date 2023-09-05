<?php

namespace App\Console\Commands;

use App\Http\Controllers\TransactionController;
use App\Models\User;
use Illuminate\Console\Command;

class UserBalanceChange extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'user:changeBalance';

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

        $amount = $this->ask('How much?');

        if(!is_numeric($amount)){
            $this->error('Something went wrong!');
            return;
        }


        $type = $this->ask('Choose type og transaction (1 - add, 2 - remove)');

        if(!in_array($type, [1,2] )){
            $this->error('Something went wrong!');
            return;
        }

        TransactionController::changeBalance($userId, $amount, $type);
    }
}

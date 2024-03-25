<?php

namespace App\Console\Commands;

use App\Models\Deposit;
use App\Models\Job;
use App\Models\Withdraw;
use Illuminate\Console\Command;

class SyncAppDataOnUpdate extends Command {
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'myapp:data-sync';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle() {
        //v5
        //Withdraw::query()->where( [ 'status' => false ] )->update( [ 'status' => null ] );
        //Deposit::query()->where( [ 'status' => false ] )->update( [ 'status' => null ] );
        //Job::query()->where( [ 'is_approved' => false ] )->update( [ 'is_approved' => null ] );

        return 0;
    }
}

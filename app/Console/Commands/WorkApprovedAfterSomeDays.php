<?php

namespace App\Console\Commands;

use App\Models\Work;
use App\Services\NotificationService;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;

class WorkApprovedAfterSomeDays extends Command {
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'work:approve {days=5}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'This Command Is For Approved Work After Couples Of days.';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle() {
        $days = $this->argument( 'days' );
       $works =  Work::query()->where( [ 'status' => 'pending' ] )->whereDate( 'created_at', '<', now()->subDays( $days ) )
            ->each( function ( $work ) {
                DB::transaction( function () use ( $work ) {
                    $work->user()->update( [ 'balance' => DB::raw( 'balance + ' . $work->per_worker_amount ) ] );
                    $work->update( [ 'status' => 'completed' ] );
                    ( new NotificationService() )->create( $work, true, 'Work' );
                } );
                Cache::forget( 'total_unread_notification' . $work->user_id );
            } );
        $this->info( 'All Worked Approved which are submitted before ' . now()->subDays( $days ) );

        return 0;
    }
}

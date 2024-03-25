<?php

namespace App\Providers;

use App\Models\Deposit;
use App\Models\Job;
use App\Models\Notification;
use App\Models\User;
use App\Models\Withdraw;
use App\Models\Work;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        View::composer('backend.layouts.partials.sidebar', function ($view) {
            $pending_jobs_count_sidebar = Cache::rememberForever('pending_jobs_count', function () {
                return Job::query()->where(['is_approved' => null])->count();
            });
            $pending_deposits_count  = Cache::rememberForever('pending_deposits_count', function () {
                return Deposit::query()->where(['status' => null])->count();
            });
            $pending_withdraws_count = Cache::rememberForever('pending_withdraws_count', function () {
                return Withdraw::query()->where(['status' => null])->count();
            });
            return $view->with([
                'pending_deposits_count'  => $pending_deposits_count,
                'pending_withdraws_count' => $pending_withdraws_count,
                'pending_jobs_count_sidebar' => $pending_jobs_count_sidebar
            ]);
        });
        Paginator::useBootstrap();

        View::composer('backend.dashboard', function ($view) {
            $pending_deposits_count  = Cache::rememberForever('pending_deposits_count', function () {
                return Deposit::query()->where(['status' => null])->count();
            });
            $pending_withdraws_count = Cache::rememberForever('pending_withdraws_count', function () {
                return Withdraw::query()->where(['status' => null])->count();
            });
            $pending_jobs_count      = Cache::rememberForever('pending_jobs_count', function () {
                return Job::query()->where(['is_approved' => null])->count();
            });
            $total_jobs_count        = Cache::rememberForever('total_jobs_count', function () {
                return Job::query()->count();
            });
            $total_deposits_amount   = Cache::rememberForever('total_deposits_amount', function () {
                return Deposit::query()->sum('amount');
            });
            $total_withdraws_amount  = Cache::rememberForever('total_withdraws_amount', function () {
                return Withdraw::query()->sum('amount');
            });
            $total_users_count       = Cache::rememberForever('total_users_count', function () {
                return User::query()->count();
            });
            return $view->with([
                'pending_deposits_count'  => $pending_deposits_count,
                'pending_withdraws_count' => $pending_withdraws_count,
                'pending_jobs_count'      => $pending_jobs_count,
                'total_jobs_count'        => $total_jobs_count,
                'total_deposits_amount'   => balanceFormat($total_deposits_amount),
                'total_withdraws_amount'  => balanceFormat($total_withdraws_amount),
                'total_users_count'       => $total_users_count,
            ]);
        });

        View::composer('layouts.partials.sidebar', function ($view) {
            $total_unread_notification = Cache::rememberForever('total_unread_notification' . Auth::id(), function () {
                return Notification::query()->where(['user_id' => Auth::id(), 'is_read' => false])->count();
            });
            return $view->with([
                'total_unread_notification' => $total_unread_notification,
            ]);
        });
    }
}

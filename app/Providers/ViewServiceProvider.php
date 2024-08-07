<?php

namespace App\Providers;

use App\Models\Admin;
use App\Models\Appointment;
use App\Models\Doctor;
use App\Models\Employee;
use App\Models\Medicine;
use App\Models\MedicineCategories;
use App\Models\Schedule;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class ViewServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
        View::composer('*', function ($view) {
            $users = User::all();
            $view->with('users', $users);
        });
    }
}

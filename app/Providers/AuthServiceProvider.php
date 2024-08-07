<?php

namespace App\Providers;

// use Illuminate\Support\Facades\Gate;
use App\Models\MedicineCategories;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        //
        MedicineCategories::class => MedicineCategories::class,
    ];

    /**
     * Register any auth / authorization services.
     */
    public function boot(): void
    {
        //
        $this->registerPolicies();
    }
}

<?php

namespace App\Providers;

use App\Models\Owner;
use App\Models\Car;
use App\Policies\OwnerPolicy;
use App\Policies\CarPolicy;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    protected $policies = [
        Owner::class => OwnerPolicy::class,
        Car::class => CarPolicy::class,
    ];

    public function boot()
    {
        $this->registerPolicies();
    }
}

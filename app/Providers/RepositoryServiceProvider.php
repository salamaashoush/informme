<?php

namespace App\Providers;

use App\Models\Package;
use App\Models\Receipt;
use App\Models\User;
use App\Repositories\Package\Eloquent\EloquentPackageRepository;
use App\Repositories\User\Eloquent\EloquentUserRepository;
use App\Repositories\Package\PackageRepository;
use App\Repositories\Receipt\Eloquent\EloquentReceiptRepository;
use App\Repositories\Receipt\ReceiptRepository;
use App\Repositories\User\UserRepository;
use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(UserRepository::class, function () {
            return new EloquentUserRepository(new User());
        });

        $this->app->bind(PackageRepository::class, function () {
            return new EloquentPackageRepository(new Package());
        });
        $this->app->bind(ReceiptRepository::class, function () {
            return new EloquentReceiptRepository(new Receipt());
        });
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}

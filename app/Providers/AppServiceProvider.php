<?php

namespace App\Providers;

use App\Domain\Book\Repository\BookRepository;
use App\Domain\Store\Repository\StoreRepository;
use App\Infrastructure\Persistence\Eloquent\Repositories\EloquentBookRepository;
use App\Infrastructure\Persistence\Eloquent\Repositories\EloquentStoreRepository;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(BookRepository::class, EloquentBookRepository::class);
        $this->app->bind(StoreRepository::class, EloquentStoreRepository::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}

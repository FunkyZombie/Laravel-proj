<?php

namespace App\Providers;

use App\Queries\QueryBuilder;
use App\Services\ParserService;
use App\Services\SocialService;

use App\Queries\NewsQueryBuilder;
use App\Services\Contracts\Parser;

use App\Services\Contracts\Social;
use Illuminate\Pagination\Paginator;
use App\Queries\CategoriesQueryBuilder;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(QueryBuilder::class, CategoriesQueryBuilder::class);
        $this->app->bind(QueryBuilder::class, NewsQueryBuilder::class);

        // Services

        $this->app->bind(Parser::class, ParserService::class);
        $this->app->bind(Social::class, SocialService::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Paginator::useBootstrapFive();
    }
}

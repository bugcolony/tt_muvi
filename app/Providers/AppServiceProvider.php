<?php

namespace App\Providers;

use App\Services\History\SearchHistoryRepository;
use App\Services\History\SearchHistoryRepositoryInterface;
use App\Services\History\Store\SearchHistorySessionStore;
use App\Services\History\Store\SearchHistoryStoreInterface;
use App\Services\Movies\Interfaces\MovieApiInterface;
use App\Services\Movies\OmdbMovieApi;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->bind(MovieApiInterface::class, OmdbMovieApi::class);
        $this->app->bind(SearchHistoryRepositoryInterface::class, SearchHistoryRepository::class);
        $this->app->bind(SearchHistoryStoreInterface::class, SearchHistorySessionStore::class);
    }

    public function boot(): void
    {
        //
    }
}

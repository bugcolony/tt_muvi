<?php

namespace App\Actions\Movies;

use App\Services\Movies\Interfaces\MovieApiInterface;
use App\Services\Movies\Models\Movie;
use Illuminate\Support\Facades\Cache;

readonly class FindMovie
{
    public function __construct(private MovieApiInterface $api) {}

    public function execute(string $id): Movie
    {
        $movieData = Cache::remember("movie:$id", 86400, fn () => $this->api->getById($id)->toArray());

        return new Movie(...$movieData);
    }
}

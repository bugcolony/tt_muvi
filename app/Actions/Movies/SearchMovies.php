<?php

namespace App\Actions\Movies;

use App\Services\History\SearchHistoryRepositoryInterface;
use App\Services\Movies\Interfaces\MovieApiInterface;
use App\Services\Owner\OwnerResolver;
use Illuminate\Support\Collection;

readonly class SearchMovies
{
    public function __construct(private MovieApiInterface $api, private SearchHistoryRepositoryInterface $repository) {}

    public function execute(string $term): Collection
    {
        if ($term !== '') {
            $this->repository->add(OwnerResolver::resolve(), $term);

            return $this->api->search($term);
        }

        return collect();
    }
}

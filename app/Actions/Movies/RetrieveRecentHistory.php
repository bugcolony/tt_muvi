<?php

namespace App\Actions\Movies;

use App\Services\History\SearchHistoryRepositoryInterface;
use App\Services\Owner\OwnerResolver;

readonly class RetrieveRecentHistory
{
    public function __construct(private SearchHistoryRepositoryInterface $repository) {}

    public function execute(): array
    {
        return $this->repository->get(OwnerResolver::resolve());
    }
}

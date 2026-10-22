<?php

namespace App\Services\History;

use App\Services\History\Store\SearchHistoryStoreInterface;

class SearchHistoryRepository implements SearchHistoryRepositoryInterface
{
    private SearchHistoryStoreInterface $store;

    public function __construct(SearchHistoryStoreInterface $store)
    {
        $this->store = $store;
    }

    public function add(string $id, string $term): void
    {
        $history = $this->store->get($id);

        $history = array_filter($history, static fn ($item) => strtolower($item) !== strtolower($term));

        array_unshift($history, $term);

        $this->store->set($id, array_slice($history, 0, self::TERM_COUNT));
    }

    public function get(string $id): array
    {
        return $this->store->get($id);
    }
}

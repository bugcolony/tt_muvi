<?php

namespace App\Services\History\Store;

use Illuminate\Support\Facades\Session;

class SearchHistorySessionStore implements SearchHistoryStoreInterface
{
    const string STORE_KEY = 'search_history';

    public function set(string $id, array $terms): void
    {
        Session::put(self::STORE_KEY, $terms);
    }

    public function get(string $id): array
    {
        return Session::get(self::STORE_KEY, []);
    }

    public function delete(string $id, string $term): void
    {
        Session::put(self::STORE_KEY, array_filter($this->get($id), static fn ($item) => $item !== $term));
    }
}

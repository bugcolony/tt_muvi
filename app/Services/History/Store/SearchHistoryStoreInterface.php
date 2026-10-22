<?php

namespace App\Services\History\Store;

interface SearchHistoryStoreInterface
{
    public function set(string $id, array $terms): void;

    public function get(string $id): array;
}

<?php

namespace App\Services\History;

interface SearchHistoryRepositoryInterface
{
    const int TERM_COUNT = 5;

    public function add(string $id, string $term): void;

    public function get(string $id): array;
}

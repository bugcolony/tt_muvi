<?php

namespace App\Services\Movies\Interfaces;

use App\Services\Movies\Models\Movie;
use Illuminate\Support\Collection;

interface MovieApiInterface
{
    public function getById(string $id): Movie;

    public function search(string $search): Collection;
}

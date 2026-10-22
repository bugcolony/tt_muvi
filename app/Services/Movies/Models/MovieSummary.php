<?php

namespace App\Services\Movies\Models;

readonly class MovieSummary
{
    public function __construct(
        public string $id,
        public string $title,
        public ?string $year = null,
        public ?string $poster = null,
    ) {}
}

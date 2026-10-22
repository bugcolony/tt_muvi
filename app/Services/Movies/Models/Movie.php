<?php

namespace App\Services\Movies\Models;

use Illuminate\Contracts\Support\Arrayable;

readonly class Movie implements Arrayable
{
    public function __construct(
        public string $id,
        public string $title,
        public ?string $year = null,
        public ?string $plot = null,
        public ?string $director = null,
        public ?string $writer = null,
        public ?string $actors = null,
        public ?string $genre = null,
        public ?string $rating = null,
        public ?string $runtime = null,
        public ?string $poster = null,
        public ?string $imdb_rating = null,
        public ?string $imdb_votes = null,
        public ?string $metascore = null,
        public ?string $awards = null,
        public ?string $box_office = null
    ) {}

    public function toArray(): array
    {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'year' => $this->year,
            'plot' => $this->plot,
            'director' => $this->director,
            'writer' => $this->writer,
            'actors' => $this->actors,
            'genre' => $this->genre,
            'rating' => $this->rating,
            'runtime' => $this->runtime,
            'poster' => $this->poster,
            'imdb_rating' => $this->imdb_rating,
            'imdb_votes' => $this->imdb_votes,
            'metascore' => $this->metascore,
            'awards' => $this->awards,
            'box_office' => $this->box_office,
        ];
    }
}

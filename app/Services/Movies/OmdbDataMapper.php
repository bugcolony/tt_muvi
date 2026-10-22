<?php

namespace App\Services\Movies;

use App\Services\Movies\Models\Movie;
use App\Services\Movies\Models\MovieSummary;
use Illuminate\Support\Collection;

class OmdbDataMapper
{
    const string NULL_VALUE = 'N/A';

    public static function mapMovie(array $data): Movie
    {
        return new Movie(
            id: $data['imdbID'],
            title: $data['Title'],
            year: self::sanitizeValue($data['Year']),
            plot: self::sanitizeValue($data['Plot']),
            director: self::sanitizeValue($data['Director']),
            writer: self::sanitizeValue($data['Writer']),
            actors: self::sanitizeValue($data['Actors']),
            genre: self::sanitizeValue($data['Genre']),
            rating: self::sanitizeValue($data['Rated']),
            runtime: self::sanitizeValue($data['Runtime']),
            poster: self::sanitizeValue($data['Poster']),
            imdb_rating: self::sanitizeValue($data['imdbRating']),
            imdb_votes: self::sanitizeValue($data['imdbVotes']),
            metascore: self::sanitizeValue($data['Metascore']),
            awards: self::sanitizeValue($data['Awards']),
            box_office: self::sanitizeValue($data['BoxOffice']),
        );
    }

    public static function mapSummaryList(array $data): Collection
    {
        $list = collect();

        foreach ($data as $item) {
            $list->push(new MovieSummary(
                id: $item['imdbID'],
                title: self::sanitizeValue($item['Title']),
                year: self::sanitizeValue($item['Year']),
                poster: self::sanitizeValue($item['Poster']),
            ));
        }

        return $list;
    }

    public static function sanitizeValue(string $value): ?string
    {
        if ($value === self::NULL_VALUE) {
            return null;
        }

        return trim($value);
    }
}

<?php

namespace App\Services\Movies;

use App\Exceptions\InvalidSearchTermException;
use App\Exceptions\MovieApiException;
use App\Exceptions\MovieNotFoundException;
use App\Exceptions\TooManyResultsException;
use App\Services\Movies\Interfaces\MovieApiInterface;
use App\Services\Movies\Models\Movie;
use Exception;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Http;

class OmdbMovieApi implements MovieApiInterface
{
    private string $url;

    private string $key;

    public function __construct()
    {
        $this->url = config('services.omdb.url');
        $this->key = config('services.omdb.key');
    }

    /**
     * @throws Exception
     */
    public function getById(string $id): Movie
    {
        return OmdbDataMapper::mapMovie($this->request(['i' => $id, 'plot' => 'full']));
    }

    /**
     * @throws Exception
     */
    public function search(string $search): Collection
    {
        $this->validateSearchTerm($search);

        $data = $this->request(['s' => $search]);

        return OmdbDataMapper::mapSummaryList($data['Search'] ?? []);
    }

    /**
     * @throws Exception
     */
    private function request(array $params): array
    {
        try {
            $response = Http::retry(3, 100, throw: false)
                ->get($this->url, [
                    'apikey' => $this->key,
                    'type' => 'movie',
                    ...$params,
                ]);

        } catch (Exception $e) {
            throw new MovieApiException('Omdb API Error: '.$e->getMessage());
        }

        $body = $response->json();

        if (! is_array($body) || ! isset($body['Response'])) {
            throw new MovieApiException('Omdb API Error: Invalid response');
        }

        if ($body['Response'] !== 'True') {
            throw $this->analyseError($body['Error'] ?? 'Omdb API call failed');
        }

        return $body;
    }

    private function analyseError(string $error): Exception
    {
        return match ($error) {
            'Movie not found!' => new MovieNotFoundException('Movie not found!'),
            'Too many results.' => new TooManyResultsException('Too many results.'),
            default => new MovieApiException($error),
        };
    }

    /**
     * @throws InvalidSearchTermException
     */
    private function validateSearchTerm(string $term): void
    {
        if (strlen($term) < 3) {
            throw new InvalidSearchTermException('Search term too short');
        }
    }
}

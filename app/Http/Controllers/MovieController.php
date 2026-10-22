<?php

namespace App\Http\Controllers;

use App\Actions\Movies\FindMovie;
use App\Actions\Movies\RetrieveRecentHistory;
use App\Actions\Movies\SearchMovies;
use App\Exceptions\InvalidSearchTermException;
use App\Exceptions\MovieNotFoundException;
use App\Exceptions\TooManyResultsException;
use App\Http\Requests\SearchMovieRequest;

class MovieController extends Controller
{
    public function index(SearchMovieRequest $request, SearchMovies $action, RetrieveRecentHistory $recentHistory)
    {
        $s = $request->safe()->input('search');
        $data = [];
        $error = null;

        try {
            $data = $s ? $action->execute($s) : [];
        } catch (MovieNotFoundException|InvalidSearchTermException|TooManyResultsException $e) {
            // View provides sufficient feedback. Skip logging
        } catch (\Exception $e) {
            report($e);
            session()->flash('error', 'Could not retrieve movie information. Try again later.');
        }

        return view('movies.index', [
            'data' => $data,
            'history' => $recentHistory->execute(),
            'error' => $error,
        ]);
    }

    public function show(string $id, FindMovie $action)
    {
        try {
            $movie = $action->execute($id);
        } catch (MovieNotFoundException $e) {
            return redirect()->route('home')->with('error', 'Movie not found.');
        } catch (\Exception $e) {
            report($e);

            return redirect()->route('home')->with('error', 'Something went wrong.');
        }

        return view('movies.show', [
            'movie' => $movie,
        ]);
    }
}

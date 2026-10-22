<?php

use App\Services\History\SearchHistoryRepository;
use App\Services\History\Store\SearchHistoryStoreInterface;

beforeEach(function () {
    $this->store = Mockery::mock(SearchHistoryStoreInterface::class);

    $this->repository = new SearchHistoryRepository($this->store);
});

test('adds search term to the history', function () {
    $this->store
        ->shouldReceive('get')
        ->once()
        ->with('user-a')
        ->andReturn([]);

    $this->store
        ->shouldReceive('set')
        ->once()
        ->with('user-a', ['batman']);

    $this->repository->add('user-a', 'batman');
});

test('retrieve saved history', function () {
    $this->store
        ->shouldReceive('get')
        ->once()
        ->with('user-a')
        ->andReturn(['superman', 'batman', 'spiderman']);

    expect($this->repository->get('user-a'))
        ->toBe(['superman', 'batman', 'spiderman']);
});

test('adds search term to the beginning of the history', function () {
    $this->store
        ->shouldReceive('get')
        ->once()
        ->with('user-a')
        ->andReturn(['superman', 'spiderman']);

    $this->store
        ->shouldReceive('set')
        ->once()
        ->with('user-a', ['batman', 'superman', 'spiderman']);

    $this->repository->add('user-a', 'batman');
});

test('removes duplicate term', function () {
    $this->store
        ->shouldReceive('get')
        ->once()
        ->with('user-a')
        ->andReturn(['batman', 'superman', 'spiderman']);

    $this->store
        ->shouldReceive('set')
        ->once()
        ->with('user-a', ['spiderman', 'batman', 'superman']);

    $this->repository->add('user-a', 'spiderman');
});

test('at most 5 terms are persisted', function () {
    $this->store
        ->shouldReceive('get')
        ->once()
        ->with('user-a')
        ->andReturn(['batman', 'superman', 'spiderman', 'peppa', 'pig']);

    $this->store
        ->shouldReceive('set')
        ->once()
        ->with('user-a', ['tony', 'batman', 'superman', 'spiderman', 'peppa']);

    $this->repository->add('user-a', 'tony');
});

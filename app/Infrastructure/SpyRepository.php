<?php

namespace App\Infrastructure;

use App\Application\SpyData;
use App\Domain\Spy\Commands\CreateSpy;
use App\Domain\Spy\Queries\GetFilteredSpies;
use App\Domain\Spy\Queries\GetRandomSpies;
use App\Models\Spy;
use Illuminate\Support\Collection;

class SpyRepository
{
    public function __construct(
        public Spy $lot
    )
    {
    }

    public function index()
    {
        return (new GetFilteredSpies())->execute();
    }

    public static function store(SpyData $data): Spy
    {
        return (new CreateSpy($data))->execute();
    }

    public static function random(int $number): Collection
    {
        return (new GetRandomSpies($number))->execute();
    }

}

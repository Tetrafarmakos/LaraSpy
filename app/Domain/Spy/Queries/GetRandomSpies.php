<?php

namespace App\Domain\Spy\Queries;

use App\Application\SpyData;
use App\Models\Spy;
use Illuminate\Support\Collection;

class GetRandomSpies
{
    public function __construct(public int $number)
    {
    }

    public function execute(): Collection
    {
        return SpyData::collect(Spy::inRandomOrder()->limit(5)->get());
    }
}

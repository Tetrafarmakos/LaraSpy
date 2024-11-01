<?php

namespace App\Infrastructure;

use App\Application\SpyData;
use App\Domain\Spy\Commands\CreateSpy;
use App\Models\Spy;

class SpyRepository
{
    public function __construct(
        public Spy $lot
    )
    {
    }

    public static function store(SpyData $data): Spy
    {
        return (new CreateSpy($data))->execute();
    }

}

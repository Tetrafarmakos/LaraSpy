<?php

namespace App\Domain\Spy\Commands;

use App\Application\SpyData;
use App\Models\Spy;

class CreateSpy
{
    public function __construct(public SpyData $data)
    {
    }

    public function execute(): Spy
    {
        $spy = Spy::create($this->data->all());

        return $spy;
    }

}

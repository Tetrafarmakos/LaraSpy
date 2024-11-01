<?php

namespace App\Http\Controllers;

use App\Application\SpyData;
use App\Infrastructure\SpyRepository;

class SpyController extends Controller
{
    public function create(SpyData $data)
    {
        $spy = SpyRepository::store($data);

        return response()->json($spy, 201);
    }
}

<?php

namespace App\Http\Controllers;

use App\Application\SpyData;
use App\Infrastructure\SpyRepository;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;

class SpyController extends Controller implements HasMiddleware
{
    public static function middleware(): array
    {
        return [
            new Middleware('auth:sanctum', only: ['create']),
        ];
    }

    public function index()
    {
        return response()->json(SpyRepository::index());
    }

    public function create(SpyData $data)
    {
        return response()->json(SpyRepository::store($data), 201);
    }

    public function random()
    {
        return response()->json(SpyRepository::random(5));
    }
}

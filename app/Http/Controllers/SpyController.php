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
            new Middleware('auth:sanctum', only: ['store']),
        ];
    }

    public function index()
    {
        $supportedFilters = ['age', 'name', 'surname'];

        $providedFilters = array_keys(request()->all());

        foreach ($providedFilters as $filter) {
            if (!in_array($filter, $supportedFilters) && !in_array($filter, ['page', 'sort'])) {
                return response()->json(['error' => "Unsupported filter: $filter"], 400);
            }
        }

        return response()->json(SpyRepository::index());
    }

    public function store(SpyData $data)
    {
        return response()->json(SpyRepository::store($data), 201);
    }

    public function random()
    {
        return response()->json(SpyRepository::random(5));
    }
}

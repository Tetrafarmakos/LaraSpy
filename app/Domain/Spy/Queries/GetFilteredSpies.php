<?php

namespace App\Domain\Spy\Queries;

use App\Application\SpyData;
use App\Models\Spy;
use Illuminate\Support\Collection;

class GetFilteredSpies
{
    public function execute()
    {
        $query = Spy::query();

        $supportedFilters = ['age', 'name', 'surname'];

        $providedFilters = array_keys(request()->all());

        foreach ($providedFilters as $filter) {
            if (!in_array($filter, $supportedFilters) && !in_array($filter, ['page', 'sort'])) {
                return response()->json(['error' => "Unsupported filter: $filter"], 400);
            }
        }

        $sortFields = request()->input('sort', []);

        foreach ($sortFields as $field => $direction) {
            if ($field === 'full_name') {
                $query->orderByRaw("CONCAT(name, ' ', surname) $direction");
            } else {
                $query->orderBy($field, $direction);
            }
        }

        return $query->search()->paginate(10);
    }
}

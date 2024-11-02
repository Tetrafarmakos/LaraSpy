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

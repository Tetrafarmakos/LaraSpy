<?php

namespace App\Models;

use App\Infrastructure\SpyRepository;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Spy extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected function casts()
    {
        return [
            'date_of_birth' => 'date',
            'date_of_death' => 'date',
        ];
    }

    public function scopeSearch(Builder $query): void
    {
        $query
            ->when(request('age') ?? null, function ($query, $age) {
                $query->whereRaw("TIMESTAMPDIFF(YEAR, date_of_birth, CURDATE()) = ?", [$age]);
            })
            ->when(request('name') ?? null, function ($query, $name) {
                $query->where('name', $name);
            })
            ->when(request('surname') ?? null, function ($query, $surname) {
                $query->where('surname', $surname);
            });
    }

    public function repository(): SpyRepository
    {
        return new SpyRepository($this);
    }
}

<?php

namespace App\Models;

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
}
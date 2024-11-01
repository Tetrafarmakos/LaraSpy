<?php

namespace Database\Factories;

use App\Models\Spy;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;

class SpyFactory extends Factory
{
    protected $model = Spy::class;

    public function definition(): array
    {
        return [
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
            'name' => $this->faker->name(),
            'surname' => $this->faker->word(),
            'agency' => $this->faker->word(),
            'country_of_operation' => $this->faker->word(),
            'date_of_birth' => Carbon::now(),
            'date_of_death' => Carbon::now(),
        ];
    }
}

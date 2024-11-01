<?php

namespace App\Application;

use DateTime;
use Illuminate\Validation\Rule;
use Spatie\LaravelData\Attributes\WithCast;
use Spatie\LaravelData\Casts\DateTimeInterfaceCast;
use Spatie\LaravelData\Data;
use Spatie\LaravelData\Optional;

class SpyData extends Data
{
    public function __construct(
        public string   $name,
        public string   $surname,
        public string   $agency,
        public string   $country_of_operation,
        #[WithCast(DateTimeInterfaceCast::class, format: 'Y-m-d')]
        public DateTime $date_of_birth,
        #[WithCast(DateTimeInterfaceCast::class, format: 'Y-m-d')]
        public DateTime|Optional   $date_of_death,
    )
    {
    }

    public static function rules(): array
    {
        return [
            'name' => [
                'required',
                'string',
                Rule::unique('spies')->where(function ($query) {
                    return $query->where('name', request('name'))
                        ->where('surname', request('surname'));
                })
            ],
            'surname' => ['required', 'string'],
            'agency' => ['required', Rule::in(['CIA', 'MI6', 'KGB'])],
            'country_of_operation' => ['required', 'string'],
            'date_of_birth' => ['required', 'date'],
            'date_of_death' => ['nullable', 'date'],
        ];
    }
}

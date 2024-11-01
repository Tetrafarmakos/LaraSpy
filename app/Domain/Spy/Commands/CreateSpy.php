<?php

namespace App\Domain\Spy\Commands;

use App\Models\Spy;
use Illuminate\Http\Request;

class CreateSpy
{
    public function __construct(public Request $request)
    {
    }

    public function execute(): Spy
    {
        $spy = Spy::create([
            'name' => $this->request->name,
            'surname' => $this->request->surname,
            'agency' => $this->request->agency,
            'country_of_operation' => $this->request->country_of_operation,
            'date_of_birth' => $this->request->date_of_birth,
            'date_of_death' => $this->request->date_of_death
        ]);

        return $spy;
    }

}

<?php

namespace App\Http\Controllers;

use App\Domain\Spy\Commands\CreateSpy;
use Illuminate\Http\Request;

class SpyController extends Controller
{
    public function create(Request $request)
    {
        $command = new CreateSpy($request);
        $spy = $command->execute();

        return response()->json($spy, 201);
    }
}

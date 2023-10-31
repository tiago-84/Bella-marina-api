<?php

namespace App\Http\Controllers;

use App\Http\Resources\V1\SweepstakeResource;
use App\Models\Sweepstake;
use Illuminate\Http\Request;

class SweepstakeController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        return SweepstakeResource::collection(Sweepstake::all());
    }
}

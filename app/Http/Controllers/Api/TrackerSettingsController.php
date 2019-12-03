<?php

namespace App\Http\Controllers\Api;

use App\Events\EngineResumed;
use Illuminate\Http\Request;
use App\Events\EngineStopped;
use App\Http\Controllers\Controller;

class TrackerSettingsController extends Controller
{
    public function stopEngine(Request $request)
    {
        event(new EngineStopped());
        return response()->json(['message' => 'Command sent'], 200);
    }

    public function resumeEngine(Request $request)
    {
        event(new EngineResumed());
        return response()->json(['message' => 'Command sent'], 200);
    }
}

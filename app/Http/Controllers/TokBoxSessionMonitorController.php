<?php

namespace App\Http\Controllers;

use App\TokBoxCallbackHandler;
use Illuminate\Http\Request;
use Laravel\Lumen\Routing\Controller;

class TokBoxSessionMonitorController extends Controller
{
    public function store(Request $request, TokBoxCallbackHandler $tokBoxCallbackHandler)
    {
        \Log::info('TOKBOX_CALLBACK_RECEIVED', $request->all());

        $tokBoxCallbackHandler->handleSessionMonitorCallback($request);
    }
}

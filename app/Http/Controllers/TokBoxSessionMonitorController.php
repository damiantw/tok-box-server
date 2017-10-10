<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Laravel\Lumen\Routing\Controller;

class TokBoxSessionMonitorController extends Controller
{
    public function store(Request $request)
    {
        \Log::info("TOKBOX_CALLBACK_RECEIVED", $request->all());
    }
}

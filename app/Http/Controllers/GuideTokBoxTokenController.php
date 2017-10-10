<?php

namespace App\Http\Controllers;


use App\TokBox;
use App\TokBoxSession;
use Laravel\Lumen\Routing\Controller;

class GuideTokBoxTokenController extends Controller
{
    public function store(TokBox $tokBox, $sessionId)
    {
        $tokBoxSession = TokBoxSession::whereValue($sessionId)->firstOrFail();

        return response()->json($tokBox->createGuideToken($tokBoxSession));
    }
}
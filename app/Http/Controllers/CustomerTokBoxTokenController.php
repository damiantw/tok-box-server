<?php

namespace App\Http\Controllers;

use App\TokBox;
use App\TokBoxSession;
use Laravel\Lumen\Routing\Controller;

class CustomerTokBoxTokenController extends Controller
{
    public function store(TokBox $tokBox, $sessionId)
    {
        $tokBoxSession = TokBoxSession::query()->findOrFail($sessionId);

        return response()->json($tokBox->createCustomerToken($tokBoxSession));
    }
}

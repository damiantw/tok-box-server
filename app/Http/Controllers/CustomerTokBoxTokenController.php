<?php

namespace App\Http\Controllers;

use App\TokBox;
use App\TokBoxSession;

class CustomerTokBoxTokenController
{
    public function store(TokBox $tokBox, $sessionId)
    {
        $tokBoxSession = TokBoxSession::whereValue($sessionId)->firstOrFail();

        return response()->json($tokBox->createCustomerToken($tokBoxSession));
    }
}

<?php

namespace App;

use Illuminate\Support\Carbon;
use OpenTok\MediaMode;
use OpenTok\OpenTok;
use OpenTok\Role;

class TokBox
{
    protected $openTok;

    public function __construct(OpenTok $openTok)
    {
        $this->openTok = $openTok;
    }

    public function createSession(string  $sessionName)
    {
        $session = $this->openTok->createSession(['mediaMode' => MediaMode::ROUTED]);

        return TokBoxSession::query()->create([
            'tok_box_session_id' => $session->getSessionId(),
            'name' => $sessionName,
        ]);
    }

    public function createGuideToken(TokBoxSession $tokBoxSession)
    {
        return $this->createToken($tokBoxSession, Role::MODERATOR, Carbon::now()->addWeek());
    }

    public function createCustomerToken(TokBoxSession $tokBoxSession)
    {
        return $this->createToken($tokBoxSession, Role::PUBLISHER, Carbon::now()->addDay());
    }

    public function createToken(TokBoxSession $tokBoxSession, string $role, Carbon $expiresAt)
    {
        $token = $this->openTok->generateToken($tokBoxSession->sessionId(), [
            'role' => $role,
            'expires' => $expiresAt->getTimestamp(),
        ]);

        return TokBoxToken::query()->create([
            'value' => $token,
            'role' => $role,
            'expires_at' => $expiresAt,
        ]);
    }
}

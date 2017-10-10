<?php

namespace App;

use Illuminate\Database\Eloquent\Builder;
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

    public function getAvailableSessions()
    {
        return TokBoxSession::query()->whereHas('tokens', function (Builder $query) {

            $query->where('expires_at', '<=', Carbon::now())
                ->whereHas('connections', function (Builder $query) {

                    $query->where('destroyed', '=', false)
                        ->whereHas('streams', function (Builder $query) {
                            $query->where('destroyed', '=', false);
                        });

                });

        })->get();
    }

    public function createSession(string  $sessionName)
    {
        $session = $this->openTok->createSession(['mediaMode' => MediaMode::ROUTED]);

        return TokBoxSession::query()->create([
            'value' => $session->getSessionId(),
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
        $data = uniqid();

        $token = $this->openTok->generateToken($tokBoxSession->sessionId(), [
            'role' => $role,
            'expires' => $expiresAt->getTimestamp(),
            'data' => $data,
        ]);

        return TokBoxToken::query()->create([
            'value' => $token,
            'role' => $role,
            'data' => $data,
            'expires_at' => $expiresAt,
        ]);
    }
}

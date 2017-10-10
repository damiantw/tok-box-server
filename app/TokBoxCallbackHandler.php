<?php

namespace App;

use Illuminate\Http\Request;

class TokBoxCallbackHandler
{
    const CONNECTION_CREATED_EVENT = 'connectionCreated';

    const CONNECTION_DESTROYED_EVENT = 'connectionDestroyed';

    const STREAM_CREATED_EVENT = 'streamCreated';

    const STREAM_DESTROYED_EVENT = 'streamDestroyed';

    public function handleSessionMonitorCallback(Request $request)
    {
        $event = $request->input('event');

        $connection = $request->input('connection');

        $stream = $request->input('stream');

        $reason = $request->input('reason');

        switch ($event) {
            case self::CONNECTION_CREATED_EVENT:
                $this->handleConnectionCreated($connection);
                break;
            case self::CONNECTION_DESTROYED_EVENT:
                $this->handleConnectionDestroyed($connection, $reason);
                break;
            case self::STREAM_CREATED_EVENT:
                $this->handleStreamCreated($stream);
                break;
            case self::STREAM_DESTROYED_EVENT:
                $this->handleStreamDestroyed($stream, $reason);
                break;
        }
    }

    protected function handleConnectionCreated($connection)
    {
        $tokenData = data_get($connection, 'data');

        $token = TokBoxToken::whereData($tokenData)->firstOrFail();

        $connectionValue = data_get($connection, 'id');

        $token->connections()->create([
            'value' => $connectionValue,
        ]);
    }

    protected function handleConnectionDestroyed($connection, $reason)
    {
        $connectionValue = data_get($connection, 'id');

        $connection = TokBoxConnection::whereValue($connectionValue)->firstOrFail();

        $connection->destroyed = true;
        $connection->destroy_reason = $reason;
        $connection->save();
    }

    protected function handleStreamCreated($stream)
    {
        $connectionValue = data_get($stream, 'connection.id');

        $connection = TokBoxConnection::whereValue($connectionValue)->firstOrFail();

        $streamValue = data_get($stream, 'id');

        $streamVideoType = data_get($stream, 'videoType');

        $connection->streams()->create([
            'value' => $streamValue,
            'video_type' => $streamVideoType
        ]);
    }

    protected function handleStreamDestroyed($stream, $reason)
    {
        $streamValue = data_get($stream, 'id');

        $stream = TokBoxStream::whereValue($streamValue)->firstOrFail();

        $stream->destroyed = true;
        $stream->destroy_reason = $reason;
        $stream->save();
    }
}

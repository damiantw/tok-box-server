<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\TokBoxConnection
 *
 * @property int $id
 * @property int $tok_box_session_id
 * @property string $value
 * @property int $destroyed
 * @property string|null $destroy_reason
 * @property \Carbon\Carbon|null $created_at
 * @property \Carbon\Carbon|null $updated_at
 * @property-read \App\TokBoxSession $session
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\TokBoxStream[] $streams
 * @method static \Illuminate\Database\Eloquent\Builder|\App\TokBoxConnection whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\TokBoxConnection whereDestroyReason($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\TokBoxConnection whereDestroyed($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\TokBoxConnection whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\TokBoxConnection whereTokBoxSessionId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\TokBoxConnection whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\TokBoxConnection whereValue($value)
 * @mixin \Eloquent
 * @property int $tok_box_token_id
 * @method static \Illuminate\Database\Eloquent\Builder|\App\TokBoxConnection whereTokBoxTokenId($value)
 * @property-read \App\TokBoxToken $token
 */
class TokBoxConnection extends Model
{
    protected $fillable = ['value', 'destroy_reason'];

    public function token()
    {
        return $this->belongsTo(TokBoxToken::class);
    }

    public function streams()
    {
        return $this->hasMany(TokBoxStream::class);
    }
}

<?php

namespace App;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

/**
 * App\TokBoxToken
 *
 * @property int $id
 * @property int $tok_box_session_id
 * @property string $value
 * @property string $data
 * @property string $role
 * @property \Carbon\Carbon $expires_at
 * @property \Carbon\Carbon|null $created_at
 * @property \Carbon\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\TokBoxConnection[] $connections
 * @property-read \App\TokBoxSession $session
 * @method static \Illuminate\Database\Eloquent\Builder|\App\TokBoxToken whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\TokBoxToken whereData($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\TokBoxToken whereExpiresAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\TokBoxToken whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\TokBoxToken whereRole($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\TokBoxToken whereTokBoxSessionId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\TokBoxToken whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\TokBoxToken whereValue($value)
 * @mixin \Eloquent
 */
class TokBoxToken extends Model
{
    protected $fillable = ['role', 'value', 'expires_at', 'data'];

    protected $dates = ['expires_at'];

    public function session()
    {
        return $this->belongsTo(TokBoxSession::class);
    }

    public function connections()
    {
        return $this->hasMany(TokBoxConnection::class);
    }
}

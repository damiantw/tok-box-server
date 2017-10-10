<?php

namespace App;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

/**
 * App\TokBoxToken
 *
 * @mixin \Eloquent
 * @property int $id
 * @property string $value
 * @property string $role
 * @property string $expires_at
 * @property \Carbon\Carbon|null $created_at
 * @property \Carbon\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\TokBoxToken whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\TokBoxToken whereExpiresAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\TokBoxToken whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\TokBoxToken whereRole($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\TokBoxToken whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\TokBoxToken whereValue($value)
 * @property int $tok_box_session_id
 * @property-read \App\TokBoxSession $session
 * @method static \Illuminate\Database\Eloquent\Builder|\App\TokBoxToken whereTokBoxSessionId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\TokBoxToken unexpired()
 */
class TokBoxToken extends Model
{
    protected $fillable = ['role', 'value', 'expires_at'];

    protected $dates = ['expires_at'];

    public function session()
    {
        return $this->belongsTo(TokBoxSession::class);
    }

    public function scopeUnexpired(Builder $query)
    {
        return $query->where('expires_at', '<=', Carbon::now());
    }
}

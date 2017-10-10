<?php

namespace App;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

/**
 * App\TokBoxSession.
 *
 * @mixin \Eloquent
 * @property int $id
 * @property string $tok_box_session_id
 * @property string $name
 * @property \Carbon\Carbon|null $created_at
 * @property \Carbon\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\TokBoxSession whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\TokBoxSession whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\TokBoxSession whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\TokBoxSession whereTokBoxSessionId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\TokBoxSession whereUpdatedAt($value)
 * @property string $value
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\TokBoxToken[] $tokens
 * @method static \Illuminate\Database\Eloquent\Builder|\App\TokBoxSession whereValue($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\TokBoxSession hasUnexpiredTokens()
 */
class TokBoxSession extends Model
{
    protected $fillable = ['value', 'name'];

    public function sessionId()
    {
        return $this->tok_box_session_id;
    }

    public function tokens()
    {
        return $this->hasMany(TokBoxToken::class);
    }

    public function scopeHasUnexpiredTokens(Builder $query)
    {
        return $query->whereHas('tokens', function($query) {
            $query->unexpired();
        });
    }
}

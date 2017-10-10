<?php

namespace App;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

/**
 * App\TokBoxSession
 *
 * @property int $id
 * @property string $value
 * @property string $name
 * @property \Carbon\Carbon|null $created_at
 * @property \Carbon\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\TokBoxToken[] $tokens
 * @method static \Illuminate\Database\Eloquent\Builder|\App\TokBoxSession whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\TokBoxSession whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\TokBoxSession whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\TokBoxSession whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\TokBoxSession whereValue($value)
 * @mixin \Eloquent
 */
class TokBoxSession extends Model
{
    protected $fillable = ['value', 'name'];

    public function sessionId()
    {
        return $this->value;
    }

    public function tokens()
    {
        return $this->hasMany(TokBoxToken::class);
    }
}

<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\TokBoxStream
 *
 * @property int $id
 * @property int $tok_box_connection_id
 * @property string|null $video_type
 * @property string $value
 * @property int $destroyed
 * @property string|null $destroy_reason
 * @property \Carbon\Carbon|null $created_at
 * @property \Carbon\Carbon|null $updated_at
 * @property-read \App\TokBoxConnection $connection
 * @method static \Illuminate\Database\Eloquent\Builder|\App\TokBoxStream whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\TokBoxStream whereDestroyReason($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\TokBoxStream whereDestroyed($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\TokBoxStream whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\TokBoxStream whereTokBoxConnectionId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\TokBoxStream whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\TokBoxStream whereValue($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\TokBoxStream whereVideoType($value)
 * @mixin \Eloquent
 */
class TokBoxStream extends Model
{
    protected $fillable = ['value', 'destroy_reason', 'video_type'];

    public function connection()
    {
        return $this->belongsTo(TokBoxConnection::class);
    }
}

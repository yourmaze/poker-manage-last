<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

/**
 * TempTournaments
 *
 * @mixin Eloquent
 */
class TempTournaments extends Model
{
    public $timestamps = false;

    protected $fillable =
        [
            'tournament_id',
            'next_up',
            'next_break',
            'stop_time',
        ];

    public function tournament(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo('App\Model\Tournament', 'tournament_id');
    }
}

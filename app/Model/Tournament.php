<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Tournament
 *
 * @mixin Eloquent
 */
class Tournament extends Model
{
    use HasFactory;

    protected $fillable =
        [
            'name',
            'level',
            'blind_time',
            'total_players',
            'rebuys',
            'addons',
            'total_price',
            'blinds_structure',
            'payments',
            'price',
            'addon_price',
            'bonus_stack',
            'usual_stack',
            'addon_stack',
            'company_id',
            'end_at'
        ];

    /**
     * Get the temp tournament associated with the tournament.
     */
    public function tempTournaments(): \Illuminate\Database\Eloquent\Relations\HasOne
    {
        return $this->hasOne(TempTournaments::class);
    }

    public function players(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(TournamentPlayer::class);
    }
}

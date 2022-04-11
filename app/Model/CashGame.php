<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

/**
 * Tournament
 *
 * @mixin Eloquent
 */
class CashGame extends Model
{
    protected $table = 'cash_game';

    protected $fillable =
        [
            'rake',
            'players_amount',
            'company_id',
            'stop_time'
        ];
}

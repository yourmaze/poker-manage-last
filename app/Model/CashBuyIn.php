<?php

namespace App\Model;

use Eloquent;
use Illuminate\Database\Eloquent\Model;

/**
 * Tournament
 *
 * @mixin Eloquent
 */
class CashBuyIn extends Model
{
    protected $table = 'cash_buy_ins';

    protected $casts = [
        'debtor' => 'boolean',
    ];

    protected $fillable =
        [
            'name',
            'amount',
            'game_id',
            'debtor'
        ];
}

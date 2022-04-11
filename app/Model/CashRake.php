<?php

namespace App\Model;

use Eloquent;
use Illuminate\Database\Eloquent\Model;

/**
 * Tournament
 *
 * @mixin Eloquent
 */
class CashRake extends Model
{
    protected $table = 'cash_rake';
    const UPDATED_AT = null;

    protected $fillable =
        [
            'game_id',
            'dealer_id',
            'salary',
            'rake',
            'tips'
        ];

    public function cashGame(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo('App\Model\CashGame', 'cash_game');
    }

    public function dealer(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo('App\Model\Dealer', 'dealer_id');
    }
}

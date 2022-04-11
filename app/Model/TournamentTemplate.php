<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

/**
 * Tournament
 *
 * @mixin Eloquent
 */
class TournamentTemplate extends Model
{
    public $timestamps = false;
    protected $table = 'tournament_template';

    protected $fillable =
        [
            'name',
            'blind_time',
            'blinds_structure',
            'price',
            'addon_price',
            'addon_price',
            'bonus_stack',
            'usual_stack',
        ];
}

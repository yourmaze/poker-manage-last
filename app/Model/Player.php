<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

/**
 * Tournament
 *
 * @mixin Eloquent
 */
class Player extends Model
{
    public $timestamps = false;
    protected $table = 'players';

    protected $fillable =
        [
            'name'
        ];
}

<?php

namespace App\Model;

use Eloquent;
use Illuminate\Database\Eloquent\Model;

/**
 * Tournament
 *
 * @mixin Eloquent
 */
class Company extends Model
{
    protected $table = 'company';
    public $timestamps = false;

    protected $fillable =
        [
            'tournament_rake_percent'
        ];
}

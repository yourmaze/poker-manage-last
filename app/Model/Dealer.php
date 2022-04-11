<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Tournament
 *
 * @mixin Eloquent
 */
class Dealer extends Model
{
    public $timestamps = false;
    protected $table = 'dealers';

    protected $fillable =
        [
            'name',
            'company_id',
            'user_id'
        ];
}

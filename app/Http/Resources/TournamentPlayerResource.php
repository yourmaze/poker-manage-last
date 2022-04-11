<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Date;

class TournamentPlayerResource extends JsonResource
{
    public static $wrap = 'players';

    /**
     * Transform the resource into an array.
     *
     * @param  Request  $request
     * @return array
     */
    public function toArray($request): array
    {
        if(empty($this->price)) {
            $this->price = $this->tournament->price;
        }
        return [
            'id'            => $this->id,
            'tournament_id' => $this->tournament_id,
            'name'          => $this->name,
            'type'          => $this->type,
            'amount'        => ($this->double_amount) ? $this->price*2 : $this->price,
            'double_amount' => $this->double_amount,
            'debtor'        => $this->debtor,
            'evaluate'      => $this->evaluate,
            'bonus_stack'   => $this->bonus_stack,
            'created_at'    => Date::parse($this->created_at)->format('H:i:s'),
        ];
    }
}

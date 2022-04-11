<?php

namespace App\Http\Resources;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Date;

class CashGameResource extends JsonResource
{
    public static $wrap = 'cash_game';

    /**
     * Transform the resource into an array.
     *
     * @param  Request  $request
     * @return array
     */
    public function toArray($request): array
    {
        return [
            'id'             => $this->id,
            'rake'           => $this->rake,
            'players_amount' => $this->players_amount,
            'company_id'     => $this->company_id,
            'created_at'     => $this->created_at,
            'stop_time'      => $this->stop_time,
            'gameSession'    => Carbon::parse($this->stop_time)->diffInHours($this->created_at)
        ];
    }
}

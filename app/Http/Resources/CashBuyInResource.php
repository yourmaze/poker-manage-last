<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Date;

class CashBuyInResource extends JsonResource
{
    public static $wrap = 'buyIns';

    /**
     * Transform the resource into an array.
     *
     * @param  Request  $request
     * @return array
     */
    public function toArray($request): array
    {
        return [
            'id' => $this->resource->id,
            'name' => $this->name,
            'amount' => $this->amount,
            'debtor' => $this->debtor,
            'created_at' => Date::parse($this->created_at)->format('H:i:s'),
        ];
    }
}

<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Date;

class CashRakeResource extends JsonResource
{
    public static $wrap = 'cash_rake';

    /**
     * Transform the resource into an array.
     *
     * @param  Request  $request
     * @return array
     */
    public function toArray($request): array
    {
        return [
            'id'         => $this->id,
            'name'       => $this->dealer->name,
            'salary'     => $this->salary,
            'rake'       => $this->rake,
            'tips'       => $this->tips,
            'created_at' => Date::parse($this->created_at)->format('H:i:s'),
        ];
    }
}

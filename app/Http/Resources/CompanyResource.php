<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Date;

class CompanyResource extends JsonResource
{
    public static $wrap = 'company';

    /**
     * Transform the resource into an array.
     *
     * @param  Request  $request
     * @return array
     */
    public function toArray($request): array
    {
        return [
            'id'                      => $this->id,
            'tournament_rake_percent' => $this->tournament_rake_percent,
        ];
    }
}

<?php

namespace App\Http\Resources;

use App\Repositories\UserRepository;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Date;

class LogResource extends JsonResource
{
    public static $wrap = 'logs';
    private array $eventText = [
        'updated' => 'Изменение',
        'created' => 'Добавление',
        'deleted' => 'Удаление',
    ];

    /**
     * Transform the resource into an array.
     *
     * @param  Request  $request
     * @return array
     */
    public function toArray($request): array
    {
        return [
            'id'            => $this->id,
            'event'         => $this->eventText[$this->event],
            'initialEvent'  => $this->event,
            'created_at'    => Date::parse($this->created_at)->format('H:i:s'),
            'name'          => $this->name,
            'user_role'     => $this->role,
            'description'   => $this->description
        ];
    }
}

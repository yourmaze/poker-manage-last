<?php

namespace Database\Factories\Model;

use App\Model\Tournament;
use Illuminate\Database\Eloquent\Factories\Factory;

class TournamentFactory extends Factory
{
    protected $model = Tournament::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition(): array
    {
        return [
            'name' => '',
            'blind_time' => 12,
            'total_players' => 1,
            'total_price' => 1000,
            'company_id' => 1,
            'price' => 400,
            'addon_price' => 400
        ];
    }
}

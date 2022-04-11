<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Facades\CauserResolver;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Models\Activity;
use Spatie\Activitylog\Traits\LogsActivity;

class TournamentPlayer extends Model
{
    use LogsActivity;

    protected $table = 'tournament_players';

    protected $fillable =
        [
            'tournament_id',
            'name',
            'type',
            'double_amount',
            'debtor',
            'buy_time',
            'evaluate',
            'bonus_stack'
        ];

    public function tournament(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo('App\Model\Tournament', 'tournament_id');
    }

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults();
    }

    public function tapActivity(Activity $activity, string $eventName)
    {
        $description = '';
        $typeText = [1 => 'нового игрока: ', 2 => 'ребай: ', 3 => 'аддон: '];
        $playerName = empty($activity->subject->name) ? "-" : $activity->subject->name;
        $doubleText = ($activity->subject->double_amount == 1) ? "двойной" : "одинарный";
        $bonusStackText = ($activity->subject->bonus_stack == 1) ? "да" : "нет";
        $debtorText = ($activity->subject->debtor == 1) ? " / Будет оплачен позднее" : "";

        if($eventName == 'created') {
            $description = 'Добавил '
                . $typeText[$activity->subject->type] . " Имя: <b>" . $playerName . "</b> / Бай-ин: <b>" . $doubleText . "</b> / Бонус: <b>" . $bonusStackText . "</b>" . $debtorText;
        }

        if ($eventName == 'deleted') {
            $description = 'Удалил ' . $typeText[$activity->subject->type] . " Имя: " . $playerName . " / Бай-ин: " . $doubleText . $debtorText;
        }

        if ($eventName == 'updated') {
            if(array_key_exists("evaluate", $this->changes)) {
                if($this->changes["evaluate"]) {
                    $description = 'Вывел игрока <b>' . $playerName . "</b> из турнира";
                } else {
                    $description = 'Вернул игрока: <b>' . $playerName . "</b> в турнир";
                }
            }
        }
        $activity->description = $description;
        $activity->properties = ['tournament_id' => (int)$activity->subject->tournament_id];
    }
}

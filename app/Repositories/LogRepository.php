<?php

namespace App\Repositories;

use App\Model\Company;
use App\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class LogRepository
{
    public function getByTournamentId(int $id): \Illuminate\Support\Collection
    {
        return DB::table('activity_log')
            ->leftJoin('users', 'activity_log.causer_id', '=', 'users.id')
            ->leftJoin('users_roles', 'users.id', '=', 'users_roles.user_id')
            ->leftJoin('roles', 'roles.id', '=', 'users_roles.role_id')
            ->whereJsonContains('properties', ['tournament_id' => $id])
            ->select('activity_log.id', 'activity_log.log_name', 'activity_log.description', 'activity_log.event', 'activity_log.properties', 'activity_log.created_at', 'users.name', 'roles.name as role')
            ->orderBy('activity_log.created_at', 'ASC')
            ->get();
    }
}

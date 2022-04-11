<?php

namespace App\Repositories;

use App\Model\Company;

class CompanyRepository
{
    public function get($id)
    {
        return Company::where('id', $id)->first();
    }

    public function getTournamentRake($id)
    {
        return Company::select('tournament_rake_percent')->where('id', $id)->first();
    }

    public function all(): \Illuminate\Support\Collection
    {
        return Company::orderBy('created_at', 'DESC')->get();
    }

    public function destroy($id)
    {
        return Company::where('id', $id)->delete();
    }

    public function create($data)
    {
        return Company::create($data);
    }

    public function update($id, array $data): bool
    {
        return Company::find($id)->update($data);
    }
}

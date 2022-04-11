<?php

namespace App\Repositories;

use App\Model\CashBuyIn;
use App\Model\CashRake;
use App\Model\Dealer;
use App\Repositories\Interfaces\CashBuyInRepositoryInterface;
use App\Repositories\Interfaces\DealerRepositoryInterface;
use App\User;
use Illuminate\Support\Facades\DB;

class DealerRepository implements DealerRepositoryInterface
{
    public function get($id)
    {
        return Dealer::find($id);
    }

    public function getByCompany(int $companyId)
    {
        return Dealer::where('company_id', $companyId)->get();
    }

    public function getByCompanyWithStats(int $companyId): \Illuminate\Support\Collection
    {
        return DB::table('dealers')
            ->where('dealers.company_id', $companyId)
            ->leftJoin('cash_rake', 'cash_rake.dealer_id', '=', 'dealers.id')
            ->select('dealers.*')
            ->selectSub(function($query) {
                return $query->selectRaw('SUM(cash_rake.rake)');
            }, 'total_rake')
            ->selectSub(function($query) {
                return $query->selectRaw('SUM(cash_rake.salary)');
            }, 'total_salary')
            ->selectSub(function($query) {
                return $query->selectRaw('SUM(cash_rake.tips)');
            }, 'total_tips')
            ->groupBy('dealers.id')
            ->get();
    }

    public function getStats(int $dealerId): \Illuminate\Support\Collection
    {
        return DB::table('dealers')
            ->where('dealers.id', $dealerId)
            ->join('cash_rake', 'cash_rake.dealer_id', '=', 'dealers.id')
            ->selectSub(function($query) {
                return $query->selectRaw('SUM(cash_rake.rake)');
            }, 'total_rake')
            ->selectSub(function($query) {
                return $query->selectRaw('SUM(cash_rake.salary)');
            }, 'total_salary')
            ->selectSub(function($query) {
                return $query->selectRaw('SUM(cash_rake.tips)');
            }, 'total_tips')
            ->groupBy('dealers.id')
            ->get();
    }

    public function all(): \Illuminate\Support\Collection
    {
        return Dealer::orderBy('name', 'ASC')->get();
    }

    public function destroy($id)
    {
        return Dealer::where('id', $id)->delete();
    }

    public function create($data)
    {
        return Dealer::create($data);
    }

    public function update($id, array $data): bool
    {
        return Dealer::find($id)->update($data);
    }
}

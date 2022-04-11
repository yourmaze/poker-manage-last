<?php


namespace App\Http\Services;

use App\Repositories\Interfaces\DealerRepositoryInterface;

class DealerService
{
    private $dealerRepository;

    public function __construct(DealerRepositoryInterface $dealerRepository)
    {
        $this->dealerRepository = $dealerRepository;
    }

    public function getDealerStats($dealerId) {
        return $this->dealerRepository->getStats($dealerId);
    }

}

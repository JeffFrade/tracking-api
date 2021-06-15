<?php

namespace App\Repositories;

use App\Core\Support\AbstractRepository;
use App\Repositories\Models\PackageStatus;

class PackageStatusRepository extends AbstractRepository
{
    /**
     * @return PackageStatus
     */
    public function getModel()
    {
        return $this->model ?? $this->createDefaultModel();
    }

    /**
     * @return PackageStatus
     */
    private function createDefaultModel()
    {
        return new PackageStatus();
    }
}

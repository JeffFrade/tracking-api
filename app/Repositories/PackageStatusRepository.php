<?php

namespace App\Repositories;

use App\Core\Support\AbstractRepository;
use App\Repositories\Models\PackageStatus;

class PackageStatusRepository extends AbstractRepository
{
    public function getModel()
    {
        return $this->model ?? $this->createDefaultModel();
    }

    private function createDefaultModel()
    {
        $this->model = new PackageStatus();
    }
}

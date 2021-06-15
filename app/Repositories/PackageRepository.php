<?php

namespace App\Repositories;

use App\Core\Support\AbstractRepository;
use App\Repositories\Models\Package;

class PackageRepository extends AbstractRepository
{
    public function getModel()
    {
        return $this->model ?? $this->createDefaultModel();
    }

    private function createDefaultModel()
    {
        $this->model = new Package();
    }
}

<?php

namespace App\Repositories;

use App\Core\Support\AbstractRepository;
use App\Repositories\Models\Package;

class PackageRepository extends AbstractRepository
{
    /**
     * @return Package
     */
    public function getModel()
    {
        return $this->model ?? $this->createDefaultModel();
    }

    /**
     * @return Package
     */
    private function createDefaultModel()
    {
        return new Package();
    }
}

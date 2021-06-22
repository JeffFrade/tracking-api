<?php

namespace App\Repositories;

use App\Core\Support\AbstractRepository;
use App\Repositories\Models\Status;

class StatusRepository extends AbstractRepository
{
    /**
     * @return Status
     */
    public function getModel()
    {
        return $this->model ?? $this->createDefaultModel();
    }

    /**
     * @return Status
     */
    private function createDefaultModel()
    {
        return new Status();
    }

    public function index(string $status)
    {
        return $this->getModel()
            ->where('status', 'like', '%' . $status . '%')
            ->get();
    }
}

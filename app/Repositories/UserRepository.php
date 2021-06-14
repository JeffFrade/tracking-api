<?php

namespace App\Repositories;

use App\Core\Support\AbstractRepository;
use App\Repositories\Models\User;

class UserRepository extends AbstractRepository
{
    public function getModel()
    {
        return $this->model ?? $this->createDefaultModel();
    }

    private function createDefaultModel()
    {
        $this->model = new User();
    }
}

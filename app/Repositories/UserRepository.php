<?php

namespace App\Repositories;

use App\Core\Support\AbstractRepository;
use App\Repositories\Models\User;

class UserRepository extends AbstractRepository
{
    /**
     * @return User
     */
    public function getModel()
    {
        return $this->model ?? $this->createDefaultModel();
    }

    /**
     * @return User
     */
    private function createDefaultModel()
    {
        return new User();
    }
}

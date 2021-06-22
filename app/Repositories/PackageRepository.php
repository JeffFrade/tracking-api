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

    /**
     * @param string $name
     * @return \Illuminate\Database\Eloquent\Builder[]|\Illuminate\Database\Eloquent\Collection
     */
    public function index(string $name = '')
    {
        return $this->getModel()
            ->with('status')
            ->where('name', 'like', '%' . $name . '%')
            ->get();
    }

    /**
     * @param int $id
     * @return \Illuminate\Database\Eloquent\Builder|\Illuminate\Database\Eloquent\Model|object|null
     */
    public function show(int $id)
    {
        return $this->getModel()
            ->with('status')
            ->where('id', $id)
            ->first();
    }
}

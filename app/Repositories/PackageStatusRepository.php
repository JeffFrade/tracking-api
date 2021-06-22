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

    /**
     * @param int $idPackage
     * @param int $idStatus
     * @param string $locale
     * @return mixed
     */
    public function index(int $idPackage = 0, int $idStatus = 0, string $locale = '')
    {
        $model = $this->model
            ->where('locale', 'like', '%' . $locale . '%');

        if (!empty($idPackage)) {
            $model = $model->where('id_package', $idPackage);
        }

        if (!empty($idStatus)) {
            $model = $model->where('id_status', $idStatus);
        }

        return $model->get();
    }
}

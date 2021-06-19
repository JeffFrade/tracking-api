<?php

namespace App\Services;

use App\Exceptions\PackageStatusDeleteException;
use App\Repositories\PackageStatusRepository;

class PackageStatus
{
    /**
     * @var PackageStatusRepository
     */
    private $packageStatusRepository;

    /**
     * @return PackageStatusRepository
     */
    public function getPackageStatusRepository()
    {
        return $this->packageStatusRepository ?? $this->createDefaultPackageStatusRepository();
    }

    /**
     * @param PackageStatusRepository $packageStatusRepository
     */
    public function setPackageStatusRepository(PackageStatusRepository $packageStatusRepository)
    {
        $this->packageStatusRepository = $packageStatusRepository;
    }

    /**
     * @return PackageStatusRepository
     */
    private function createDefaultPackageStatusRepository()
    {
        return new PackageStatusRepository();
    }

    /**
     * @param int $id
     * @throws PackageStatusDeleteException
     */
    public function deleteByIdPackage(int $id)
    {
        $status = $this->getPackageStatusRepository()->customDelete('id_package', $id);

        if ($status === false) {
            throw new PackageStatusDeleteException();
        }
    }
}

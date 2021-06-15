<?php

namespace App\Services;

use App\Repositories\PackageRepository;

class Package
{
    /**
     * @var PackageRepository
     */
    private $packageRepository;

    /**
     * @return PackageRepository
     */
    public function getPackageRepository()
    {
        return $this->packageRepository ?? $this->createDefaultPackageRepository();
    }

    /**
     * @param PackageRepository $packageRepository
     */
    public function setPackageRepository(PackageRepository $packageRepository)
    {
        $this->packageRepository = $packageRepository;
    }

    /**
     * @return PackageRepository
     */
    private function createDefaultPackageRepository()
    {
        return new PackageRepository();
    }
}

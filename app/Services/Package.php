<?php

namespace App\Services;

use App\Exceptions\PackageNotFoundException;
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

    /**
     * @param array $params
     * @return mixed
     * @throws PackageNotFoundException
     */
    public function index(array $params)
    {
        $packages = $this->getPackageRepository()
            ->index($params['name'] ?? '');

        if (count($packages) <= 0) {
            throw new PackageNotFoundException('Não há pacotes com os filtros desejados');
        }

        return $packages;
    }
}

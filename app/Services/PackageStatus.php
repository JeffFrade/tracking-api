<?php

namespace App\Services;

use App\Exceptions\PackageStatusDeleteException;
use App\Exceptions\PackageStatusNotFoundException;
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
     * @param array $params
     * @return mixed
     * @throws PackageStatusNotFoundException
     */
    public function index(array $params)
    {
        $packageStatus = $this->getPackageStatusRepository()
            ->index($params['id_package'] ?? 0, $params['id_status'] ?? 0, $params['locale'] ?? '');

        if (count($packageStatus) <= 0) {
            throw new PackageStatusNotFoundException('Não há status com os filtros desejados');
        }

        return $packageStatus;
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

<?php

namespace App\Services;

use App\Exceptions\PackageDeleteException;
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
     * @throws PackageStatusNotFoundException
     */
    public function exists(int $id)
    {
        $packageStatus = $this->getPackageStatusRepository()
            ->findFirst('id', $id);

        if (empty($packageStatus)) {
            throw new PackageStatusNotFoundException('Status do pacote inexistente');
        }
    }

    /**
     * @param int $id
     * @throws PackageDeleteException
     * @throws PackageStatusNotFoundException
     */
    public function delete(int $id)
    {
        $this->exists($id);

        $packageStatus = $this->getPackageStatusRepository()
            ->delete($id);

        if ($packageStatus === false) {
            throw new PackageDeleteException(sprintf('Erro ao deletar o status do pacote de ID %s', $id));
        }
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

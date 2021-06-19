<?php

namespace App\Services;

use App\Exceptions\StatusNotFoundException;
use App\Exceptions\StatusStoreException;
use App\Repositories\StatusRepository;

class Status
{
    /**
     * @var StatusRepository
     */
    private $statusRepository;

    /**
     * @var PackageStatus
     */
    private $packageStatus;

    /**
     * @return StatusRepository
     */
    public function getStatusRepository()
    {
        return $this->statusRepository ?? $this->createDefaultStatusRepository();
    }

    /**
     * @param StatusRepository $statusRepository
     */
    public function setStatusRepository(StatusRepository $statusRepository)
    {
        $this->statusRepository = $statusRepository;
    }

    /**
     * @return StatusRepository
     */
    private function createDefaultStatusRepository()
    {
        return new StatusRepository();
    }

    /**
     * @return PackageStatus
     */
    public function getPackageStatus()
    {
        return $this->packageStatus ?? $this->createDefaultPackageStatus();
    }

    /**
     * @param PackageStatus $packageStatus
     */
    public function setPackageStatus(PackageStatus $packageStatus)
    {
        $this->packageStatus = $packageStatus;
    }

    /**
     * @return PackageStatus
     */
    private function createDefaultPackageStatus()
    {
        return new PackageStatus();
    }

    /**
     * @param array $params
     * @return mixed
     * @throws StatusNotFoundException
     */
    public function index(array $params)
    {
        $status = $this->getStatusRepository()
            ->index($params['status'] ?? '');

        if (count($status) <= 0) {
            throw new StatusNotFoundException('Não há status com os filtros desejados');
        }

        return $status;
    }

    /**
     * @param array $params
     * @return mixed
     * @throws StatusStoreException
     */
    public function store(array $params)
    {
        $status = $this->getStatusRepository()
            ->create($params);

        if ($status === false) {
            throw new StatusStoreException('Erro ao cadastrar o status');
        }

        return $status;
    }
}

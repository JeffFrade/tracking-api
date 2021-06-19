<?php

namespace App\Services;

use App\Exceptions\PackageStatusDeleteException;
use App\Exceptions\StatusDeleteException;
use App\Exceptions\StatusNotFoundException;
use App\Exceptions\StatusStoreException;
use App\Exceptions\StatusUpdateException;
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

    /**
     * @param int $id
     * @return mixed
     * @throws StatusNotFoundException
     */
    public function show(int $id)
    {
        $status = $this->getStatusRepository()
            ->findFirst('id', $id);

        if (empty($status)) {
            throw new StatusNotFoundException('Status inexistente');
        }

        return $status;
    }

    /**
     * @param int $id
     * @param array $data
     * @return mixed
     * @throws StatusNotFoundException
     * @throws StatusUpdateException
     */
    public function update(int $id, array $data)
    {
        $this->show($id);

        $status = $this->getStatusRepository()
            ->update($data, $id);

        if ($status === false) {
            throw new StatusUpdateException('Erro ao atualizar os dados do status de ID %s', $id);
        }

        return $this->show($id);
    }

    /**
     * @param int $id
     * @throws StatusDeleteException
     * @throws StatusNotFoundException
     * @throws PackageStatusDeleteException
     */
    public function delete(int $id)
    {
        $this->show($id);

        $this->getPackageStatus()->deleteByIdPackage($id);
        $package = $this->getStatusRepository()->delete($id);

        if ($package === false) {
            throw new StatusDeleteException(sprintf('Erro ao deletar o status de ID %s', $id));
        }
    }
}

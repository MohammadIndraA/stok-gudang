<?php

namespace App\Services;

use App\Repositories\StokTransactionRepository;

class StokTransactionService
{
    protected StokTransactionRepository $repository;

    public function __construct(StokTransactionRepository $repository)
    {
        $this->repository = $repository;
    }

    public function getMasuk()
    {
        return $this->repository->masuk();
    }

    public function getKeluar()
    {
        return $this->repository->keluar();
    }

    public function find(string $id)
    {
        return $this->repository->find($id);
    }

}

?>

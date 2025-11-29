<?php

// app/Services/PostService.php
namespace App\Services;

use App\Repositories\MaterialRepository;
use App\Repositories\PermintaanMaterialRepository;
use App\Repositories\VendorRepository;

class PermintaanMaterialService
{
    protected PermintaanMaterialRepository $repository;

    public function __construct(PermintaanMaterialRepository $repository)
    {
        $this->repository = $repository;
    }

    public function getAll()
    {
        return $this->repository->all();
    }

    public function getKapling()
    {
        return $this->repository->getKapling();
    }

    public function getAplikator()
    {
        return $this->repository->getAplikator();
    }
    public function geMaterial()
    {
        return $this->repository->getMaterial();
    }

    public function find(string $id)
    {
        return $this->repository->find($id);
    }

    public function create(array $data)
    {

        return $this->repository->create($data);
    }

    public function update(string $id, array $data)
    {
        $category = $this->repository->find($id);

        return $this->repository->update($category, $data);
    }

    public function delete(string $id)
    {
        $category = $this->repository->find($id);
        return $this->repository->delete($category);
    }
}

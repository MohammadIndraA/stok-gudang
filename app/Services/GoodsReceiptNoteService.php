<?php

namespace App\Services;

use App\Repositories\GoodsReceiptNoteRepository;

class GoodsReceiptNoteService
{
    protected GoodsReceiptNoteRepository $repository;

    public function __construct(GoodsReceiptNoteRepository $repository)
    {
        $this->repository = $repository;
    }

    public function getAll()
    {
        return $this->repository->all();
    }

    public function getPO()
    {
        return $this->repository->getPO();
    }

     public function getMaterial()
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

?>

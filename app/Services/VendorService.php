<?php 

// app/Services/PostService.php
namespace App\Services;

use App\Repositories\VendorRepository;

class VendorService
{
    protected VendorRepository $repository;

    public function __construct(VendorRepository $repository)
    {
        $this->repository = $repository;
    }

    public function getAll()
    {
        return $this->repository->all();
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

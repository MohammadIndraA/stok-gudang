<?php 

// app/Services/PostService.php
namespace App\Services;

use App\Repositories\PurchaseOrderItemRepository;

class PurchaseOrderItemService
{
    protected PurchaseOrderItemRepository $repository;

    public function __construct(PurchaseOrderItemRepository $repository)
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

}

?>

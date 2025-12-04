<?php

// app/Services/PostService.php
namespace App\Services;

use App\Repositories\ProjectRepository;
use App\Repositories\ProjectStagesRepository;

class ProjectStagesService
{
    protected ProjectStagesRepository $repository;

    public function __construct(ProjectStagesRepository $repository)
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

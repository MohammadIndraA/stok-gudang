<?php 

namespace App\Services;

use App\Actions\Role\CreateRoleAction;
use App\Actions\Role\UpdateRoleAction;
use App\DTO\Role\RoleData;
use App\Models\Role;
use App\Repositories\RoleRepository;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;

class RoleService
{
    private $roleRepository;

    public function __construct(RoleRepository $roleRepository)
    {
        $this->roleRepository = $roleRepository;
    }

    public function getAllRole(): Builder
    {
        return $this->roleRepository->all();
    }

    public function findById($id): Role
    {
        return $this->roleRepository->findById($id);
    }

    public function create(array $data): Role
    {
        return $this->roleRepository->create($data);
    }

    public function update(string $id, array $data)
    {
       return  $this->roleRepository->update($id, $data);
    }

    public function delete($id): bool
    {
        return $this->roleRepository->delete($id);
    }

    public function getAllPermission(): Collection
    {
        return $this->roleRepository->getAllPermision();
    }

    public function findPermissionById($id): Collection
    {
        return $this->roleRepository->findPermissionById($id);
    }
}

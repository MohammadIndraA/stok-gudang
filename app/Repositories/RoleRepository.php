<?php 

namespace App\Repositories;

use App\Models\Permission;
use App\Models\Role;
use App\Repositories\Interface\RoleRepositoryInterface;
use Illuminate\Support\Collection;
use Illuminate\Database\Eloquent\Builder;

class RoleRepository
{
    public function all(): Builder
    {
        return Role::latest();
    }

    public function getAllPermision(): Collection
    {
        return Permission::all();
    }

    public function findPermissionById(String $uuid): Collection
    {
        return Permission::join("role_has_permissions","role_has_permissions.permission_id","=","permissions.uuid")
            ->where("role_has_permissions.role_id",$uuid)
            ->get();
    }

    public function create(array $data): Role
    {
        $role =  Role::create([
            'name' => $data['name'],
        ]);
        $role->syncPermissions($data['permissions']);
        return $role;
    }

    public function update(String $uuid, array $data): Role
    {
        $role = Role::find($uuid);
        $role->update([
            'name' => $data['name'],
        ]);
        return $role->syncPermissions($data['permissions']);
    }

    public function findById(String $uuid): Role
    {
        return Role::where('uuid', $uuid)->firstOrFail();
    }

    public function delete(String $uuid): bool
    {
        return Role::where('uuid', $uuid)->delete();
    }
}

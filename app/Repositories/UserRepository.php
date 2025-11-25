<?php 

namespace App\Repositories;

use App\Models\Role;
use App\Models\User;
use App\Repositories\Interface\UserRepositoryInterface;
use Illuminate\Support\Collection;
use Illuminate\Database\Eloquent\Builder;

class UserRepository
{
    public function all(): Builder
    {
        return User::with('roles')->select('users.*');
    }

    public function findById(string $id): ?User
    {
        return User::with('roles')->find($id);
    }

    public function create(array $data): User
    {
        return User::create($data);
    }

    public function update(String $id, array $data): bool
    {
        return User::where('id', $id)->update($data);
    }

    public function delete(String $id): bool
    {
        $user = User::find($id);
         if (!$user) {
            return false;
        }
        $user->syncRoles([]);
        return $user->delete();
    }

    public function getAllRole(): Collection
    {
        return Role::pluck('name');
    }
}

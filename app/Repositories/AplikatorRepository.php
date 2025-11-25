<?php 

namespace App\Repositories;

use App\Models\Aplikator;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Hash;

class AplikatorRepository
{
    public function all(): Builder
    {
       return Aplikator::query();
    }

    public function findById(string $id): ?Aplikator
    {
        return Aplikator::find($id);
    }

    public function create(array $data): Aplikator
    {
        return Aplikator::create($data);
    }

    public function update(string $id, array $data): bool
    {
        $ap = Aplikator::find($id);
        if (!$ap) {
            return false;
        }

        return $ap->update($data);
    }

    public function delete(String $id): bool
    {
        $user = Aplikator::find($id);
        return $user->delete();
    }

}

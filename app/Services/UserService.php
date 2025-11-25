<?php

namespace App\Services;

use App\Models\User;
use App\Repositories\UserRepository;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Hash;

class UserService {

     protected $userRepository;
    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function getAllUser(): Builder
    {
        return $this->userRepository->all();
    }
    public function createUser(array $data)
    {
        return $this->userRepository->create($data);
    }

    public function findById(String $id): ?User
    {
        return $this->userRepository->findById($id);
    }

    public function update(string $id, array $data)
    {
         if (empty($data['password'])) {
            unset($data['password']);
        } else {
            $data['password'] = Hash::make($data['password']);
        }
        
       return $this->userRepository->update($id, $data);
    }

    public function delete($id): bool
    {   
        return $this->userRepository->delete($id);
    }

    public function getAllRole()
    {
        return $this->userRepository->getAllRole();
    }

}

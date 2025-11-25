<?php

namespace App\Services;

use App\Models\Aplikator;
use App\Repositories\AplikatorRepository;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Hash;

class AplikatorService {

     protected $aplikatorRepository;
    public function __construct(AplikatorRepository $aplikatorRepository)
    {
        $this->aplikatorRepository = $aplikatorRepository;
    }

    public function getAllAplikator(): Builder
    {
        return $this->aplikatorRepository->all();
    }
    public function createAplikator(array $data)
    {
        return $this->aplikatorRepository->create($data);
    }

    public function findById(String $id): ?Aplikator
    {
        return $this->aplikatorRepository->findById($id);
    }

   public function update(string $id, array $data): bool
    {
        // kalau password kosong/null, jangan ikut diupdate
        if (empty($data['password'])) {
            unset($data['password']);
        } else {
            $data['password'] = Hash::make($data['password']);
        }

        return $this->aplikatorRepository->update($id, $data);
    }


    public function delete($id): bool
    {   
        return $this->aplikatorRepository->delete($id);
    }

}

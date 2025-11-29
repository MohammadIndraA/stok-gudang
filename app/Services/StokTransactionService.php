<?php

namespace App\Services;

use App\Models\StokTransaction;
use App\Repositories\StokTransactionRepository;

class StokTransactionService
{
    protected StokTransactionRepository $repository;

    public function __construct(StokTransactionRepository $repository)
    {
        $this->repository = $repository;
    }

    public function query($filters = [], $jenis = null)
    {
        $query = StokTransaction::with(['material']);

        // filter jenis transaksi (masuk/keluar)
        if (!empty($jenis)) {
            $query->where('jenis_transaksi', $jenis);
        }

        if (!empty($filters['tanggal_mulai']) && !empty($filters['tanggal_akhir'])) {
            $query->whereBetween('created_at', [
                $filters['tanggal_mulai'] . ' 00:00:00',
                $filters['tanggal_akhir'] . ' 23:59:59'
            ]);
        }

        $query->where('jumlah', '>', 0);

        return $query;
    }

    public function masuk($filters = [])
    {
        return $this->query($filters, 'masuk');
    }

    public function keluar($filters = [])
    {
        return $this->query($filters, 'keluar');
    }

    public function getVendor()
    {
        return $this->repository->getVendor();
    }

    public function find(string $id)
    {
        return $this->repository->find($id);
    }
}

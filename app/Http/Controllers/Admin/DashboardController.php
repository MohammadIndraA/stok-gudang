<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\DahsboardService;
use Illuminate\Http\Request;

class dashboardController extends Controller
{

    protected $service;

    public function __construct(DahsboardService $service)
    {
        $this->service = $service;
    }

    public function index()
    {

        $minStok = $this->service->getMinStokMaterial();
        return view('admin.dashboard.index', compact('minStok'));
    }
}

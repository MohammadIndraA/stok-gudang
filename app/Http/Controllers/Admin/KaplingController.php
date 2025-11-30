<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\ResponseJson;
use App\Http\Controllers\Controller;
use App\Http\Requests\KaplingRequest;
use App\Services\KaplingService;
use Illuminate\Http\Request;
use Illuminate\Routing\Controllers\Middleware;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Log;

class KaplingController extends Controller
{
    protected $service;

    public function __construct(KaplingService $service)
    {
        $this->service = $service;
    }

    public static function middleware()
    {
        return [
            new Middleware('permission:view-aplikator', ['only' => ['index', 'show']]),
            new Middleware('permission:create-aplikator', ['only' => ['create', 'store']]),
            new Middleware('permission:edit-aplikator', ['only' => ['edit', 'update']]),
            new Middleware('permission:delete-aplikator', ['only' => ['destroy']]),
        ];
    }

    public function index(Request $request)
    {
        // $this->authorize('viewAny', User::class);
        if ($request->ajax()) {
            $kaplings = $this->service->getAll();
            return DataTables::of($kaplings)
                ->addIndexColumn()
                ->editColumn('blok_id', function ($row) {
                    return $row->blok->nama;
                })
                ->addColumn('action', function ($row) {
                    return view('components.button-action', [
                        'id' => $row->id,
                        'routeEdit' => 'admin.kapling.edit',
                        'routeDelete' => 'admin.kapling.destroy',
                        'dataTable' => 'kaplingTable',
                        'model' => $row
                    ])->render();
                })
                ->rawColumns(['action', 'blok_id'])
                ->make(true);
        }
        return view('admin.kapling.index');
    }

    public function create()
    {
        $bloks = $this->service->getBlok();

        return view('admin.kapling.form', compact('bloks'));
    }
    public function store(KaplingRequest $request)
    {
        try {
            // $this->authorize('create', User::class);
            $data = $request->validated();
            $this->service->create($data);
            return redirect()->route('admin.kapling.index');
        } catch (\Throwable $th) {
            Log::error($th->getMessage());
            return ResponseJson::error($th->getMessage(), 500);
        }
    }

    public function show(Request $request)
    {
        // $this->authorize('view', User::class);
        $id = $request->id;
        $kapling = $this->service->find($id);
        if (!$kapling) {
            return ResponseJson::error('Kapling tidak ditemukan', 404);
        }
        return ResponseJson::success($kapling, 'Kapling found successfully');
    }

    public function edit($id)
    {
        $kaplings = $this->service->find($id);
        if (!$kaplings) {
            return ResponseJson::error('Kapling tidak ditemukan', 404);
        }
        $bloks = $this->service->getBlok();
        return view('admin.kapling.form', compact('kaplings', 'bloks'));
    }

    public function update(KaplingRequest $request, string $id)
    {
        try {
            $data = $request->validated();
            $kapling = $this->service->find($id);

            if (!$kapling) {
                return ResponseJson::error('kapling tidak ditemukan', 404);
            }

            $this->service->update($id, $data);

            return redirect()->route('admin.kapling.index')
                ->with('success', 'Data berhasil diperbarui');
        } catch (\Throwable $th) {
            Log::error($th->getMessage());
            return ResponseJson::error($th->getMessage(), 500);
        }
    }

    public function destroy($id)
    {
        try {
            $deleted = $this->service->delete($id);
            if (!$deleted) {
                return ResponseJson::error('kapling tidak ditemukan atau gagal dihapus', 404);
            }
            return ResponseJson::success($deleted, 'kapling deleted successfully');
        } catch (\Throwable $th) {
            Log::error($th->getMessage());
            return ResponseJson::error($th->getMessage(), 500);
        }
    }
}

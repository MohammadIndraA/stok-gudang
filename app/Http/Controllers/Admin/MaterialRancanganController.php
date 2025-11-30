<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\ResponseJson;
use App\Http\Controllers\Controller;
use App\Http\Requests\MaterialRancanganRequest;
use App\Services\MaterialRancanganService;
use Illuminate\Http\Request;
use Illuminate\Routing\Controllers\Middleware;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Log;


class MaterialRancanganController extends Controller
{
    protected $service;

    public function __construct(MaterialRancanganService $service)
    {
        $this->service = $service;
    }

    public static function middleware()
    {
        return [
            new Middleware('permission:view-material-rancangan', ['only' => ['index', 'show']]),
            new Middleware('permission:create-material-rancangan', ['only' => ['create', 'store']]),
            new Middleware('permission:edit-material-rancangan', ['only' => ['edit', 'update']]),
            new Middleware('permission:delete-material-rancangan', ['only' => ['destroy']]),
        ];
    }

    public function index(Request $request)
    {
        // $this->authorize('viewAny', User::class);
        if ($request->ajax()) {
            $materials = $this->service->getAll();
            return DataTables::of($materials)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    return view('components.button-action', [
                        'id' => $row->id,
                        'routeEdit' => 'admin.material-rancangan.edit',
                        'routeDelete' => 'admin.material-rancangan.destroy',
                        'dataTable' => 'bomTable',
                        'model' => $row
                    ])->render();
                })
                ->rawColumns(['action'])
                ->make(true);
        }
        return view('admin.material-rancangan.index');
    }

    public function create()
    {
        return view('admin.material-rancangan.form');
    }
    public function store(MaterialRancanganRequest $request)
    {
        try {
            // $this->authorize('create', User::class);
            $data = $request->validated();
            $this->service->create($data);
            return redirect()->route('admin.material-rancangan.index');
        } catch (\Throwable $th) {
            Log::error($th->getMessage());
            return ResponseJson::error($th->getMessage(), 500);
        }
    }

    public function show(Request $request)
    {
        // $this->authorize('view', User::class);
        $id = $request->id;
        $material = $this->service->find($id);
        if (!$material) {
            return ResponseJson::error('Material tidak ditemukan', 404);
        }
        return ResponseJson::success($material, 'Material found successfully');
    }

    public function edit($id)
    {
        $bom = $this->service->find($id);
        if (!$bom) {
            return ResponseJson::error('Material tidak ditemukan', 404);
        }
        return view('admin.material-rancangan.form', compact('bom'));
    }

    public function update(MaterialRancanganRequest $request, string $id)
    {
        try {
            $data = $request->validated();
            $material = $this->service->find($id);

            if (!$material) {
                return ResponseJson::error('Material tidak ditemukan', 404);
            }

            $this->service->update($id, $data);

            return redirect()->route('admin.material-rancangan.index')
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
                return ResponseJson::error('Material tidak ditemukan atau gagal dihapus', 404);
            }
            return ResponseJson::success($deleted, 'Material deleted successfully');
        } catch (\Throwable $th) {
            Log::error($th->getMessage());
            return ResponseJson::error($th->getMessage(), 500);
        }
    }
}

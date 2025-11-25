<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\ResponseJson;
use App\Http\Controllers\Controller;
use App\Http\Requests\MaterialRequest;
use App\Services\MaterialService;
use Illuminate\Http\Request;
use Illuminate\Routing\Controllers\Middleware;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Log;

class MaterialController extends Controller
{
      protected $service;

    public function __construct(MaterialService $service)
    {
        $this->service = $service;
    }

     public static function middleware()
    {
        return [
             new Middleware('permission:view-aplikator', ['only' => ['index','show']]),
             new Middleware('permission:create-aplikator', ['only' => ['create','store']]),
             new Middleware('permission:edit-aplikator', ['only' => ['edit','update']]),
             new Middleware('permission:delete-aplikator', ['only' => ['destroy']]),
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
                    'routeEdit' => 'admin.material.edit',
                    'routeDelete' => 'admin.material.destroy',
                    'dataTable' => 'materialTable',
                    'model' => $row
                ])->render();
            })
           ->rawColumns(['action'])
            ->make(true);
        }
        return view('admin.material.index');
    }

    public function create()
    {
        return view('admin.material.form');
    }
    public function store(MaterialRequest $request)
    {
        try {
            // $this->authorize('create', User::class);
            $data = $request->validated();
            $this->service->create($data);
             return redirect()->route('admin.material.index');
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
        $material = $this->service->find($id);
        if (!$material) {
            return ResponseJson::error('Material tidak ditemukan', 404);
         }
        return view('admin.material.form', compact('material'));
    }

   public function update(MaterialRequest $request, string $id)
    {
        try {
            $data = $request->validated();
            $material = $this->service->find($id);

            if (!$material) {
                return ResponseJson::error('Material tidak ditemukan', 404);
            }

            $this->service->update($id, $data);

            return redirect()->route('admin.material.index')
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

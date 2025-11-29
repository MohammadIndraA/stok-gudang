<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\ResponseJson;
use App\Http\Controllers\Controller;
use App\Http\Requests\ProjectRequest;
use App\Services\ProjectService;
use Illuminate\Http\Request;
use Illuminate\Routing\Controllers\Middleware;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Log;

class ProjectController extends Controller
{
    protected $service;

    public function __construct(ProjectService $service)
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
            $vendors = $this->service->getAll();
            return DataTables::of($vendors)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    return view('components.button-action', [
                        'id' => $row->id,
                        'routeEdit' => 'admin.project.edit',
                        'routeDelete' => 'admin.project.destroy',
                        'dataTable' => 'projectTable',
                        'model' => $row
                    ])->render();
                })
                ->rawColumns(['action'])
                ->make(true);
        }
        return view('admin.project.index');
    }

    public function create()
    {
        return view('admin.project.form');
    }
    public function store(ProjectRequest $request)
    {
        try {
            // $this->authorize('create', User::class);
            $data = $request->validated();
            $this->service->create($data);
            return redirect()->route('admin.project.index');
        } catch (\Throwable $th) {
            Log::error($th->getMessage());
            return ResponseJson::error($th->getMessage(), 500);
        }
    }

    public function show(Request $request)
    {
        // $this->authorize('view', User::class);
        $id = $request->id;
        $vendor = $this->service->find($id);
        if (!$vendor) {
            return ResponseJson::error('Project tidak ditemukan', 404);
        }
        return ResponseJson::success($vendor, 'Project found successfully');
    }

    public function edit($id)
    {
        $vendor = $this->service->find($id);
        if (!$vendor) {
            return ResponseJson::error('Project tidak ditemukan', 404);
        }
        return view('admin.project.form', compact('vendor'));
    }

    public function update(ProjectRequest $request, string $id)
    {
        try {
            $data = $request->validated();
            $vendor = $this->service->find($id);

            if (!$vendor) {
                return ResponseJson::error('Project tidak ditemukan', 404);
            }

            $this->service->update($id, $data);

            return redirect()->route('admin.project.index')
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
                return ResponseJson::error('Project tidak ditemukan atau gagal dihapus', 404);
            }
            return ResponseJson::success($deleted, 'Project deleted successfully');
        } catch (\Throwable $th) {
            Log::error($th->getMessage());
            return ResponseJson::error($th->getMessage(), 500);
        }
    }
}

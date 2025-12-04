<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\ResponseJson;
use App\Http\Controllers\Controller;
use App\Http\Requests\ProjectStageRequest;
use App\Services\ProjectStagesService;
use Illuminate\Http\Request;
use Illuminate\Routing\Controllers\Middleware;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Log;

class ProjectStagesController extends Controller
{
    protected $service;

    public function __construct(ProjectStagesService $service)
    {
        $this->service = $service;
    }

    public static function middleware()
    {
        return [
            new Middleware('permission:view-project-stage', ['only' => ['index', 'show']]),
            new Middleware('permission:create-project-stage', ['only' => ['create', 'store']]),
            new Middleware('permission:edit-project-stage', ['only' => ['edit', 'update']]),
            new Middleware('permission:delete-project-stage', ['only' => ['destroy']]),
        ];
    }

    public function index(Request $request)
    {
        // $this->authorize('viewAny', User::class);
        if ($request->ajax()) {
            $pss = $this->service->getAll();
            return DataTables::of($pss)
                ->addIndexColumn()
                ->editColumn('nama_tahap', function ($row) {
                    $url = route('admin.project-stage.show', $row->id);
                    return '<a href="' . $url . '" class="text-blue-500">' . $row->nama_tahap . '</a>';
                })
                ->addColumn('action', function ($row) {
                    return view('components.button-action', [
                        'id' => $row->id,
                        'routeEdit' => 'admin.project-stage.edit',
                        'routeDelete' => 'admin.project-stage.destroy',
                        'dataTable' => 'projectTable',
                        'model' => $row
                    ])->render();
                })
                ->rawColumns(['action', 'nama_tahap'])
                ->make(true);
        }
        return view('admin.project-stage.index');
    }

    public function create()
    {
        return view('admin.project-stage.form');
    }
    public function store(ProjectStageRequest $request)
    {
        try {
            // $this->authorize('create', User::class);
            $data = $request->validated();
            $this->service->create($data);
            return redirect()->route('admin.project-stage.index');
        } catch (\Throwable $th) {
            Log::error($th->getMessage());
            return ResponseJson::error($th->getMessage(), 500);
        }
    }

    public function show(Request $request, $id)
    {
        $ps = $this->service->find($id);
        if (!$ps) {
            return ResponseJson::error('Project tidak ditemukan', 404);
        }
        // dd($ps);
        return view('admin.stage-material.index', compact('ps'));
    }

    public function edit($id)
    {
        $ps = $this->service->find($id);
        if (!$ps) {
            return ResponseJson::error('Project tidak ditemukan', 404);
        }
        return view('admin.project-stage.form', compact('vendor'));
    }

    public function update(ProjectStageRequest $request, string $id)
    {
        try {
            $data = $request->validated();
            $ps = $this->service->find($id);

            if (!$ps) {
                return ResponseJson::error('Project tidak ditemukan', 404);
            }

            $this->service->update($id, $data);
            return redirect()->route('admin.project-stage.index')
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

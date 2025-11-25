<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\ResponseJson;
use App\Http\Controllers\Controller;
use App\Http\Requests\AplikatorRequest;
use App\Services\AplikatorService;
use Illuminate\Http\Request;
use Illuminate\Routing\Controllers\Middleware;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Log;

class AplikatorController extends Controller
{
      protected $service;

    public function __construct(AplikatorService $service)
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
        $aplikators = $this->service->getAllAplikator();
        return DataTables::of($aplikators)
            ->addIndexColumn()
            ->addColumn('action', function ($row) {
                return view('components.button-action', [
                    'id' => $row->id,
                    'routeEdit' => 'admin.aplikator.edit',
                    'routeDelete' => 'admin.aplikator.destroy',
                    'dataTable' => 'aplikatorTable',
                    'model' => $row
                ])->render();
            })
           ->rawColumns(['action'])
            ->make(true);
        }
        return view('admin.aplikator.index');
    }

    public function create()
    {
        return view('admin.aplikator.form');
    }
    public function store(AplikatorRequest $request)
    {
        try {
            // $this->authorize('create', User::class);
            $data = $request->validated();
            $this->service->createAplikator($data);
             return redirect()->route('admin.aplikator.index');
        } catch (\Throwable $th) {
            Log::error($th->getMessage());
            return ResponseJson::error($th->getMessage(), 500);
        }
       
    }

    public function show(Request $request)
    {
        // $this->authorize('view', User::class);
        $id = $request->id;
        $aplikator = $this->service->findById($id);
        if (!$aplikator) {
            return ResponseJson::error('Aplikator tidak ditemukan', 404);
         }
        return ResponseJson::success($aplikator, 'Aplikator found successfully');
    }

    public function edit($id)
    {
        $aplikator = $this->service->findById($id);
        if (!$aplikator) {
            return ResponseJson::error('Aplikator tidak ditemukan', 404);
         }
        return view('admin.aplikator.form', compact('aplikator'));
    }

   public function update(AplikatorRequest $request, string $id)
    {
        try {
            $data = $request->validated();
            $aplikator = $this->service->findById($id);

            if (!$aplikator) {
                return ResponseJson::error('Aplikator tidak ditemukan', 404);
            }

            $this->service->update($id, $data);

            return redirect()->route('admin.aplikator.index')
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
                return ResponseJson::error('Aplikator tidak ditemukan atau gagal dihapus', 404);
            }
            return ResponseJson::success($deleted, 'Aplikator deleted successfully');
        } catch (\Throwable $th) {
            Log::error($th->getMessage());
            return ResponseJson::error($th->getMessage(), 500);
        }
    }
}

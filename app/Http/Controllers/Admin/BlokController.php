<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\ResponseJson;
use App\Http\Controllers\Controller;
use App\Http\Requests\BlokRequest;
use App\Services\BlokService;
use Illuminate\Http\Request;
use Illuminate\Routing\Controllers\Middleware;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Log;

class BlokController extends Controller
{
      protected $service;

    public function __construct(BlokService $service)
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
        $bloks = $this->service->getAll();
        return DataTables::of($bloks)
            ->addIndexColumn()
             ->editColumn('kapling', function ($row){
                return $row->kaplings->count();
            })
            ->addColumn('action', function ($row) {
                return view('components.button-action', [
                    'id' => $row->id,
                    'routeEdit' => 'admin.blok.edit',
                    'routeDelete' => 'admin.blok.destroy',
                    'dataTable' => 'blokTable',
                    'model' => $row
                ])->render();
            })
           ->rawColumns(['action', 'kapling'])
            ->make(true);
        }
        return view('admin.blok.index');
    }

    public function create()
    {
        return view('admin.blok.form');
    }
    public function store(BlokRequest $request)
    {
        try {
            // $this->authorize('create', User::class);
            $data = $request->validated();
            $this->service->create($data);
             return redirect()->route('admin.blok.index');
        } catch (\Throwable $th) {
            Log::error($th->getMessage());
            return ResponseJson::error($th->getMessage(), 500);
        }
       
    }

    public function show(Request $request)
    {
        // $this->authorize('view', User::class);
        $id = $request->id;
        $blok = $this->service->find($id);
        if (!$blok) {
            return ResponseJson::error('Blok tidak ditemukan', 404);
         }
        return ResponseJson::success($blok, 'Blok found successfully');
    }

    public function edit($id)
    {
        $blok = $this->service->find($id);
        if (!$blok) {
            return ResponseJson::error('Blok tidak ditemukan', 404);
         }
        return view('admin.blok.form', compact('blok'));
    }

   public function update(BlokRequest $request, string $id)
    {
        try {
            $data = $request->validated();
            $blok = $this->service->find($id);

            if (!$blok) {
                return ResponseJson::error('Blok tidak ditemukan', 404);
            }

            $this->service->update($id, $data);

            return redirect()->route('admin.blok.index')
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
                return ResponseJson::error('Blok tidak ditemukan atau gagal dihapus', 404);
            }
            return ResponseJson::success($deleted, 'Material deleted successfully');
        } catch (\Throwable $th) {
            Log::error($th->getMessage());
            return ResponseJson::error($th->getMessage(), 500);
        }
    }
}

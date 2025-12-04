<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\ResponseJson;
use App\Http\Controllers\Controller;
use App\Http\Requests\MaterialRancanganRequest;
use App\Models\MaterialRakitan;
use App\Services\MaterialRancanganService;
use Illuminate\Routing\Controllers\Middleware;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use function Illuminate\Log\log;

class MaterialRakitanController extends Controller
{
    protected $service;

    public function __construct(MaterialRancanganService $service)
    {
        $this->service = $service;
    }

    public static function middleware()
    {
        return [
            new Middleware('permission:view-material-rakitan', ['only' => ['index', 'show']]),
            new Middleware('permission:create-material-rakitan', ['only' => ['create', 'store']]),
            new Middleware('permission:edit-material-rakitan', ['only' => ['edit', 'update']]),
            new Middleware('permission:delete-material-rakitan', ['only' => ['destroy']]),
        ];
    }

    public function index(Request $request)
    {
        // $this->authorize('viewAny', User::class);
        if ($request->ajax()) {
            $materials = $this->service->getAll();
            return DataTables::of($materials)
                ->addIndexColumn()
                ->editColumn('item', function ($row) {
                    return $row->items
                        ->map(fn($item) => '<span>- ' . $item->material->nama_material . '</span>')
                        ->implode('<br>');
                })
                ->editColumn('jumlah', function ($row) {
                    return $row->items
                        ->map(fn($item) => '<span> ' . $item->jumlah .  '</span>')
                        ->implode('<br>');
                })
                ->editColumn('satuan', function ($row) {
                    return $row->items
                        ->map(fn($item) => '<span> '  . $item->satuan .  '</span>')
                        ->implode('<br>');
                })
                ->addColumn('action', function ($row) {
                    return view('components.button-action', [
                        'id' => $row->id,
                        'routeDelete' => 'admin.material-rakitan.destroy',
                        'dataTable' => 'bomTable',
                        'model' => $row
                    ])->render();
                })
                ->rawColumns(['action', 'item', 'jumlah', 'satuan'])
                ->make(true);
        }
        return view('admin.material-rancangan.index');
    }

    public function create()
    {
        $materials = $this->service->getMaterial();

        return view('admin.material-rancangan.form', compact('materials'));
    }
    public function store(MaterialRancanganRequest $request)
    {
        DB::beginTransaction();

        try {
            $validator = Validator::make($request->all(), $request->rules(), $request->messages());

            if ($validator->fails()) {
                return response()->json([
                    'success' => false,
                    'errors'  => $validator->errors()
                ], 422);
            }
            $mr = MaterialRakitan::create([
                'material_id' => $request->material_id,
                'keterangan'   => $request->keterangan,
            ]);

            foreach ($request->items as $item) {
                $mr->items()->create([
                    'rakitan_id'    => $mr->id,
                    'material_id'    => $item['material_id'],
                    'jumlah' => $item['jumlah'],
                    'satuan' => $item['satuan'],
                ]);
            }

            DB::commit();

            return response()->json([
                'success'  => true,
                'message'  => 'Permintaan Material berhasil disimpan!',
                'redirect' => route('admin.permintaan-material.index')
            ]);
        } catch (\Throwable $th) {
            DB::rollBack();
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
        $materials = $this->service->getMaterial();
        if (!$bom) {
            return ResponseJson::error('Material tidak ditemukan', 404);
        }
        return view('admin.material-rancangan.form', compact('bom', 'materials'));
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

            return redirect()->route('admin.material-rakitan.index')
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

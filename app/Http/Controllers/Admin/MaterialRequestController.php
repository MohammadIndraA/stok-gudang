<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\ResponseJson;
use App\Http\Controllers\Controller;
use App\Http\Requests\PermintaanMaterialRequest;
use App\Models\MaterialRequest;
use App\Services\PermintaanMaterialService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;


class MaterialRequestController extends Controller
{
    protected $service;

    public function __construct(PermintaanMaterialService $service)
    {
        $this->service = $service;
    }

    public function index(Request $request)
    {
        // $this->authorize('viewAny', User::class);
        if ($request->ajax()) {
            $grns = $this->service->getAll();
            return DataTables::of($grns)
                ->addIndexColumn()
                ->editColumn('kapling_id', function ($row) {
                    return $row->kapling->nama;
                })
                ->editColumn('aplikator_id', function ($row) {
                    return $row->aplikator->nama_lengkap;
                })
                ->editColumn('tanggal_dipenuhi', function ($row) {
                    return $row->tanggal_dipenuhi ?? '-';
                })
                ->editColumn('tanggal_permintaan', function ($row) {
                    return $row->created_at->locale('id')->translatedFormat('l, d F Y H:i') ?? '-';
                })
                ->addColumn('status', function ($row) {
                    if ($row->status === 'draft') {
                        return '<span class="bg-slate-500/10 text-slate-500 text-[11px] font-medium mr-1 px-2.5 py-0.5 rounded-full">draft</span>';
                    } else if ($row->status === 'diajukan') {
                        return '<span class="bg-yellow-500/10 text-yellow-500 text-[11px] font-medium mr-1 px-2.5 py-0.5 rounded-full">diajukan</span>';
                    } else if ($row->status === 'disetujui') {
                        return '<span class="bg-green-500/10 text-green-500 text-[11px] font-medium mr-1 px-2.5 py-0.5 rounded-full">disetujui</span>';
                    } else if ($row->status === 'dibatalkan') {
                        return '<span class="bg-red-500/10 text-red-500 text-[11px] font-medium mr-1 px-2.5 py-0.5 rounded-full">dibatalkan</span>';
                    }
                })
                ->addColumn('action', function ($row) {
                    $url = route('admin.permintaan-material.show', $row->id);

                    return '<a href="' . $url . '" 
                class="inline-block focus:outline-none rounded-full bg-blue-500 mt-1 text-white 
                       hover:bg-blue-600 hover:text-white text-md font-medium 
                        px-4 rounded">
                detail
            </a>';
                })
                ->rawColumns(['status', 'action', 'vendor_id', 'tanggal_permintaan', 'tanggal_dipenuhi'])
                ->make(true);
        }
        return view('admin.permintaan-material.index');
    }

    public function create()
    {
        $kaplings = $this->service->getKapling();
        $aplikators = $this->service->getAplikator();
        $materials = $this->service->geMaterial();
        return view('admin.permintaan-material.form', compact('aplikators', 'kaplings', 'materials'));
    }
    public function store(PermintaanMaterialRequest $request)
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
            $mr = MaterialRequest::create([
                'kapling_id' => $request->kapling_id,
                'aplikator_id' => $request->aplikator_id,
                'catatan'   => $request->catatan,
                'status'    => $request->status,
            ]);

            foreach ($request->items as $item) {
                $mr->items()->create([
                    'request_id'    => $mr->id,
                    'material_id'    => $item['material_id'],
                    'jumlah_diminta' => $item['jumlah_diminta'],
                    'satuan' => $item['satuan'],
                ]);
            }

            DB::commit();

            return response()->json([
                'success'  => true,
                'message'  => 'Permintaan Material berhasil disimpan!',
                'redirect' => route('admin.material-rakitan.index')
            ]);
        } catch (\Throwable $th) {
            DB::rollBack();
            Log::error($th->getMessage());
            return ResponseJson::error($th->getMessage(), 500);
        }
    }

    public function show(Request $request, $id)
    {
        $kapling = $this->service->find($id);
        if (!$kapling) {
            return ResponseJson::error('Kapling tidak ditemukan', 404);
        }
        return view('admin.permintaan-material.detail', compact('kapling'));
    }

    public function edit($id)
    {
        $kapling = $this->service->find($id);
        if (!$kapling) {
            return ResponseJson::error('Kapling tidak ditemukan', 404);
        }
        return view('admin.permintaan-material.form', compact('kapling'));
    }

    public function update(PermintaanMaterialRequest $request, string $id)
    {
        try {
            $data = $request->validated();
            $kapling = $this->service->find($id);

            if (!$kapling) {
                return ResponseJson::error('kapling tidak ditemukan', 404);
            }

            $this->service->update($id, $data);

            return redirect()->route('admin.permintaan-material.index')
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

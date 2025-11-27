<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\ResponseJson;
use App\Http\Controllers\Controller;
use App\Http\Requests\PurchaseOrderRequest;
use App\Models\PurchaseOrder;
use App\Services\PurchaseOrderService;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Routing\Controllers\Middleware;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;

class PurchaseOrderController extends Controller
{
    protected $service;

    public function __construct(PurchaseOrderService $service)
    {
        $this->service = $service;
    }

    public static function middleware()
    {
        return [
            new Middleware('permission:view-purchase-order', ['only' => ['index', 'show']]),
            new Middleware('permission:create-purchase-order', ['only' => ['create', 'store']]),
            new Middleware('permission:edit-purchase-order', ['only' => ['edit', 'update']]),
            new Middleware('permission:delete-purchase-order', ['only' => ['destroy']]),
        ];
    }

    public function index(Request $request)
    {
        // $this->authorize('viewAny', User::class);
        if ($request->ajax()) {
            $vendors = $this->service->getAll();
            return DataTables::of($vendors)
                ->addIndexColumn()
                ->editColumn('vendor_id', function ($row) {
                    return $row->vendor->nama;
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
                    return view('components.button-action', [
                        'id' => $row->id,
                        'routeEdit' => 'admin.purchase-order.edit',
                        'routeDelete' => 'admin.purchase-order.destroy',
                        'dataTable' => 'purchaseOrderTable',
                        'model' => $row
                    ])->render();
                })
                ->rawColumns(['action', 'status', 'vendor_id'])
                ->make(true);
        }
        $vendors = $this->service->getVendor();
        $materials = $this->service->getMaterial();
        return view('admin.purchase-order.index', compact('vendors', 'materials'));
    }

    public function create()
    {
        return view('admin.purchase-order.form');
    }
    public function store(PurchaseOrderRequest $request)
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

            $po = PurchaseOrder::create([
                'vendor_id' => $request->vendor_id,
                'catatan'   => $request->catatan,
                'status'    => $request->status,
            ]);

            foreach ($request->items as $item) {
                $po->items()->create([
                    'material_id'    => $item['material_id'],
                    'jumlah_diminta' => $item['jumlah_diminta'],
                    'harga_satuan'   => $item['harga_satuan'],
                    'total_harga'    => $item['total_harga'],
                ]);
            }

            DB::commit();

            return response()->json([
                'success'  => true,
                'message'  => 'Purchase Order berhasil disimpan!',
                'redirect' => route('admin.purchase-order.index')
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
        $vendor = $this->service->find($id);
        if (!$vendor) {
            return ResponseJson::error('Purchase Order tidak ditemukan', 404);
        }
        return ResponseJson::success($vendor, 'Purchase Order found successfully');
    }

    public function edit($id)
    {
        $vendor = $this->service->find($id);
        if (!$vendor) {
            return ResponseJson::error('Purchase Order tidak ditemukan', 404);
        }
        return view('admin.purchase-order.form', compact('vendor'));
    }

    public function update(PurchaseOrderRequest $request, string $id)
    {
        try {
            $data = $request->validated();
            $vendor = $this->service->find($id);

            if (!$vendor) {
                return ResponseJson::error('Purchase Order tidak ditemukan', 404);
            }

            $this->service->update($id, $data);

            return redirect()->route('admin.purchase-order.index')
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
                return ResponseJson::error('Purchase Order tidak ditemukan atau gagal dihapus', 404);
            }
            return ResponseJson::success($deleted, 'Purchase Order deleted successfully');
        } catch (\Throwable $th) {
            Log::error($th->getMessage());
            return ResponseJson::error($th->getMessage(), 500);
        }
    }
}

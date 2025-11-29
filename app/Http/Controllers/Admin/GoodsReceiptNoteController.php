<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\ResponseJson;
use App\Http\Controllers\Controller;
use App\Models\GoodsReceiptNote;
use App\Models\PurchaseOrder;
use App\Models\StokTransaction;
use App\Services\GoodsReceiptNoteService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class GoodsReceiptNoteController extends Controller
{

    protected $service;

    public function __construct(GoodsReceiptNoteService $service)
    {
        $this->service = $service;
    }

    public function index(Request $request)
    {
        // $this->authorize('viewAny', User::class);
        if ($request->ajax()) {
            $grns = $this->service->getPO();
            return DataTables::of($grns)
                ->addIndexColumn()
                ->editColumn('vendor_id', function ($row) {
                    return '<a href="' . route('admin.penerimaan-material.edit', $row->id) . '" class="text-blue-50">' . $row->vendor->nama . '</a>';
                })
                ->editColumn('waktu', function ($row) {
                    return $row->created_at->locale('id')->translatedFormat('l, d F Y H:i') ?? '-';
                })
                ->editColumn('catatan', function ($row) {
                    return $row->catatan ?? '-';
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

                ->rawColumns(['status', 'vendor_id', 'waktu', 'catatan'])
                ->make(true);
        }

        return view('admin.penerimaan-material.index');
    }

    public function store(Request $request)
    {
        // dd($request->all());
        DB::beginTransaction();

        try {
            $validator = Validator::make($request->all(), [
                'catatan'  => 'nullable|string',
                'items'    => 'required|array|min:1',
                'items.*.material_id'     => 'required|exists:materials,id',
                'items.*.id'      => 'required|exists:purchase_order_items,id',
                'items.*.jumlah_diterima' => 'required|numeric|min:0',
                'items.*.jumlah_ditolak'  => 'nullable|numeric|min:0',
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'status'  => false,
                    'message' => 'Validasi gagal',
                    'errors'  => $validator->errors(),
                    'data'    => null,
                ], 422);
            }

            $validated = $validator->validated();

            $grn = GoodsReceiptNote::create([
                'po_id'   => $request->po_id,
                'catatan' => $request->catatan ?? null,
            ]);

            // update 
            PurchaseOrder::where('id', $request->po_id)->update([
                'status' => 'disetujui',
                'catatan' => $request->catatan ?? null,
            ]);

            foreach ($validated['items'] as $item) {
                $grnItem = $grn->items()->updateOrCreate(
                    ['po_item_id' => $item['id']], // kunci unik untuk item GRN
                    [
                        'material_id'     => $item['material_id'],
                        'jumlah_diterima' => $item['jumlah_diterima'],
                        'jumlah_ditolak'  => $item['jumlah_ditolak'] ?? 0,
                    ]
                );

                StokTransaction::create([
                    'material_id'            => $item['material_id'],
                    'project_id'             => $item['project_id'] ?? null,
                    'jenis_transaksi'        => 'masuk',
                    'referensi_jenis'        => 'grn',
                    'referensi_id'           => $grnItem->id,
                    'jumlah'                 => $item['jumlah_diterima'],
                    'stok_setelah_transaksi' => $this->hitungStokSetelah($item['material_id'], $item['jumlah_diterima']),
                    'dibuat_oleh'            => Auth::user()->nama_lengkap,
                    'catatan' => $request->catatan ?? null,

                ]);
            }

            DB::commit();

            return response()->json([
                'success'  => true,
                'redirect' => route('admin.penerimaan-material.index'),
            ]);
        } catch (\Throwable $th) {
            DB::rollBack();
            Log::error($th->getMessage());

            return response()->json([
                'status'  => false,
                'message' => 'Terjadi kesalahan',
                'errors'  => [$th->getMessage()],
                'data'    => null,
            ], 500);
        }
    }

    protected function hitungStokSetelah($materialId, $jumlahMasuk)
    {
        $stokSebelum = StokTransaction::where('material_id', $materialId)
            ->latest('id')
            ->value('stok_setelah_transaksi') ?? 0;

        return $stokSebelum + $jumlahMasuk;
    }


    public function show(Request $request)
    {
        // $this->authorize('view', User::class);
        $id = $request->id;
        $grn = $this->service->find($id);
        if (!$grn) {
            return ResponseJson::error('Purchase Order tidak ditemukan', 404);
        }
        return ResponseJson::success($grn, 'Purchase Order found successfully');
    }

    public function edit($id)
    {
        $grn = $this->service->find($id);
        if (!$grn) {
            return ResponseJson::error('Purchase Order tidak ditemukan', 404);
        }
        $materials = $this->service->getMaterial();
        $poSudahDiterima = $this->service->find($id)->receipts()->exists();
        $itemPO = $grn->items->map(function ($item) {
            $totalDiterima = $item->receipts->sum('jumlah_diterima'); // semua GRN untuk item ini
            return [
                'id'             => $item->id,
                'material_id'    => $item->material_id,
                'material_nama'  => $item->material->nama_material,
                'jumlah_diminta' => $item->jumlah_diminta,
                'jumlah_diterima' => $totalDiterima,
                'jumlah_sisa'    => $item->jumlah_diminta - $totalDiterima,
                'harga_satuan'   => $item->harga_satuan,
                'total_harga'    => ($item->jumlah_diminta - $totalDiterima) * $item->harga_satuan,
            ];
        });
        $poSelesai = $itemPO->every(fn($i) => $i['jumlah_diterima'] >= $i['jumlah_diminta']);
        // dd($poSelesai);
        return view('admin.penerimaan-material.form', compact('grn', 'itemPO', 'materials', 'poSelesai', 'poSudahDiterima'));
    }
}

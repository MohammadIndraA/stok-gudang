<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\UpdateInputStokOpnameRequest;
use App\Models\ItemStokOpname;
use App\Models\Material;
use App\Models\PeriodeStokOpname;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Facades\DataTables;


class ItemStokOpnameController extends Controller
{
    public $acctivePreiode = null, $items = null;

    public function __construct()
    {
        $periode = PeriodeStokOpname::where('is_active', true)->first()->id ?? 0;
        $this->acctivePreiode = $periode;
        $this->items = ItemStokOpname::with(['material'])->where('periode_stok_opname_id', $this->acctivePreiode)->get();
    }

    public function index(Request $request)
    {
        // $this->authorize('viewAny', User::class);
        if ($request->ajax()) {
            $ipso = ItemStokOpname::with(['material'])->get();
            return DataTables::of($ipso)
                ->addIndexColumn()
                ->editColumn('material_id', function ($row) {
                    return $row->material->kode_material;
                })
                ->editColumn('material', function ($row) {
                    return $row->material->nama_material;
                })
                ->editColumn('stok', function ($row) {
                    return $row->material->current_stock;
                })
                ->editColumn('petugas', function ($row) {
                    return $row->petugas ?? '-';
                })
                ->editColumn('keterangan', function ($row) {
                    return $row->keterangan ?? '-';
                })
                ->addColumn('status', function ($row) {
                    if ($row->status === 'selisih') {
                        return '<span class="bg-red-500/10 text-red-500 text-[11px] font-medium mr-1 px-2.5 py-0.5 rounded-full">selisih</span>';
                    } else if ($row->status === 'sesuai') {
                        return '<span class="bg-green-500/10 text-green-500 text-[11px] font-medium mr-1 px-2.5 py-0.5 rounded-full">sesuai</span>';
                    } else {
                        return '<span class="bg-gray-500/10 text-gray-500 text-[11px] font-medium mr-1 px-2.5 py-0.5 rounded-full">belum dilaporkan</span>';
                    }
                })
                ->addColumn('action', function ($row) {
                    $editUrl = route('admin.stok-opname.input.edit', $row->id);

                    $html = '
        <div class="p-3 text-sm text-gray-500 whitespace-nowrap dark:text-gray-400 text-center">
            <a href="' . $editUrl . '" class="ml-2 text-blue-600 hover:underline">Laporkan</a>
        </div>
    ';

                    return $html;
                })
                ->rawColumns(['action', 'material_id', 'material', 'stok', 'status', 'keterangan', 'petugas'])
                ->make(true);
        }
        return view('admin.item-stok-opname.index');
    }


    public function create()
    {
        $items = $this->items;
        return view('admin.item-stok-opname.index');
    }

    public function edit($id)
    {
        $ipso = ItemStokOpname::with(['material'])->where('id', $id)->firstOrFail();

        return view('admin.item-stok-opname.form', compact('ipso'));
    }

    public function update(UpdateInputStokOpnameRequest $request, $id)
    {
        $item = ItemStokOpname::with(['material'])->find($id);
        $isSelisih = $request->jumlah_dilaporkan != $item->material->current_stock;

        $item->update([
            'jumlah_dilaporkan' => $request->jumlah_dilaporkan,
            'status' => $isSelisih ? 'selisih' : 'sesuai',
            'keterangan' => $request->keterangan,
            'petugas' => Auth::user()->nama_lengkap,
        ]);

        $itemStokOpname = ItemStokOpname::where('periode_stok_opname_id', $this->acctivePreiode)->where('status', 'belum dilaporkan')->count();

        if ($itemStokOpname == 0) {
            PeriodeStokOpname::where('id', $this->acctivePreiode)->update(['is_active' => true]);
        }

        return redirect()->route('admin.stok-opname.input.index');
    }

    public function update_material(Request $request)
    {
        $periodeId = $request->periode_id;
        $periode = PeriodeStokOpname::findOrFail($periodeId);
        $material = Material::all();

        if (!$periode->is_active) {
            return response()->json([
                'success' => false,
                'message' => 'Periode Stok Opname Tidak Aktif',
                'redirect_url' => route('admin.stok-opname.input.show', $periodeId),
            ]);
        }

        if (count($periode->items) == count($material)) {
            return response()->json([
                'success' => false,
                'message' => 'Data Sudah Terupdate Tidak Ada Data baru yang ditambahkan',
                'redirect_url' => route('admin.stok-opname.input.show', $periodeId),
            ]);
        }

        foreach ($material as $value) {
            ItemStokOpname::updateOrCreate([
                ['periode_stok_opname_id' => $periodeId, 'kode_material' => $value->kode_material],
                ['jumlah_stok' => $value->current_stock]
            ]);
        }

        $periode->is_completed = 0;
        $periode->jumlah_barang = count($material);
        $periode->save();

        return response()->json([
            'success' => true,
            'message' => 'Data Material Berhasil di Update',
            'redirect_url' => route('admin.stok-opname.input.show', $periodeId),
        ]);
    }
}

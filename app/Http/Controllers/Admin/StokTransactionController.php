<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\StokTransactionService;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class StokTransactionController extends Controller
{

    protected $service;

    public function __construct(StokTransactionService $service)
    {
        $this->service = $service;
    }

    public function stokMasuk(Request $request)
    {

        // $this->authorize('viewAny', User::class);
        if ($request->ajax()) {
            $grns = $this->service->masuk($request->all());
            return DataTables::of($grns)
                ->addIndexColumn()
                ->editColumn('material_id', function ($row) {
                    return $row->material->nama_material;
                })
                ->editColumn('satuan', function ($row) {
                    return $row->material->satuan;
                })
                ->editColumn('catatan', function ($row) {
                    return $row->catatan ?? '-';
                })
                ->editColumn('waktu', function ($row) {
                    return $row->created_at->locale('id')->translatedFormat('l, d F Y H:i') ?? '-';
                })
                ->addColumn('referensi_jenis', function ($row) {
                    if ($row->referensi_jenis === 'grn') {
                        return '<span class="bg-slate-500/10 text-slate-500 text-[11px] font-medium mr-1 px-2.5 py-0.5 rounded-full">purchae order</span>';
                    } else if ($row->referensi_jenis === 'permintaan') {
                        return '<span class="bg-yellow-500/10 text-yellow-500 text-[11px] font-medium mr-1 px-2.5 py-0.5 rounded-full">permintaan</span>';
                    } else if ($row->referensi_jenis === 'adjusment') {
                        return '<span class="bg-green-500/10 text-green-500 text-[11px] font-medium mr-1 px-2.5 py-0.5 rounded-full">disetujui</span>';
                    }
                })
                ->rawColumns(['referensi_jenis', 'material_id', 'catatan', 'waktu', 'satuan'])
                ->make(true);
        }
        $vendors = $this->service->getVendor();
        return view('admin.stok.index', compact('vendors'));
    }


    public function stokKeluar(Request $request)
    {
        if ($request->ajax()) {
            $grns = $this->service->keluar($request->all());
            return DataTables::of($grns)
                ->addIndexColumn()
                ->editColumn('material_id', function ($row) {
                    return $row->material->nama_material;
                })
                ->editColumn('satuan', function ($row) {
                    return $row->material->satuan;
                })
                ->editColumn('catatan', function ($row) {
                    return $row->catatan ?? '-';
                })
                ->editColumn('waktu', function ($row) {
                    return $row->created_at->locale('id')->translatedFormat('l, d F Y H:i') ?? '-';
                })
                ->addColumn('referensi_jenis', function ($row) {
                    if ($row->referensi_jenis === 'grn') {
                        return '<span class="bg-slate-500/10 text-slate-500 text-[11px] font-medium mr-1 px-2.5 py-0.5 rounded-full">purchae order</span>';
                    } else if ($row->referensi_jenis === 'permintaan') {
                        return '<span class="bg-yellow-500/10 text-yellow-500 text-[11px] font-medium mr-1 px-2.5 py-0.5 rounded-full">permintaan</span>';
                    } else if ($row->referensi_jenis === 'adjusment') {
                        return '<span class="bg-green-500/10 text-green-500 text-[11px] font-medium mr-1 px-2.5 py-0.5 rounded-full">disetujui</span>';
                    }
                })
                ->rawColumns(['referensi_jenis', 'material_id', 'catatan', 'waktu', 'satuan'])
                ->make(true);
        }
        $vendors = $this->service->getVendor();
        return view('admin.stok.index');
    }
}

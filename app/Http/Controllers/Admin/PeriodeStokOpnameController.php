<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\ResponseJson;
use App\Http\Controllers\Controller;
use App\Http\Requests\PeriodeStokOpnameRequest;
use App\Models\ItemStokOpname;
use App\Models\Material;
use App\Models\PeriodeStokOpname;
use App\Services\PeriodeStokOpnameService;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Routing\Controllers\Middleware;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class PeriodeStokOpnameController extends Controller
{

    protected $service;

    public function __construct(PeriodeStokOpnameService $service)
    {
        $this->service = $service;
    }

    public static function middleware()
    {
        return [
            new Middleware('permission:view-periode-stok-opname', ['only' => ['index', 'show']]),
            new Middleware('permission:create-periode-stok-opname', ['only' => ['create', 'store']]),
            new Middleware('permission:edit-periode-stok-opname', ['only' => ['edit', 'update']]),
            new Middleware('permission:delete-periode-stok-opname', ['only' => ['destroy']]),
        ];
    }

    public function index(Request $request)
    {
        // $this->authorize('viewAny', User::class);
        if ($request->ajax()) {
            $vendors = $this->service->getAll();
            return DataTables::of($vendors)
                ->addIndexColumn()
                ->editColumn('periode', function ($row) {
                    $mulai = Carbon::parse($row->tanggal_mulai)->locale('id')->translatedFormat('d M Y');
                    $selesai =    Carbon::parse($row->tanggal_selesai)->locale('id')->translatedFormat('d M Y');
                    return "{$mulai} s/d {$selesai}";
                })
                ->editColumn('is_active', function ($row) {
                    return $row->is_active ? 'Aktif' : 'Tidak Aktif';
                })
                ->editColumn('jumlah_barang_sesuai', function ($row) {
                    return ItemStokOpname::jumlahDiLaporkan($row->id, 'sesuai');
                })
                ->editColumn('jumlah_barang_selisih', function ($row) {
                    return ItemStokOpname::jumlahDiLaporkan($row->id, 'selisih');
                })
                ->addColumn('is_completed', function ($row) {
                    if ($row->is_completed === '1') {
                        return '<span class="bg-green-500/10 text-green-500 text-[11px] font-medium mr-1 px-2.5 py-0.5 rounded-full">Lengkap</span>';
                    } else {
                        return '<span class="bg-yellow-500/10 text-yellow-500 text-[11px] font-medium mr-1 px-2.5 py-0.5 rounded-full">Belum Lengkap</span>';
                    }
                })
                ->addColumn('action', function ($row) {
                    return view('components.button-action', [
                        'id' => $row->id,
                        'routeEdit' => 'admin.stok-opname.periode.edit',
                        'routeShow' => 'admin.stok-opname.periode.show',
                        'routeDelete' => 'admin.stok-opname.periode.destroy',
                        'dataTable' => 'periodeTable',
                        'model' => $row
                    ])->render();
                })
                ->rawColumns(['action', 'periode', 'is_active', 'is_completed'])
                ->make(true);
        }
        return view('admin.stok-opname.index');
    }

    public function create()
    {
        return view('admin.stok-opname.form');
    }

    public function store(PeriodeStokOpnameRequest $request)
    {
        DB::transaction(function () use ($request) {
            $isActive = $request->is_active ? true : false;
            $materials = Material::all();

            // Buat periode baru
            $newPeriode = PeriodeStokOpname::create([
                'tanggal_mulai'   => $request->tanggal_mulai,
                'tanggal_selesai' => $request->tanggal_selesai,
                'is_active'       => $isActive,
                'jumlah_barang'   => $materials->count(),
            ]);

            // Insert item stok opname
            foreach ($materials as $value) {
                ItemStokOpname::create([
                    'periode_stok_opname_id' => $newPeriode->id,
                    'material_id' => $value->id,
                    'jumlah_stok'            => $value->jumlah_stok,
                ]);
            }

            // Nonaktifkan periode lain
            PeriodeStokOpname::where('is_active', true)
                ->where('id', '!=', $newPeriode->id)
                ->update(['is_active' => false]);
        });

        return redirect()->route('admin.stok-opname.periode.index')
            ->with('success', 'Periode stok opname berhasil dibuat');
    }


    public function show($id)
    {

        $dataPeriode = PeriodeStokOpname::findOrFail($id);
        $mulai = Carbon::parse($dataPeriode->tanggal_mulai)->locale('id')->translatedFormat('d M Y');
        $selesai =    Carbon::parse($dataPeriode->tanggal_selesai)->locale('id')->translatedFormat('d M Y');
        $periode = $mulai . ' s/d '  . $selesai;
        $dataPeriode['periode'] = $periode;

        $dataPeriode['jumlah_barang_sesuai'] = ItemStokOpname::jumlahDiLaporkan($dataPeriode->id, 'sesuai');
        $dataPeriode['jumlah_barang_selisih'] = ItemStokOpname::jumlahDiLaporkan($dataPeriode->id, 'selisih');
        return view('admin.stok-opname.detail', compact('dataPeriode'));
    }

    public function edit($id)
    {
        $periode = $this->service->find($id);
        if (!$periode) {
            return ResponseJson::error('Data tidak ditemukan', 404);
        }
        return view('admin.stok-opname.form', compact('periode'));
    }

    public function update(PeriodeStokOpnameRequest $request, $id)
    {
        DB::transaction(function () use ($request, $id) {
            $isActive = $request->is_active ? true : false;

            $pso = $this->service->find($id);

            // Buat periode baru
            $pso->update([
                'tanggal_mulai'   => $request->tanggal_mulai,
                'tanggal_selesai' => $request->tanggal_selesai,
                'is_active'       => $isActive,
            ]);

            // Nonaktifkan periode lain
            if ($request->isActive) {
                PeriodeStokOpname::where('is_active', true)
                    ->where('id', '!=', $id)
                    ->update(['is_active' => false]);
            }
        });

        return redirect()->route('admin.stok-opname.periode.index')
            ->with('success', 'Periode stok opname berhasil dibuat');
    }

    public function destroy($id)
    {
        try {
            $periode = $this->service->find($id);

            if ($periode->is_active) {
                return redirect()->back()->with('error', 'Stok Opname sedang aktif, tidak bisa dihapus');
            }

            $deleted = $periode->delete();
            if (!$deleted) {
                return redirect()->back()->with('error', 'Project tidak ditemukan atau gagal dihapus');
            }

            return redirect()->route('admin.stok-opname.periode.index')
                ->with('success', 'Project berhasil dihapus');
        } catch (\Throwable $th) {
            \Log::error($th->getMessage());
            return redirect()->back()->with('error', 'Terjadi kesalahan: ' . $th->getMessage());
        }
    }
}

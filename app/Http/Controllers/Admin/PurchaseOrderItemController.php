<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\PurchaseOrderItemService;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;


class PurchaseOrderItemController extends Controller
{
    protected $service;

    public function __construct(PurchaseOrderItemService $service)
    {
        $this->service = $service;
    }
     public function index(Request $request)
    {
        // $this->authorize('viewAny', User::class);
        if ($request->ajax()) {
        $vendors = $this->service->getAll();
        return DataTables::of($vendors)
            ->addIndexColumn()
             ->editColumn('po_id', function ($row){
                return $row->po->nomor_po;
            })
             ->editColumn('material_id', function ($row){
                return $row->material->nama_material;
            })
            ->addColumn('action', function ($row) {
                return view('components.button-action', [
                    'id' => $row->id,
                    'routeEdit' => 'admin.purchase-order-item.edit',
                    'routeDelete' => 'admin.purchase-order-item.destroy',
                    'dataTable' => 'poiTable',
                    'model' => $row
                ])->render();
            })
           ->rawColumns(['action','po_id','material_id'])
            ->make(true);
        }
        return view('admin.purchase-order-item.index');
    }
}

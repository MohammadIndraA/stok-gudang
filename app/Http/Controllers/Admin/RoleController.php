<?php

namespace App\Http\Controllers\Admin;

use App\DTO\Role\RoleData;
use App\Helpers\ResponseJson;
use App\Http\Controllers\Controller;
use App\Http\Requests\RoleRequest;
use Illuminate\Routing\Controllers\Middleware;
use App\Services\RoleService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Yajra\DataTables\Facades\DataTables;

use function Illuminate\Log\log;

class RoleController extends Controller
{
    public function __construct(protected RoleService $roleService) {
    }

     public static function middleware()
    {
        return [
             new Middleware('permission:view-role', ['only' => ['index','show']]),
             new Middleware('permission:create-role', ['only' => ['create','store']]),
             new Middleware('permission:edit-role', ['only' => ['edit','update']]),
             new Middleware('permission:delete-role', ['only' => ['destroy']]),
        ];
    }

     public function index(Request $request)
    {
        if ($request->ajax()) {
        $roles = $this->roleService->getAllRole();
        return DataTables::of($roles)
            ->addIndexColumn()
             ->addColumn('permissions', function ($role) {
                    $badges = $role->permissions->pluck('name')->map(function ($permission) {
                        return ' <span class="bg-transparent border border-gray-500 text-gray-500 text-[11px] font-medium mr-1 px-2.5 py-0.5 rounded">' . $permission . '</span>';
                    })->implode(' '); // Gabungkan setiap badge dengan spasi antar badge
                    return $badges;
                }) 
            ->addColumn('action', function ($row) {
                log($row);
                    return view('components.button-action', [
                        'id' => $row->uuid,
                        'routeEdit' => 'admin.role.edit',
                        'routeDelete' => 'admin.role.destroy',
                        'dataTable' => 'roleTable',
                        'model' => $row
                    ])->render();
                })
            ->rawColumns(['permissions', 'action'])
            ->make(true);
        }
        $roles = $this->roleService->getAllRole();
        return view('admin.roles.index', compact('roles'));
    }


    public function create()
    {
        $permissions = $this->roleService->getAllPermission();
        return view('admin.roles.form', compact('permissions'));
    }

    public function store(RoleRequest $request) 
    {
        try {
             $data = $request->validated();
            $this->roleService->create($data);
            return redirect()->route('admin.role.index');
            } catch (\Throwable $th) {
            Log::error($th->getMessage());
            return ResponseJson::error($th->getMessage(), 500);    
        }
    }

    public function show(Request $request)
    {
        try {
            $id = $request->id;
            $role = $this->roleService->findById($id);
            if (!$role) {
                return ResponseJson::error('Role tidak ditemukan', 404);
            }
             $permission = $this->roleService->findPermissionById($id);
            return response()->json([
                'data' => $role,
                'permissions' => $permission,
                'success' => true
            ]);
        } catch (\Throwable $th) {
            Log::error($th->getMessage());
            return ResponseJson::error($th->getMessage(), 500);
        }
    }

    public function edit($id)
    {
        $role = $this->roleService->findById($id);
        if (!$role) {
            return ResponseJson::error('Role tidak ditemukan', 404);
         }
        $permissions = $this->roleService->getAllPermission();
        return view('admin.roles.form', compact('role', 'permissions'));
    }

    public function update(RoleRequest $request, $id)
    {
        try {
             $data = $request->validated();
            $role = $this->roleService->findById($id);
            if (!$role) {
               return ResponseJson::error('Role tidak ditemukan', 404);
            }
            $this->roleService->update($id, $data);
           return redirect()->route('admin.role.index');
        } catch (\Throwable $th) {
            Log::error($th->getMessage());
            return ResponseJson::error($th->getMessage(), 500);
        }
    }

    public function destroy($id)
    {
        try {
            $deleted = $this->roleService->delete($id);
            if (! $deleted) {
                return ResponseJson::error('Role tidak ditemukan atau gagal dihapus', 404);
            }
            return ResponseJson::success($deleted, 'Role deleted successfully');
        } catch (\Throwable $th) {
            //throw $th;
            Log::error($th->getMessage());
            return ResponseJson::error($th->getMessage(), 500);
        }
    }
}

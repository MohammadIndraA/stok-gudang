<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\ResponseJson;
use App\Http\Requests\UserRequest;
use App\Services\UserService;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use Illuminate\Routing\Controllers\Middleware;

class UserController extends Controller
{
    protected $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

     public static function middleware()
    {
        return [
             new Middleware('permission:view-user', ['only' => ['index','show']]),
             new Middleware('permission:create-user', ['only' => ['create','store']]),
             new Middleware('permission:edit-user', ['only' => ['edit','update']]),
             new Middleware('permission:delete-user', ['only' => ['destroy']]),
        ];
    }

    public function index(Request $request)
    {
        // $this->authorize('viewAny', User::class);
        if ($request->ajax()) {
        $users = $this->userService->getAllUser();
        return DataTables::of($users)
            ->addIndexColumn()
            ->addColumn('status', function($row) {
                    if ($row->status === 'Active') {
                        return '<span class="bg-green-500/10 text-green-500 text-[11px] font-medium mr-1 px-2.5 py-0.5 rounded-full">Active</span>';
                    } else {
                        return '<span class="bg-red-500/10 text-red-500 text-[11px] font-medium mr-1 px-2.5 py-0.5 rounded-full">Inactive</span>';
                    }
                })
            ->addColumn('role', fn($row) => $row->getRoleNames()->first() ?? '-')
            ->addColumn('date', fn($row) => $row->created_at->diffForHumans())
            ->addColumn('action', function ($row) {
                return view('components.button-action', [
                    'id' => $row->id,
                    'routeEdit' => 'admin.user.edit',
                    'routeDelete' => 'admin.user.destroy',
                    'dataTable' => 'userTable',
                    'model' => $row
                ])->render();
            })
            ->rawColumns(['status', 'action', 'date'])
            ->make(true);
        }
        return view('admin.users.index');
    }

    public function create()
    {
        // $this->authorize('create', User::class);
        $roles = $this->userService->getAllRole();
        return view('admin.users.form', compact('roles'));
    }
    public function store(UserRequest $request)
    {
        try {
            // $this->authorize('create', User::class);
            $data = $request->validated();
            $this->userService->createUser($data);
             return redirect()->route('admin.user.index');
        } catch (\Throwable $th) {
            Log::error($th->getMessage());
            return ResponseJson::error($th->getMessage(), 500);
        }
       
    }

    public function show(Request $request)
    {
        // $this->authorize('view', User::class);
        $id = $request->id;
        $user = $this->userService->findById($id);
        if (!$user) {
            return ResponseJson::error('User tidak ditemukan', 404);
         }
        return ResponseJson::success($user, 'User found successfully');
    }

    public function edit($id)
    {
        $user = $this->userService->findById($id);
        if (!$user) {
            return ResponseJson::error('User tidak ditemukan', 404);
         }
        $roles = $this->userService->getAllRole();
        return view('admin.users.form', compact('user', 'roles'));
    }

    public function update(UserRequest $request, $id)
    {
        try {
            // $this->authorize('update', User::class);
            $data = $request->validated();
            $user = $this->userService->findById($id);
            if (!$user) {
               return ResponseJson::error('User tidak ditemukan', 404);
            }
            $this->userService->update($id, $data);
             return redirect()->route('admin.user.index');
        } catch (\Throwable $th) {
            Log::error($th->getMessage());
            return ResponseJson::error($th->getMessage(), 500);
        }
    }

    public function destroy($id)
    {
        try {
             $deleted = $this->userService->delete($id);
            if (!$deleted) {
                return ResponseJson::error('User tidak ditemukan atau gagal dihapus', 404);
            }
            return ResponseJson::success($deleted, 'User deleted successfully');
        } catch (\Throwable $th) {
            Log::error($th->getMessage());
            return ResponseJson::error($th->getMessage(), 500);
        }
    }

}

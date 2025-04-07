<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Facades\DB;

class RoleController extends Controller
{
    /**
     * إضافة صلاحيات الوصول للتحكم بالأدوار.
     */
    public function __construct()
    {
        $this->middleware('permission:عرض صلاحية', ['only' => ['index']]);
        $this->middleware('permission:اضافة صلاحية', ['only' => ['create', 'store']]);
        $this->middleware('permission:تعديل صلاحية', ['only' => ['edit', 'update']]);
        $this->middleware('permission:حذف صلاحية', ['only' => ['destroy']]);
    }

    /**
     * عرض قائمة الأدوار.
     */
    public function index(Request $request)
    {
        $roles = Role::orderBy('id', 'DESC')->paginate(5);
        return view('roles.index', compact('roles'))
            ->with('i', ($request->input('page', 1) - 1) * 5);
    }

    /**
     * عرض نموذج إنشاء دور جديد.
     */
    public function create()
    {
        $permission = Permission::all();
        return view('roles.create', compact('permission'));
    }

    /**
     * تخزين دور جديد في قاعدة البيانات.
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|unique:roles,name',
            'permission' => 'required',
        ]);

        $role = Role::create(['name' => $request->input('name')]);
        $role->syncPermissions($request->input('permission'));

        return redirect()->route('roles.index')
            ->with('success', 'تم إنشاء الدور بنجاح');
    }

    /**
     * عرض تفاصيل دور معين.
     */
    public function show($id)
    {
        $role = Role::findOrFail($id);
        $rolePermissions = Permission::join("role_has_permissions", "role_has_permissions.permission_id", "=", "permissions.id")
            ->where("role_has_permissions.role_id", $id)
            ->get();

        return view('roles.show', compact('role', 'rolePermissions'));
    }

    /**
     * عرض نموذج تعديل دور معين.
     */
    public function edit($id)
    {
        $role = Role::findOrFail($id);
        $permission = Permission::all();
        $rolePermissions = DB::table("role_has_permissions")
            ->where("role_id", $id)
            ->pluck('permission_id', 'permission_id')
            ->all();

        return view('roles.edit', compact('role', 'permission', 'rolePermissions'));
    }

    /**
     * تحديث بيانات دور معين.
     */
    public function update(Request $request, $id)
{
    $this->validate($request, [
        'name' => 'required',
        'permission' => 'required|array', // Ensure permissions are an array
    ]);

    $role = Role::findOrFail($id);
    $role->name = $request->input('name');
    $role->save();

    // Convert permission IDs to names
    $permissions = Permission::whereIn('id', $request->input('permission'))->pluck('name')->toArray();

    // Sync using names instead of IDs
    $role->syncPermissions($permissions);

    return redirect()->route('roles.index')
        ->with('success', 'تم تحديث الدور بنجاح');
}

    /**
     * حذف دور معين.
     */
    public function destroy($id)
    {
        $role = Role::findOrFail($id);
        $role->delete();

        return redirect()->route('roles.index')
            ->with('success', 'تم حذف الدور بنجاح');
    }
}

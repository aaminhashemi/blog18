<?php

namespace RolePermission\Http\Controllers;

use Illuminate\Support\Facades\Validator;
use RolePermission\Http\Requests\RoleRequest;
use RolePermission\Models\RolePermission;
use App\Http\Controllers\Controller;
use Category\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RolePermissionController extends Controller
{
    public function index()
    {
        $this->authorize('view', \Aamin\RolePermission\Models\Permission::class);
        $roles = Role::all();
        $permissions = Permission::all();
        return view('RolePermissions::index', compact('roles', 'permissions'));
    }
    public function Permissions()
    {
        $permissions = Permission::all();
        return response()->json([
            'status' => 200,
            'permissions'=>$permissions]);
    }

    public function Roles()
    {
        $roles = Role::all();
        return response()->json([
            'status' => 200,
            'roles'=>$roles]);
    }
    public function savePermission(Request  $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|min:3|max:50',
        ]);
        if ($validator->passes()) {
            Permission::create(['name' => $request->name]);
            return response()->json([
                'status' => 200,
                'message' => 'ثبت دسترسی با موفقیت انجام شد.'
            ]);
        } else {
            return response()->json([
                'status' => 403,
                'message' => 'خطا در داده های ارسالی',
                'validation_errors' => $validator->messages()
            ]);
        }

    }

    public function saveRole(RoleRequest $request)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required|min:3|unique:roles,name',
           // 'permissions' => 'required|array|min:1',
        ]);
        if ($validator->passes()) {
            Role::create(['name' => $request->title])->syncPermissions($request->permissions);
            return response()->json([
                'status' => 200,
                'message' => 'نقش مورد نظر با موفقیت ثبت شد.'
            ]);
        } else {
            return response()->json([
                'status' => 403,
                'message' => 'خطا در داده های ارسالی',
                'validation_errors' => $validator->messages()
            ]);
        }
    }

    public function edit($roleId)
    {
        $role = Role::findOrFail($roleId);
        $permissions = Permission::all();
        return view('RolePermissions::edit', compact('role', 'permissions'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            "title" => "required|min:3|unique:roles,name," . $id,
            "permissions" => "required|array|min:1"
        ]);
        $update = Role::find($id)->syncPermissions($request->permissions)->update(['name' => $request->title]);
        if ($update) {
            newFeedback('موفقیت آمیز', 'عملیات با موفقیت انجام شد.', 'success');
            return redirect(route('role_permission.index'));
        } else {
            newFeedback('ناموفق', 'عملیات انجام نشد.', 'error');
            return back();
        }
    }

    public function destroy($id)
    {
        $role = Role::findOrFail($id);
        $role->delete();
        return response()->json(['message' => 'عملیات با موفقیت انجام شد.'], Response::HTTP_OK);
    }
}

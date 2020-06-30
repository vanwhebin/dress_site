<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Auth;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleController extends Controller
{
    public function __construct()
    {
        // TODO 使用中间件对访问指定的资源进行权限控制
        // $this->middleware();

    }


    /**
     * 显示角色列表
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $roles = Role::all();
        foreach($roles as $role) {
            dump($role->permissions()->pluck('name'));
        }
        exit;
        return view('roles.index')->with('roles', $roles);
    }

    /**
     * 显示创建角色表单
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        $permissions = Permission::all();
        return view('roles.create', ['permissions' => $permissions]);
    }

    /**
     * 保存新创建的角色
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|unique:roles|max:10',
            'permissions' => 'required'
        ]);

        $name = $request->input('name');
        $permissions = $request->input('permissions');

        $role = new Role();
        $role->name = $name;
        $role->save();

        foreach($permissions  as $permission) {
            $p = Permission::where('id', '=', $permission)->firstOrFail();
            $role = Role::where('name', '=', $name)->first();
            $role->givePermissionTo($p);
        }
        return redirect()->route('roles.index')->with('flash_message', 'Role' . $role->name. 'added!');
    }

    /**
     * Display the specified resource.
     * 显示指定的资源信息
     * @param int $id
     * @return Response
     */
    public function show($id)
    {
        return redirect('roles');
    }

    /**
     * Show the form for editing the specified resource.
     * 编辑角色表单
     * @param int $id
     * @return Response
     */
    public function edit($id)
    {
        $role = Role::findOrFail($id);
        $permissions = Permission::all();
        return view('roles.edit', compact('role', 'permissions'));
    }

    /**
     * Update the specified resource in storage.
     * 更新角色信息
     * @param Request $request
     * @param int $id
     * @return Response
     */
    public function update(Request $request, $id)
    {
        $role = Role::where('id', '=', $id)->firstOrFail();
        $this->validate($request, [
            'name' => 'required|max:10|unique:roles,name,'.$id,
            'permissions' => 'required'
        ]);

        $input = $request->except(['permissions']);
        $permissions = $request->input('permissions');
        $role->fill($input)->save();

        $allPermissions = Permission::all();
        foreach ($permissions as $p) {
            $role->revokePermissionTo($p);
        }

        foreach($permissions as $per) {
            $p = Permission::where('id', '=', $per)->firstOrFail();
            $role->givePermissionTo($p);
        }

        return redirect()->route('roles.index')->with('flash_message', 'Role'. $role->name . 'updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return Response
     */
    public function destroy($id)
    {
        $role = Role::findOrFail($id);
        $role->delete();
        return redirect()->route('roles.index')->with('flash_mesasge', 'Role deleted');
    }
}

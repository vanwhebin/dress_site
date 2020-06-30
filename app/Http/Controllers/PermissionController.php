<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Auth;
use Illuminate\Http\Response;
use Illuminate\Routing\Redirector;
use Illuminate\Validation\ValidationException;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class PermissionController extends Controller
{

    public function __construct()
    {
        // TODO 使用中间件解决权限访问指定资源问题
    }


    /**
     * 顯示权限列表
     *
     * @return Response
     */
    public function index()
    {
        $permissions = Permission::all();
        return view('permissions.index')->with('permissions', $permissions);
    }

    /**
     * 显示创建权限菜单
     *
     * @return Response
     */
    public function create()
    {
        $roles = Role::get();
        return view('permissions.create')->with('roles', $roles);
    }

    /**
     * 保存新创建的权限
     *
     * @param  \Illuminate\Http\Request  $request
     * @return Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|max:40'
        ]);

        $name = $request->input('name');
        $permission = new Permission();
        $permission->name = $name;
        $roles = $request->input('roles');
        $permission->save();

        if (!empty($roles)) {
            foreach($roles as $role) {
                $r = Role::where('id', '=', $role)->firstOrFail();
                $permission = Permission::where('name', '=', $name)->first();
                $r->givePermissionTo($permission);
            }
        }

        return redirect()->route('permissions.index')->with('flash_message', 'Permission '. $permission->name . ' Added!' );
    }

    /**
     * 显示给定权限
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        return redirect('permissions');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        $permission = Permission::findOrFail($id);
        return view('permissions.edit', compact('permission'));
    }

    /**
     * 更新指定的权限信息
     * @param Request $request
     * @param $id
     * @return RedirectResponse|Redirector
     * @throws ValidationException
     */
    public function update(Request $request, $id)
    {
        $permission = Permission::findOrFail($id);
        $this->validate($request, [
            'name' => 'required|max:40'
        ]);

        $input = $request->all();
        $permission->fill($input)->save();
        return redirect()->with('permissions.index')->with('flash_message', 'Permission'. $permission->name .'updated!');


    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        $permission = Permission::findOrFail($id);
        if ($permission->name === 'Administer roles & permissions') {
            return redirect()->route('permisions.index')->with('flash_message', 'Cannot delete this Permission');
        }

        $permission->delete();

        return redirect()->route('permissions.index')
            ->with('flash_message', 'Permission deleted!');
    }

}

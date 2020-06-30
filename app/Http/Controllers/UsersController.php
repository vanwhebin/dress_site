<?php
/*
 * @Description:
 * @Author: vanwhebin
 * @Date: 2018-10-28 22:51:53
 * @LastEditTime: 2018-10-28 23:58:22
 * @LastEditors: your name
 */

namespace App\Http\Controllers;

use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Models\User;
use Illuminate\Validation\ValidationException;
use Illuminate\View\View;
use Spatie\Permission\Models\Role;

class UsersController extends Controller
{
    public function __construct()
    {
        // TODO 使用中间件控制权限访问指定资源
    }


    /**
     * 显示用户列表
     * @return Factory|View
     */
    public function index()
    {
        $users = User::all();
        // dump($users);
        // exit;
        return view('users.index')->with('users', $users);
    }

    /**
     * 创建用户菜单表单
     * @return Factory|View
     */
    public function create()
    {
        $roles = Role::get();
        return view('users.create', ['roles' => $roles]);
    }


    public function login()
    {
        // echo __FUNCTION__;
        return view('users.login');
    }

    /**
     * 显示指定用户
     * @param $id
     * @return Factory|View
     */
    public function show($id)
    {
        return view('users.show');
    }

    /**
     * 显示用户角色编辑表单
     * @param $id
     * @return Factory|View
     */
    public function edit($id)
    {
        $user = User::findOrFail($id);
        $roles = Role::get();
        return view('users.edit', compact('user', 'roles'));
    }

    /**
     * 更新数据库中的给定用户
     * @param Request $request
     * @param $id
     * @return RedirectResponse
     * @throws ValidationException
     */
    public function update(Request $request, $id)
    {
        // echo 11111;exit;

        $user = User::findOrFail($id);
        // dump($request);exit;
        $this->validate($request, [
            'name' => 'required|min:1',
            'email' => 'required|email|unique:users,email,'.$id,
            // 'password' => 'required|min:6|confirmed'
        ]);
        // dd($user);
        // exit;
        $input = $request->only(['name', 'email']);
        $roles = $request->input('roles');
        // $input['password'] = User::
        $user->fill($input)->save();

        // dd($input);
        // dd($roles);
        // exit;
        if (isset($roles)) {
            $user->roles()->sync($roles);
        } else {
            $user->roles()->detach();
        }

        return redirect()->route('users.index')->with('flash_message', 'User successfully edited');


    }


    /**
     * 保存新建用户信息
     * @param Request $request
     * @return RedirectResponse
     * @throws ValidationException
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|max:50',
            'email' => 'required|email|unique:users|max:255',
            'password' => 'required|confirmed|min:6',
        ]);

        $user = User::create($request->only(['email', 'name', 'password']));
        $roles = $request['roles'];
        if (isset($roles)) {
            foreach($roles as $role){
                $role_r = Role::where('id', '=', $role)->firstOrFail();
                $user->assignRole($role_r);
            }
        }

        return redirect()->route('users.index')->with('flash_message', 'User successfully added.');

    }

    /**
     * 删除用户
     * @param $id
     * @return RedirectResponse
     */
    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        return redirect()->route('users.index')->with('flash_message', 'User Successfully deleted.');
    }

}

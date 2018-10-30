<?php
/*
 * @Description: 
 * @Author: vanwhebin
 * @Date: 2018-10-28 22:51:53
 * @LastEditTime: 2018-10-28 23:58:22
 * @LastEditors: your name
 */
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Models\User;

class UsersController extends Controller
{
    /**
        * @msg: 
        * @param {type} 
        * @return: 
        */
   public function create()
   {
       return view('users.create');
   }


   public function login()
   {
       echo __FUNCTION__;
   }

   public function show(User $user)
   {
       return view('users.show', compact('user'));
   }


   public function store(Request $request)
   {
        $this->validate($request, [
            'name'      => 'required|max:50', 
            'email'     => 'required|email|unique:users|max:255', 
            'password'  => 'required|confirmed|min:6', 
        ]);
        return;
   }

}

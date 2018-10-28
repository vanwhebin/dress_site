<?php
/*
 * @Description: 
 * @Author: vanwhebin
 * @Date: 2018-10-28 22:51:53
 * @LastEditTime: 2018-10-28 23:08:52
 * @LastEditors: your name
 */
namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UsersController extends Controller
{
   public function create()
   {
       return view('users.create');
   }


   public function login()
   {
       echo __FUNCTION__;
   }
}

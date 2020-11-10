<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Role;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    public function index(){
        return User::all();
    }

    public function currentUser($userId){
        $user = User::where('id', $userId)->firstOrFail();

        return $user;
    }

    public function getAllUsers(){
        return Role::where('name', 'user')->first()->users()->get();
    }

    public function getAllAdmins(){
        return Role::where('name', 'admin')->first()->users()->get();
    }

    //public function update(Request $request, $id){
    public function grantRoleAdmin($id){
        $user = User::where('id', $id)->firstOrFail();
        $adminRole = Role::where('name', 'admin')->firstOrFail();
        $user->roles()->attach($adminRole->id);

        self::revokeRoleUser($id);
        //return redirect(Request::url());
        //return 200;
        return response();
    }

    public function revokeRoleAdmin($id){
        $user = User::where('id', $id)->firstOrFail();
        $adminRole = Role::where('name', 'admin')->firstOrFail();
        $user->roles()->detach($adminRole->id);

        self::grantRoleUser($id);
        //return redirect(Request::url());
        return 200;
    }
    
    public function grantRoleUser($id){
        $user = User::where('id', $id)->firstOrFail();
        $userRole = Role::where('name', 'user')->firstOrFail();
        $user->roles()->attach($userRole->id);

        //return redirect(Request::url());
        return 200;
    }

    public function revokeRoleUser($id){
        $user = User::where('id', $id)->firstOrFail();
        $adminRole = Role::where('name', 'user')->firstOrFail();
        $user->roles()->detach($adminRole->id);

        //return redirect(Request::url());
        return 200;
    }

    public function update(){
        //$movie = Movie::update($request -> all());
        User::where('id', $id)->update($request->all());
        $user = User::find($id);
        
        return $user;
    }

    public function delete(Request $request, $id){
        $user = User::findOrFail($id);
        $user->delete();

        return 204;
    }

    public function usersRole(Request $request, $id)
    {
        $user = User::where('id', $id)->with('roles')->first();
        $role = $user->roles->first()->name;

        //return $role;
        return response()->json($role);
    }

    
}

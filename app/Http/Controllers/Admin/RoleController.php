<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;

class RoleController extends Controller
{
    public function index(){
        $users = User::with('role')->paginate(10);
        $roles = Role::all();
        return view('admin.roles.index' , compact('users' , 'roles'));
    }

   public function updateRole(Request $request , $user){
   
    $uesrRole = User::find($user);
    // dd( $uesrRole);
   $request->validate([
    'roles' => "nullable|array"
   ]);
    // dd($request->roles);
   $uesrRole->syncRoles($request->roles);
   return redirect()->back();
   }



   public function toggleBan($id)
{
    $user = User::findOrFail($id);

    $user->is_banned = !$user->is_banned;
    $user->save();

    return redirect()->back()->with('success', 'Statut utilisateur mis à jour.');
}

}

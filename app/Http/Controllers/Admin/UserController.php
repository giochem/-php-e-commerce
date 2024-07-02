<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class UserController extends Controller
{
    public function index()
    {
        $users = User::latest()->get();
        return view('admin.alluser', compact('users'));
    }
    public function editUser($id)
    {
        $user_info = User::findOrFail($id);

        return view('admin.edituser', compact('user_info'));
    }
    public function updateUser(Request $request)
    {
        $user_id = $request->user_id;
        $request->validate([
            'is_admin' => 'required'
        ]);

        $new_role = 0;
        // is_admin == 1 + role_id == 1 -> admin
        if ($request->is_admin == 1) {
            $new_role = 1; // admin
        } else {
            $new_role = 2; // user
        }

        User::findOrFail($user_id)->update([
            'is_admin' => $request->is_admin,
        ]);
        DB::update('update role_user set role_id = ? where user_id = ?', [$new_role, $user_id]);

        return redirect()->route('alluser')->with('message', 'User Updated Successfully!');
    }
    public function deleteUser($id)
    {
        User::findOrFail($id)->delete();

        return redirect()->route('alluser')->with('message', 'User Deleted Successfully!');
    }
}

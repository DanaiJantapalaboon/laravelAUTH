<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\QueryException;

class Admin_UserManagementController extends Controller
{

    //============= 1. Add New Users รับมาจากหน้า User Management =============//
    public function addUsers(Request $request)
    {

        $request->validate([
            'firstname' => 'required|string',
            'lastname' => 'required|string',
            'position' => 'required|string',
            'email' => 'required|email',
            'newPassword' => 'required|confirmed|min:4'
        ]);

        try {
            $user = new User();

            $user->firstname = $request->firstname;
            $user->lastname = $request->lastname;
            $user->position = $request->position;
            $user->email = $request->email;
            $user->password = Hash::make($request->newPassword);
            $user->save();

            return back();

        } catch (QueryException) {
            return back()->withErrors(['emailError' => 'This email has already registered, Please try a difference email.']);

        }
    }


    //============= 2. Edit Users รับมาจากหน้า User Management =============//
    public function editUsers(Request $request, $id) {

        $request->validate([
            'editFirstname' => 'required|string',
            'editLastname' => 'required|string',
            'editPosition' => 'required|string'
        ]);

        $user = User::find($id);
        $user->firstname = $request->editFirstname;
        $user->lastname = $request->editLastname;
        $user->position = $request->editPosition;
        $user->save();

        return back();
        
    }


    //============= 3. Delete Users รับมาจากหน้า User Management =============//
    public function deleteUsers($id) {
        $user = User::find($id);

        // check ถ้าเป็น logged in account จะลบไม่ได้จ้า
        if ($user->id === Auth::user()->id) {
            return back()->with('error_delete', 'This is your logged in account, Please go to My Profile page to delete your account.');

        } else {
            $user->delete();
            return back();
        }
    }

}
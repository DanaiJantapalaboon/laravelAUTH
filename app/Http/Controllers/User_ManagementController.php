<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\QueryException;

class User_ManagementController extends Controller
{

    //============= 1. Add New Users รับมาจากหน้า User Management =============//
    public function addUsers(Request $request)
    {

        // เช็ค password_confirmation ก่อนเลยจ้า ถ้าหลังจาก $request->validate() แล้วจะไม่ทำงาน
        if ($request->password !== $request->password_confirmation) {
            return back()->with('error', 'The password confirmation does not match, Please try again.');
        }

        $request->validate([
            'firstname' => 'required|string',
            'lastname' => 'required|string',
            'position' => 'required|string',
            'email' => 'required|email',
            'password' => 'required|min:4|confirmed'
        ]);

        try {
            $user = new User();

            $user->firstname = $request->firstname;
            $user->lastname = $request->lastname;
            $user->position = $request->position;
            $user->email = $request->email;
            $user->password = Hash::make($request->password);
            $user->save();

        } catch (QueryException) {
            return back()->with('error', 'This email has already registered, Please try a difference email.');
        }

        // check email ซ้ำ จ้าา
        // $user = User::where('email', $request->email)->first();

        // if ($user) {
        //     return back()->with('error', 'This email has already registered, Please try a difference email.');

        // } else {
        //     $user = new User();
    
        //     $user->firstname = $request->firstname;
        //     $user->lastname = $request->lastname;
        //     $user->position = $request->position;
        //     $user->email = $request->email;
        //     $user->password = Hash::make($request->password);
        //     $user->save();

        //     return back();
        // }
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
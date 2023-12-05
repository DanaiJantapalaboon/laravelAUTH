<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\QueryException;

class Admin_UserProfileController extends Controller
{

    //============= 1. update my_profile หน้า user_profile =============//
    public function updateProfile(Request $request, $id)
    {
        $request->validate([
            'editFirstname' => 'required|string',
            'editLastname' => 'required|string',
            'editPosition' => 'required|string'
        ]);

            $user = User::find($id);
            $user->firstname = $request->input('editFirstname');
            $user->lastname = $request->input('editLastname');
            $user->position = $request->input('editPosition');
            $user->save();

            return back();
    }


    //============= 2. update password หน้า user_profile =============//
    public function updateEmail(Request $request, $id)
    {
        $request->validate([
            'editEmail' => 'required|email'
        ]);

        try {
            $user = User::find($id);
            $user->email = $request->input('editEmail');
            $user->save();

            return back();

        } catch (QueryException) {
            return back()->withErrors(['emailError' => 'This email has already registered, Please try a difference email.']);
        }
    }


    //============= 3. update password หน้า user_profile =============//
    public function updatePassword(Request $request, $id)
    {
        $request->validate([
            'currentPassword' => 'required',
            'newPassword' => 'required|confirmed|min:4'
        ]);
    
        $user = User::find($id);
        if (!Hash::check($request->currentPassword, $user->password)) {
            return back()->withErrors(['currentPassword' => 'The current password is incorrect, Please try again.']);
        }
    
        $user->password = Hash::make($request->newPassword);
        $user->save();
    
        return redirect()->route('user_profile')->with('success', 'Password updated successfully.');
    }



    //============= 4. delete account หน้า user_profile =============//
    public function deleteAccount(Request $request, $id)
    {
        $request->validate([
            'deletePassword' => 'required|min:4'
        ]);

        $user = User::find($id);
    
        if (!Hash::check($request->deletePassword, $user->password)) {
            return redirect()->route('user_profile')->with('passwordIncorrect', 'The password is incorrect, Please try again.');
        }

        $user->delete();
        Auth::logout();

        return redirect()->route('login')->with('accountDeleted', 'Your account has been deleted successfully.');;
    }


}

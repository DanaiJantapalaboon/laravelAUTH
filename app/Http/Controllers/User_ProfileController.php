<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class User_ProfileController extends Controller
{


    public function updateProfile(Request $request, $id)
    {
        $request->validate([
            'editFirstname' => 'required|string',
            'editLastname' => 'required|string',
            'editPosition' => 'required|string',
            'editEmail' => 'required|email'
        ]);

        $user = User::where('email', $request->editEmail)->first();
        
        if ($user) {
            return back()->with('error', 'This email has already registered, Please try a difference email.');

        } else {

            $user = User::find($id);
            $user->firstname = $request->input('editFirstname');
            $user->lastname = $request->input('editLastname');
            $user->position = $request->input('editPosition');
            $user->email = $request->input('editEmail');
            $user->save();

            return back();
        }
    }


    //============= 2. update password หน้า Profile =============//
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
    
        return redirect()->route('profile')->with('success', 'Password updated successfully.');
    }



    //============= 3. delete account หน้า Profile =============//
    public function deleteAccount(Request $request, $id)
    {
        $request->validate([
            'deletePassword' => 'required|min:4'
        ]);

        $user = User::find($id);
    
        if (!Hash::check($request->deletePassword, $user->password)) {
            return redirect()->route('profile')->with('passwordIncorrect', 'The password is incorrect, Please try again.');
        }

        $user->delete();
        Auth::logout();

        return redirect()->route('login')->with('accountDeleted', 'Your account has been deleted successfully.');;
    }


}

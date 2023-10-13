<?php
 
namespace App\Http\Controllers;
 
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
 
class AuthController extends BaseController
{

    //============= ไปหน้า register =============//
    public function register()
    {
        $companyName = $this->getCompanyName();
        return view('auth/register', compact('companyName'));
    }


    //============= ไปหน้า login =============//
    public function login()
    {
        $companyName = $this->getCompanyName();

        return view('auth/login', compact('companyName'));
    }
    

    //============= Authenticate ผ่านไปหน้า admin/home =============//
    public function authenticate(Request $request): RedirectResponse
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required']
        ]);

        // เก็บ remember_token ถ้า checkbox name="remember" เช็คอยู่
        $remember = $request->has('remember');
 
        if (Auth::attempt($credentials, $remember)) {
            $request->session()->regenerate();
 
            return redirect()->intended('/admin/home');
        }
 
        return back()->with('error', 'Email or password incorrect, Please try again.');
    }

    
    //============= รับมาจากหน้า register =============//
    public function registerAccount(Request $request)
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

        $user = User::where('email', $request->email)->first();

        if ($user) {
            return back()->with('error', 'This email has already registered, Please try a difference email.');

        } else {
            $user = new User();
    
            $user->firstname = $request->firstname;
            $user->lastname = $request->lastname;
            $user->position = $request->position;
            $user->email = $request->email;
            $user->password = Hash::make($request->password);
            $user->save();

            return back()->with('success', 'Account created successfully, Please ');
        }
    }


    //============= รับมาจาก modal forgot password =============//
    public function resetPassword(Request $request)
    {

        // เช็ค password_confirmation ก่อนเลยจ้า ถ้าหลังจาก $request->validate() แล้วจะไม่ทำงาน
        if ($request->password !== $request->password_confirmation) {
            return redirect()->route('login')->with('error', 'The password confirmation does not match, Please try again.');
        }

        $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:4|confirmed' // Ensure password_confirmation matches
        ]);
    
        $user = User::where('email', $request->email)->first();
    
        if ($user) {
            $user->password = Hash::make($request->password);
            $user->save();
    
            return redirect()->route('login')->with('success', 'Password reset successfully, You can now login with your new password.');
        
        } else {
            return redirect()->route('login')->with('error', 'Email not found, Please try again.');
        }
    }


    public function logout()
    {
        Auth::logout();
        return redirect()->route('login');
    }
}
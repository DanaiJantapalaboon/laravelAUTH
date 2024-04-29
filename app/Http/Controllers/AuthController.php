<?php
 
namespace App\Http\Controllers;
 
use PDOException;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
 
class AuthController extends BaseController
{

    //============= 1. ไปหน้า register =============//
    public function register()
    {
        $companyName = $this->getCompanyName();
        $companyLogo = $this->getCompanyLogo();

        return view('auth/register', compact('companyName', 'companyLogo'));
    }


    //============= 2. ไปหน้า login =============//
    public function login()
    {
        $companyName = $this->getCompanyName();
        $companyLogo = $this->getCompanyLogo();

        return view('auth/login', compact('companyName', 'companyLogo'));
    }
    

    //============= 3. Authenticate ผ่านไปหน้า admin/home =============//
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
 
        return back()->withErrors(['loginError' => 'Your login incorrected, Please try again.']);
    }

    
    //============= 4. รับมาจากหน้า register =============//
    public function registerAccount(Request $request)
    {

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

            return back()->with('success', 'Account created successfully, Please ');
        
        } catch (QueryException) {
            // ในกรณีที่ต้องการแสดง sql error
            // return back()->with('error', $e->getMessage());
            return back()->with('error', 'This email has already registered, Please try a difference email.');

        }
    }


    //============= 5. รับมาจาก modal forgot password =============//
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

    public function logout(Request $request): RedirectResponse
    {
        Auth::guard()->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login');
    }
}
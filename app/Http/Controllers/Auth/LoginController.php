<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function credentials(Request $request){
        $user = User::where('email', $request->email)->first();
        if($user){
            if($user -> email_verified_at != ''){
                if(Auth::guard('web')->attempt(['email' => $request->email, 'password' => $request->password])) {
                    return redirect()->route('home');
                }else{
                    session()->flash('message', ['error', 'Invalid email or password!']);
                    return redirect()->back();
                }
            }else{
                session()->flash('message', ['error', 'Please verify your email!']);
                session()->put('verify_email', $request->email);
                return redirect('user/login');
    
            }
        }else{
            session()->flash('message', ['error', 'Your email do not exist!']);
            return redirect('user/login');
        }
        

    }

    public function login(){
        return view('auth.login');
    }

    public function admin_login(Request $request){
        if(Auth::guard('admin')->attempt(['username' => $request->username, 'password' => $request->password])) {
            return redirect()->route('admin.dashboard');
        }else{
            return redirect()->back();
        }
    }

    // public function profile_admin(Request $request){
    //     $user = $request->user();

    //     if($user){
    //         return response()->json($user, 200);
    //     } else {
    //         return response()->json([
    //             'message' => 'No Data'
    //         ], 404);
    //     }
    // }

    public function admin_logout(){
        Auth::guard('admin')->logout();
        return redirect('/admin/login');
    }

    public function logout(){
        Auth::guard('web')->logout();
        return redirect('/');
    }
}

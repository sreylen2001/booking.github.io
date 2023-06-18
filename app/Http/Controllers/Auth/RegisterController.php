<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\Request;

use App\Models\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;



class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
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
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */
    protected function create(array $data)
    {
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);
    }

    public function index(){
        return view('auth.register');
    }

    public function save(Request $request){
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|max:255|unique:users,email',
            'password' => 'required|string|min:8',

        ]);
        
        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->verification_code = rand(0, 999999);
        $user->opt_expired_date = date("Y-m-d H:i:s", strtotime("+10 minutes"));

        if($user->save()){
            $subject = "iBooking Mobile App Verify Code";
            $sms =<<<EOT
                <p style="margin-bottom: 15px;">Dear $request->name,</p>
                <p>Thank you for your registration</p>
                <p>Below is your verification code.</p>
                <h1 style="text-align:center; padding: 10px;">$user->verification_code</h1>
                <p><br>iBooking,</p>
                <p><br>Best regard,</p>
            EOT;
            send_email($request->email, $subject, $sms);
            //dd(send_email($request->email, $subject, $sms));
            session()->put('register_email', $request->email);
            return redirect('user/verify');
        }else{
            return redirect('user/register');
        }

        
    }

    public function verify(){
        return view('auth.verify');
    }

    public function verify_save(Request $request){
        $email = session()->get('register_email');
        $user = User::where('email', $email)
        ->where('verification_code', $request->verification_code)
        ->where('opt_expired_date', '>', date("Y-m-d H:i:s"))
        ->first();

        if($user){
            $ok = User::find($user->id);
            $ok->email_verified_at = date("Y-m-d H:i:s");
            if($ok->save()){
                session()->flash('message', ['success', 'Email verified successfully!, Please login to continue']);
                session()->forget('register_email');
                return redirect('user/login');
            }else{
                session()->flash('message', ['error', 'Your OTP code is invalid or expired!']);
                return redirect('user/verify');
            }
        }else{
            session()->flash('message', ['error', 'Your OTP code is invalid or expired!']);
            return redirect('user/verify');
        }

    }

}

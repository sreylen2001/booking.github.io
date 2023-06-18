<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\File; 

class AuthController extends Controller
{
    public function register(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'gender' => 'required|min:4|max:6',
            'phone' => 'required|regex:/(0)[0-9]/|not_regex:/[a-z]/|min:9',
            'email' => 'required|string|max:255|unique:users,email',
            'password' => 'required|string|min:8',
            'confirm_password' => 'required|string|same:password',
        ]);

        $user = User::create([
            'name' => $data['name'],
            'gender' => $data['gender'],
            'phone' => $data['phone'],
            'email' => $data['email'],
            'password' => Hash::make($data['password'])
    
        ]);

        $token = $user->createToken('fundaProjectToken')->plainTextToken;

        $response = [

            'user' => $user,
            'token' => $token,
        ];
        return response($response, 201);
    }

    public function logout()
    {
        auth()->user()->tokens()->delete();
        return response(['message' => 'Logged Out Successfully!!!']);
    }

    public function adminLogin(Request $request)
    {
        $data = $request->validate([
            'username' => 'required|string|max:255',
            'password' => 'required|string',
        ]);

        $user = Admin::where('username', $data['username'])->first();

        if (!$user || !Hash::check($data['password'], $user->password)) {
            return response(['message' => 'Invalid Credentials!!!'], 401);
        } else {
            $token = $user->createToken('fundaProjectTokenLogin')->plainTextToken;
            $response = [
                'message' => 'Registration Success!',
                'user' => $user,
                'token' => $token,

            ];

            return response($response, 200);
        }
    }

    public function login(Request $request)
    {
        $data = $request->validate([
            'email' => 'required|string|max:255',
            'password' => 'required|string',
        ]);

        $user = User::where('email', $data['email'])->first();

        if (!$user || !Hash::check($data['password'], $user->password)) {
            return response(['message' => 'Invalid Credentials!!!'], 401);
        } else {
            $token = $user->createToken('fundaProjectTokenLogin')->plainTextToken;
            $response = [
                'message' => 'Registration Success!',
                'user' => $user,
                'token' => $token,

            ];

            return response($response, 200);
        }
    }


    public function profile(Request $request)
    {
        $user = $request->user();

        if($user){
            return response()->json($user, 200);
        } else {
            return response()->json([
                'message' => 'No Data'
            ], 404);
        }
    }

    public function updateProfile(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'name' => 'required|min:2|max:100',
            'gender' => 'required|min:4|max:6',
            'profession' => 'min:0|max:100|nullable',
            'profile_photo' => 'image|mimes:jpeg,bmp,png|nullable',
        ]);
               
        if ($validator->fails()){
            return response()->json([
                'message' => 'Validations fails',
                'errors' => $validator->errors()
            ], 422);
        }
        $user = $request->user();
            if($request->hasFile('profile_photo')){
                if($user->profile_photo){
                    $old_path = public_path().'uploads/profile_images/'
                        .$user->profile_photo;
                    if(File::exists($old_path)){
                        File::delete($old_path);
                    }
                }
                $image_name = 'profile-photo-'.time().'.'.$request->profile_photo->extension();
                    
                $request->profile_photo->move(public_path('/uploads/profile_images'), $image_name);
        
            }else{
                $image_name = $user->profile_photo;
            }
           
            $user -> update([
                'name' => $request -> name,
                'gender' => $request -> gender,
                'profile_photo' => $image_name,
                'profession' => $request -> profession,
            ]);
           
            return response()->json([
                'message' => 'Your profile successfully updated!!!',
            ], 200);
    }


    public function change_password(Request $request){
       
        $validator = Validator::make($request->all(),[
            'old_password' => 'required|string',
            'password' => 'required|string|min:6|max:100',
            'confirm_password' => 'required|string|same:password',
        ]);
       
        if ($validator->fails()){
            return response()->json([
                    'message' => 'Validations fails',
                    'errors' => $validator->errors()
                ], 422);
        }
        $user = $request->user();
        if(Hash::check($request->old_password, $user->password)){
            $user->update([
                'password'=>Hash::make($request->password)
            ]);
            return response()->json([
                    'message' => 'Password successfully updated!!!',
                ], 200);
        }else{
            return response()->json([
                    'message' => 'Old Password does not matched!!!',
                ], 400);
        }
    }


}

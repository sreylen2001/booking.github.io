<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Models\User;
use App\Models\Admin;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\File;
use Symfony\Component\HttpFoundation\Response;

class AuthController extends Controller
{
    public function register(Request $request): JsonResponse
    {
        //return 0;
        $data = $request->validate([
            'role_id' => 'required|int|max:4',
            'name' => 'required|string|max:255',
            'gender' => 'required|min:4|max:6',
            'phone' => 'required|regex:/(0)[0-9]/|not_regex:/[a-z]/|min:9',
            'email' => 'required|string|max:255|unique:new_users,email',
            'password' => 'required|string|min:8',
            'confirm_password' => 'required|string|same:password',
        ]);
        $users = User::create([
            'role_id' => $data['role_id'],
            'name' => $data['name'],
            'gender' => $data['gender'],
            'phone' => $data['phone'],
            'email' => $data['email'],
            'password' => Hash::make($data['password'])
        ]);
        // $token = $users->createToken(time())->plainTextToken;
        $token = $users->createToken(User::USER_TOKEN)->plainTextToken;

        return $this->success([
            'user' => $users,
            'token' => $token,
        ], 'User has been register successfully');
    }

    public function logout(): JsonResponse
    {
        auth()->user()->tokens()->delete();
        return $this->success(null, 'Logout successfully!');
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
            $token = $user->createToken(time())->plainTextToken;
            $response = [
                'message' => 'Registration Success!',
                'user' => $user,
                'token' => $token,

            ];

            return response($response, 200);
        }
    }

    public function login(Request $request): JsonResponse
    {
        $data = $request->validate([
            'email' => 'required|string|max:255',
            'password' => 'required|string',
        ]);

        $user = User::query()->where('email', $data['email'])->first();

        if (!$user || !Hash::check($data['password'], $user->password)) {
//            return response(['message' => 'Invalid Credentials!!!'], 401);
            return $this->error('Invalid Credentials!!!', Response::HTTP_UNPROCESSABLE_ENTITY);
        } else {
            //$token = $user->createToken('fundaProjectTokenLogin')->plainTextToken;
            $token = $user->createToken(User::USER_TOKEN)->plainTextToken;
            return $this->success([
                'user' => $user,
                'token' => $token,
            ], 'User has been register successfully');
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
            'name' => 'min:2|max:100',
            'gender' => 'min:4|max:6',
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

        $request['profile_photo'] = $image_name;

        $user->update($request->toArray());

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

    public function getUser(): JsonResponse
    {
        $user = Auth::user();
        return $this->success([$user], 'Get user successfully');
    }
}

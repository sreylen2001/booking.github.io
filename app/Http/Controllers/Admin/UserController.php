<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\View\View;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }
    
    public function index(Request $request): View{
        // dd($users);
        $data['users'] = DB::table('users')->where('status', '1')->paginate(5);
        return view('admins.admin_users.index', $data);
        
    }

    public function edit($id){
        $data['users'] = DB::table('users')->find($id);
        return view('admins.admin_users.edit', $data);
    }
    
    public function update(Request $request){
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
        $data['name'] = $request->name;
        $data['gender'] = $request->gender;
        // $data['dob'] = $request->dob;
        $data['profession'] = $request->profession;
        $data['profile_photo'] = $image_name;
        $data['email'] = $request->email;
        $data['phone'] = $request->phone;

        $i = DB::table('users')->where('id', $request->id)->update($data);
        if($i){
            return redirect()->route('admin.admin_user');
        }else{
            echo'No Update File';
        }
    }

    public function delete($id){

        $affected = DB::table('users')
        ->where('id', $id)
        ->update([
            'status' => '0'
        ]);
        if($affected){
            return redirect()->route('admin.admin_user');
        }
    }
}

<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

class RoleController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }
    
    public function index(Request $request): View{
        // dd($users);
        $data['new_roles'] = DB::table('new_roles')->paginate(5);
        return view('admins.user_roles.index', $data);
        
    }

    public function edit($id){
        $data['new_roles'] = DB::table('new_roles')->find($id);
        return view('admins.user_roles.edit', $data);
    }
    
    public function update(Request $request){
        $data['name'] = $request->name;
        $data['description'] = $request->description;

        $i = DB::table('new_roles')->where('id', $request->id)->update($data);
        if($i){
            session()->flash('message', ['success', 'Role information is updated successfully!']);
            return redirect()->route('admin.user_role');
        }else{
            session()->flash('message', ['error', 'Role information is updated Fail!']);
        }
    }
}

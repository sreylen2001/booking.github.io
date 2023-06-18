<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
class DriverController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function index(){

        $data['drivers'] = DB::table('drivers')->where('status', '1')->paginate(5);
        return view('admins.admin_drivers.index', $data);
        
    }
    public function create(){
        $data['drivers'] = DB::table('drivers')->get();
        return view('admins.admin_drivers.create', $data);
    }

    public function save(Request $request){

        $data['id'] = $request->id;
        $data['user_id'] = Auth::user()->id;
        $data['name'] = $request->name;
        $data['contact'] = $request->contact;

        $i = DB::table('drivers')->insert($data);

        if($i){
            return redirect()->route('admin.admin_driver');
        }else{
            return redirect()->route('admin_driver.create');
        }
    }

    public function edit($id){
        $data['drivers'] = DB::table('drivers')->find($id);
        return view('admins.admin_drivers.edit', $data);
    }
    
    public function update(Request $request){
        $data['name'] = $request->name;
        $data['contact'] = $request->contact;

        $i = DB::table('drivers')->where('id', $request->id)->update($data);
        if($i){
            session()->flash('message', ['success', 'Driver information is updated successfully!']);
            return redirect()->route('admin.admin_driver');
        }else{
            session()->flash('message', ['error', 'Driver information is updated Fail!']);
        }
    }

    public function delete($id){

        $affected = DB::table('drivers')
        ->where('id', $id)
        ->update([
            'status' => '0'
        ]);
        if($affected){
            return redirect()->route('admin.admin_driver');
        }
    }
}
